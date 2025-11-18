<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Payments;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\ValidationException;

class PaymentController extends Controller
{
    /**
     * Display a listing of payments.
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
            $method = $request->get('method');

            $query = Payments::query();

            // Search filter
            if ($search) {
                $query->where(function ($q) use ($search) {
                    $q->where('payment_code', 'like', "%{$search}%")
                        ->orWhere('payment_method', 'like', "%{$search}%")
                        ->orWhere('payment_bank', 'like', "%{$search}%")
                        ->orWhere('payment_account_name', 'like', "%{$search}%")
                        ->orWhere('payment_account_number', 'like', "%{$search}%");
                });
            }

            // Status filter
            if ($status) {
                $query->where('status', $status);
            }

            // Payment method filter
            if ($method) {
                $query->where('payment_method', $method);
            }

            $payments = $query->orderBy('created_at', 'desc')
                             ->paginate($perPage);

            return response()->json([
                'success' => true,
                'message' => 'Payments retrieved successfully',
                'data' => $payments
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to retrieve payments',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Store a newly created payment.
     * 
     * @param Request $request
     * @return JsonResponse
     */
    public function store(Request $request): JsonResponse
    {
        try {
            $validated = $request->validate([
                'payment_method' => 'required|string|in:bank_transfer,e_wallet,credit_card,cash',
                'payment_bank' => 'required|string|max:100',
                'payment_account_name' => 'required|string|max:255',
                'payment_account_number' => 'required|string|max:50',
                'status' => 'required|string|in:active,inactive'
            ], [
                'payment_method.required' => 'Payment method is required',
                'payment_method.in' => 'Payment method must be: bank_transfer, e_wallet, credit_card, or cash',
                'payment_bank.required' => 'Payment bank is required',
                'payment_account_name.required' => 'Account name is required',
                'payment_account_number.required' => 'Account number is required',
                'status.required' => 'Status is required',
                'status.in' => 'Status must be active or inactive'
            ]);

            // Generate payment code
            $validated['payment_code'] = 'PAY-' . strtoupper(uniqid());

            $payment = Payments::create($validated);

            return response()->json([
                'success' => true,
                'message' => 'Payment created successfully',
                'data' => $payment
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
                'message' => 'Failed to create payment',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Display the specified payment.
     * 
     * @param string $id
     * @return JsonResponse
     */
    public function show(string $id): JsonResponse
    {
        try {
            $payment = Payments::with('transactions')->findOrFail($id);

            return response()->json([
                'success' => true,
                'message' => 'Payment retrieved successfully',
                'data' => $payment
            ], 200);

        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Payment not found'
            ], 404);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to retrieve payment',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Update the specified payment.
     * 
     * @param Request $request
     * @param string $id
     * @return JsonResponse
     */
    public function update(Request $request, string $id): JsonResponse
    {
        try {
            $payment = Payments::findOrFail($id);

            $validated = $request->validate([
                'payment_method' => 'sometimes|required|string|in:bank_transfer,e_wallet,credit_card,cash',
                'payment_bank' => 'sometimes|required|string|max:100',
                'payment_account_name' => 'sometimes|required|string|max:255',
                'payment_account_number' => 'sometimes|required|string|max:50',
                'status' => 'sometimes|required|string|in:active,inactive'
            ], [
                'payment_method.in' => 'Payment method must be: bank_transfer, e_wallet, credit_card, or cash',
                'status.in' => 'Status must be active or inactive'
            ]);

            $payment->update($validated);

            return response()->json([
                'success' => true,
                'message' => 'Payment updated successfully',
                'data' => $payment->fresh()
            ], 200);

        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Payment not found'
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
                'message' => 'Failed to update payment',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Remove the specified payment.
     * 
     * @param string $id
     * @return JsonResponse
     */
    public function destroy(string $id): JsonResponse
    {
        try {
            $payment = Payments::findOrFail($id);
            
            // Check if payment has associated transactions
            if ($payment->transactions()->exists()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Cannot delete payment. It has associated transactions.'
                ], 409);
            }

            $payment->delete();

            return response()->json([
                'success' => true,
                'message' => 'Payment deleted successfully'
            ], 200);

        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Payment not found'
            ], 404);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to delete payment',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Get payment methods list.
     * 
     * @return JsonResponse
     */
    public function methods(): JsonResponse
    {
        $methods = [
            'bank_transfer' => 'Bank Transfer',
            'e_wallet' => 'E-Wallet',
            'credit_card' => 'Credit Card', 
            'cash' => 'Cash'
        ];

        return response()->json([
            'success' => true,
            'message' => 'Payment methods retrieved successfully',
            'data' => $methods
        ], 200);
    }

    /**
     * Get payment statistics.
     * 
     * @return JsonResponse
     */
    public function statistics(): JsonResponse
    {
        try {
            $stats = [
                'total_payments' => Payments::count(),
                'active_payments' => Payments::where('status', 'active')->count(),
                'inactive_payments' => Payments::where('status', 'inactive')->count(),
                'by_method' => Payments::selectRaw('payment_method, COUNT(*) as count')
                                     ->groupBy('payment_method')
                                     ->pluck('count', 'payment_method'),
                'recent_payments' => Payments::latest()->take(5)->get()
            ];

            return response()->json([
                'success' => true,
                'message' => 'Payment statistics retrieved successfully',
                'data' => $stats
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to retrieve payment statistics',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    // method untuk return get one data payment
    // public function getPayment($id): JsonResponse
    // {
    //     try {
    //         $payment = Payments::findOrFail($id);

    //         return response()->json([
    //             'success' => true,
    //             'message' => 'Payment retrieved successfully',
    //             'data' => $payment
    //         ], 200);

    //     } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
    //         return response()->json([
    //             'success' => false,
    //             'message' => 'Payment not found'
    //         ], 404);

    //     } catch (\Exception $e) {
    //         return response()->json([
    //             'success' => false,
    //             'message' => 'Failed to retrieve payment',
    //             'error' => $e->getMessage()
    //         ], 500);
    //     }
    // }
}
