<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use App\Models\Products;
use App\Models\Payments;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

class TransactionController extends Controller
{
    /**
     * Display a listing of transactions.
     * 
     * @param Request $request
     * @return JsonResponse
     */
    public function index(Request $request): JsonResponse
    {
        try {
            $perPage = $request->get('per_page', 10);
            $search = $request->get('search');
            $status = $request->get('status');
            $billingCycle = $request->get('billing_cycle');
            $userId = $request->get('user_id');
            $productId = $request->get('product_id');

            $query = Transaction::with(['user', 'product', 'payment']);

            // Search filter
            if ($search) {
                $query->where(function ($q) use ($search) {
                    $q->where('transaction_code', 'like', "%{$search}%")
                        ->orWhere('subdomain_web', 'like', "%{$search}%")
                        ->orWhere('subdomain_server', 'like', "%{$search}%")
                        ->orWhereHas('user', function($userQuery) use ($search) {
                            $userQuery->where('name', 'like', "%{$search}%")
                                     ->orWhere('email', 'like', "%{$search}%");
                        });
                });
            }

            // Status filter
            if ($status) {
                $query->where('status', $status);
            }

            // Billing cycle filter
            if ($billingCycle) {
                $query->where('billing_cycle', $billingCycle);
            }

            // User filter
            if ($userId) {
                $query->where('user_id', $userId);
            }

            // Product filter
            if ($productId) {
                $query->where('product_id', $productId);
            }

            $transactions = $query->orderBy('created_at', 'desc')
                                 ->paginate($perPage);

            return response()->json([
                'success' => true,
                'message' => 'Transactions retrieved successfully',
                'data' => $transactions
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to retrieve transactions',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Step 1: Get available products for transaction
     * 
     * @return JsonResponse
     */
    public function getAvailableProducts(): JsonResponse
    {
        try {
            $products = Products::where('status', true) // Only public products
                              ->orderBy('price_monthly', 'asc')
                              ->get();

            return response()->json([
                'success' => true,
                'message' => 'Available products retrieved successfully',
                'data' => $products
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to retrieve products',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Step 2: Get payment methods for selected product
     * 
     * @param string $productId
     * @return JsonResponse
     */
    public function getPaymentMethods(string $productId): JsonResponse
    {
        try {
            // Verify product exists
            $product = Products::findOrFail($productId);
            
            // Get active payment methods
            $paymentMethods = Payments::where('status', 'active')
                                    ->orderBy('payment_method')
                                    ->get();

            return response()->json([
                'success' => true,
                'message' => 'Payment methods retrieved successfully',
                'data' => [
                    'product' => $product,
                    'payment_methods' => $paymentMethods,
                    'billing_cycles' => [
                        'monthly' => 'Monthly',
                        'yearly' => 'Yearly',
                        'custom' => 'Custom'
                    ]
                ]
            ], 200);

        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Product not found'
            ], 404);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to retrieve payment methods',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Step 3: Create transaction after payment method selection
     * 
     * @param Request $request
     * @return JsonResponse
     */
    public function createTransaction(Request $request): JsonResponse
    {
        try {
            $validated = $request->validate([
                'user_id' => 'required|exists:users,id',
                'product_id' => 'required|exists:products,id',
                'payment_id' => 'required|exists:payments,id',
                'billing_cycle' => 'required|in:monthly,yearly,custom',
                'subdomain_web' => 'nullable|string|max:255|unique:transactions,subdomain_web',
                'subdomain_server' => 'nullable|string|max:255|unique:transactions,subdomain_server',
                'custom_period' => 'required_if:billing_cycle,custom|integer|min:1|max:36', // months
            ], [
                'user_id.required' => 'User is required',
                'user_id.exists' => 'User not found',
                'product_id.required' => 'Product is required',
                'product_id.exists' => 'Product not found',
                'payment_id.required' => 'Payment method is required',
                'payment_id.exists' => 'Payment method not found',
                'billing_cycle.required' => 'Billing cycle is required',
                'billing_cycle.in' => 'Billing cycle must be monthly, yearly, or custom',
                'subdomain_web.unique' => 'Subdomain web already taken',
                'subdomain_server.unique' => 'Subdomain server already taken',
                'custom_period.required_if' => 'Custom period is required when billing cycle is custom',
            ]);

            // Get product for price calculation
            $product = Products::findOrFail($validated['product_id']);
            
            // Calculate total payment based on billing cycle
            $totalPayment = $this->calculateTotalPayment($product->price_monthly, $validated['billing_cycle'], $validated['custom_period'] ?? null);
            
            // Calculate start and end dates
            $dates = $this->calculateDates($validated['billing_cycle'], $validated['custom_period'] ?? null);
            
            // Generate transaction code
            $validated['transaction_code'] = 'TXN-' . strtoupper(uniqid());
            $validated['status'] = 'pending_payment';
            $validated['total_payment'] = $totalPayment;
            $validated['start_date'] = $dates['start_date'];
            $validated['end_date'] = $dates['end_date'];

            $transaction = Transaction::create($validated);
            $transaction->load(['user', 'product', 'payment']);

            return response()->json([
                'success' => true,
                'message' => 'Transaction created successfully. Please proceed to payment.',
                'data' => $transaction
            ], 201);

        } catch (ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Validation failed',
                'errors' => $e->errors()
            ], 422);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to create transaction',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Step 4: Upload payment proof
     * 
     * @param Request $request
     * @param string $transactionId
     * @return JsonResponse
     */
    public function uploadPaymentProof(Request $request, string $transactionId): JsonResponse
    {
        try {
            $transaction = Transaction::findOrFail($transactionId);
            
            // Check if transaction is in correct status
            if ($transaction->status !== 'pending_payment') {
                return response()->json([
                    'success' => false,
                    'message' => 'Transaction is not in pending payment status'
                ], 400);
            }

            $validated = $request->validate([
                'payment_proof' => 'required|string|max:255',
            ], [
                'payment_proof.required' => 'Payment proof filename is required',
                'payment_proof.string' => 'Payment proof must be a valid filename',
                'payment_proof.max' => 'Payment proof filename too long',
            ]);

            // Update transaction - simpan nama file yang dikirim
            $transaction->update([
                'status' => 'pending_confirm',
                'payment_proof' => $validated['payment_proof']
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Payment proof uploaded successfully. Waiting for admin confirmation.',
                'data' => [
                    'transaction_code' => $transaction->transaction_code,
                    'status' => $transaction->status,
                    'payment_proof_filename' => $validated['payment_proof'],
                    'payment_proof_url' => Storage::url('payment_proofs/' . $validated['payment_proof'])
                ]
            ], 200);

        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Transaction not found'
            ], 404);

        } catch (ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Validation failed',
                'errors' => $e->errors()
            ], 422);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to upload payment proof',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Step 5: Admin confirm payment (Admin only)
     * 
     * @param Request $request
     * @param string $transactionId
     * @return JsonResponse
     */
    public function confirmPayment(Request $request, string $transactionId): JsonResponse
    {
        try {
            $transaction = Transaction::findOrFail($transactionId);
            
            // Check if transaction is in correct status
            if ($transaction->status !== 'pending_confirm') {
                return response()->json([
                    'success' => false,
                    'message' => 'Transaction is not in pending confirmation status'
                ], 400);
            }

            $validated = $request->validate([
                'action' => 'required|in:approve,reject',
                'admin_notes' => 'nullable|string|max:500',
            ], [
                'action.required' => 'Action is required',
                'action.in' => 'Action must be approve or reject',
            ]);

            if ($validated['action'] === 'approve') {
                $transaction->update([
                    'status' => 'active',
                    'admin_notes' => $validated['admin_notes'] ?? null,
                    'confirmed_at' => now()
                ]);
                $message = 'Payment confirmed successfully. Transaction is now active.';
            } else {
                $transaction->update([
                    'status' => 'rejected',
                    'admin_notes' => $validated['admin_notes'] ?? 'Payment rejected',
                ]);
                $message = 'Payment rejected.';
            }

            return response()->json([
                'success' => true,
                'message' => $message,
                'data' => $transaction->fresh(['user', 'product', 'payment'])
            ], 200);

        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Transaction not found'
            ], 404);

        } catch (ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Validation failed',
                'errors' => $e->errors()
            ], 422);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to confirm payment',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Get transaction details
     * 
     * @param string $id
     * @return JsonResponse
     */
    public function show(string $id): JsonResponse
    {
        try {
            $transaction = Transaction::with(['user', 'product', 'payment'])->findOrFail($id);

            return response()->json([
                'success' => true,
                'message' => 'Transaction retrieved successfully',
                'data' => $transaction
            ], 200);

        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Transaction not found'
            ], 404);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to retrieve transaction',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Get user's transactions
     * 
     * @param Request $request
     * @param string $userId
     * @return JsonResponse
     */
    public function getUserTransactions(Request $request, string $userId): JsonResponse
    {
        try {
            $perPage = $request->get('per_page', 10);
            $status = $request->get('status');

            $query = Transaction::with(['product', 'payment'])
                               ->where('user_id', $userId);

            if ($status) {
                $query->where('status', $status);
            }

            $transactions = $query->orderBy('created_at', 'desc')
                                 ->paginate($perPage);

            return response()->json([
                'success' => true,
                'message' => 'User transactions retrieved successfully',
                'data' => $transactions
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to retrieve user transactions',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Calculate total payment based on billing cycle
     */
    private function calculateTotalPayment(float $monthlyPrice, string $billingCycle, ?int $customPeriod = null): float
    {
        switch ($billingCycle) {
            case 'monthly':
                return $monthlyPrice;
            case 'yearly':
                return $monthlyPrice * 12 * 0.85; // 15% discount for yearly
            case 'custom':
                $months = $customPeriod ?? 1;
                $discount = $months >= 6 ? 0.9 : 1; // 10% discount for 6+ months
                return $monthlyPrice * $months * $discount;
            default:
                return $monthlyPrice;
        }
    }

    /**
     * Calculate start and end dates based on billing cycle
     */
    private function calculateDates(string $billingCycle, ?int $customPeriod = null): array
    {
        $startDate = Carbon::today();
        
        switch ($billingCycle) {
            case 'monthly':
                $endDate = $startDate->copy()->addMonth();
                break;
            case 'yearly':
                $endDate = $startDate->copy()->addYear();
                break;
            case 'custom':
                $months = $customPeriod ?? 1;
                $endDate = $startDate->copy()->addMonths($months);
                break;
            default:
                $endDate = $startDate->copy()->addMonth();
        }

        return [
            'start_date' => $startDate->toDateString(),
            'end_date' => $endDate->toDateString()
        ];
    }
}
