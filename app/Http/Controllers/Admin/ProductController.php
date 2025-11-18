<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Products;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\ValidationException;

class ProductController extends Controller
{
    /**
     * Display a listing of products.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function index(Request $request): JsonResponse
    {
        try {
            $perPage = $request->get('per_page', 10);
            $search = $request->get('search');
            $priceMin = $request->get('price_min');
            $priceMax = $request->get('price_max');
            $domainIncluded = $request->get('domain_included');
            $sshAccess = $request->get('ssh_access');
            $emailFeature = $request->get('email_feature');
            $databaseFeature = $request->get('database_feature');
            $sslIncluded = $request->get('ssl_included');
            $status = $request->get('status');

            $query = Products::query();

            // Search filter
            if ($search) {
                $query->where(function ($q) use ($search) {
                    $q->where('product_code', 'like', "%{$search}%")
                        ->orWhere('name_product', 'like', "%{$search}%")
                        ->orWhere('description', 'like', "%{$search}%");
                });
            }

            // Price range filter
            if ($priceMin) {
                $query->where('price_monthly', '>=', $priceMin);
            }

            if ($priceMax) {
                $query->where('price_monthly', '<=', $priceMax);
            }

            // Feature filters
            if ($domainIncluded !== null) {
                $query->where('domain_included', $domainIncluded);
            }

            if ($sshAccess !== null) {
                $query->where('ssh_access', $sshAccess);
            }

            if ($emailFeature !== null) {
                $query->where('email_feature', $emailFeature);
            }

            if ($databaseFeature !== null) {
                $query->where('database_feature', $databaseFeature);
            }

            if ($sslIncluded !== null) {
                $query->where('ssl_included', $sslIncluded);
            }

            // Status filter
            if ($status !== null) {
                $query->where('status', $status);
            }

            $products = $query->orderBy('created_at', 'desc')->paginate($perPage);

            return response()->json(
                [
                    'success' => true,
                    'message' => 'Products retrieved successfully',
                    'data' => $products,
                ],
                200,
            );
        } catch (\Exception $e) {
            return response()->json(
                [
                    'success' => false,
                    'message' => 'Failed to retrieve products',
                    'error' => $e->getMessage(),
                ],
                500,
            );
        }
    }

    /**
     * Store a newly created product.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function store(Request $request): JsonResponse
    {
        try {
            $validated = $request->validate(
                [
                    'name_product' => 'required|string|max:255',
                    'domain_included' => 'required|boolean',
                    'ssh_access' => 'required|boolean',
                    'email_feature' => 'required|boolean',
                    'database_feature' => 'required|boolean',
                    'ssl_included' => 'required|boolean',
                    'storage' => 'required|integer|min:1',
                    'price_monthly' => 'required|numeric|min:0',
                    'description' => 'nullable|string',
                    'status' => 'sometimes|boolean',
                ],
                [
                    'name_product.required' => 'Product name is required',
                    'domain_included.required' => 'Domain included field is required',
                    'ssh_access.required' => 'SSH access field is required',
                    'email_feature.required' => 'Email feature field is required',
                    'database_feature.required' => 'Database feature field is required',
                    'ssl_included.required' => 'SSL included field is required',
                    'storage.required' => 'Storage is required',
                    'storage.min' => 'Storage must be at least 1 GB',
                    'price_monthly.required' => 'Monthly price is required',
                    'price_monthly.min' => 'Price must be 0 or greater',
                    'status.boolean' => 'Status must be true (public) or false (draft)',
                ],
            );

            // Generate product code
            $validated['product_code'] = 'PROD-' . strtoupper(uniqid());

            // Set default status to public if not provided
            if (!isset($validated['status'])) {
                $validated['status'] = true;
            }

            $product = Products::create($validated);

            return response()->json(
                [
                    'success' => true,
                    'message' => 'Product created successfully',
                    'data' => $product,
                ],
                201,
            );
        } catch (ValidationException $e) {
            return response()->json(
                [
                    'success' => false,
                    'message' => 'Validation failed',
                    'errors' => $e->errors(),
                ],
                422,
            );
        } catch (\Exception $e) {
            return response()->json(
                [
                    'success' => false,
                    'message' => 'Failed to create product',
                    'error' => $e->getMessage(),
                ],
                500,
            );
        }
    }

    /**
     * Display the specified product.
     *
     * @param string $id
     * @return JsonResponse
     */
    public function show(string $id): JsonResponse
    {
        try {
            $product = Products::with('transactions')->findOrFail($id);

            return response()->json(
                [
                    'success' => true,
                    'message' => 'Product retrieved successfully',
                    'data' => $product,
                ],
                200,
            );
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json(
                [
                    'success' => false,
                    'message' => 'Product not found',
                ],
                404,
            );
        } catch (\Exception $e) {
            return response()->json(
                [
                    'success' => false,
                    'message' => 'Failed to retrieve product',
                    'error' => $e->getMessage(),
                ],
                500,
            );
        }
    }

    /**
     * Update the specified product.
     *
     * @param Request $request
     * @param string $id
     * @return JsonResponse
     */
    public function update(Request $request, string $id): JsonResponse
    {
        try {
            $product = Products::findOrFail($id);

            $validated = $request->validate(
                [
                    'name_product' => 'sometimes|required|string|max:255',
                    'domain_included' => 'sometimes|required|boolean',
                    'ssh_access' => 'sometimes|required|boolean',
                    'email_feature' => 'sometimes|required|boolean',
                    'database_feature' => 'sometimes|required|boolean',
                    'ssl_included' => 'sometimes|required|boolean',
                    'storage' => 'sometimes|required|integer|min:1',
                    'price_monthly' => 'sometimes|required|numeric|min:0',
                    'description' => 'sometimes|nullable|string',
                    'status' => 'sometimes|boolean',
                ],
                [
                    'storage.min' => 'Storage must be at least 1 GB',
                    'price_monthly.min' => 'Price must be 0 or greater',
                    'status.boolean' => 'Status must be true (public) or false (draft)',
                ],
            );

            $product->update($validated);

            return response()->json(
                [
                    'success' => true,
                    'message' => 'Product updated successfully',
                    'data' => $product->fresh(),
                ],
                200,
            );
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json(
                [
                    'success' => false,
                    'message' => 'Product not found',
                ],
                404,
            );
        } catch (ValidationException $e) {
            return response()->json(
                [
                    'success' => false,
                    'message' => 'Validation failed',
                    'errors' => $e->errors(),
                ],
                422,
            );
        } catch (\Exception $e) {
            return response()->json(
                [
                    'success' => false,
                    'message' => 'Failed to update product',
                    'error' => $e->getMessage(),
                ],
                500,
            );
        }
    }

    /**
     * Remove the specified product.
     *
     * @param string $id
     * @return JsonResponse
     */
    public function destroy(string $id): JsonResponse
    {
        try {
            $product = Products::findOrFail($id);

            // Check if product has associated transactions
            if ($product->transactions()->exists()) {
                return response()->json(
                    [
                        'success' => false,
                        'message' => 'Cannot delete product. It has associated transactions.',
                    ],
                    409,
                );
            }

            $product->delete();

            return response()->json(
                [
                    'success' => true,
                    'message' => 'Product deleted successfully',
                ],
                200,
            );
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json(
                [
                    'success' => false,
                    'message' => 'Product not found',
                ],
                404,
            );
        } catch (\Exception $e) {
            return response()->json(
                [
                    'success' => false,
                    'message' => 'Failed to delete product',
                    'error' => $e->getMessage(),
                ],
                500,
            );
        }
    }

    /**
     * Get product statistics.
     *
     * @return JsonResponse
     */
    public function statistics(): JsonResponse
    {
        try {
            $stats = [
                'total_products' => Products::count(),
                'avg_price' => Products::avg('price_monthly'),
                'max_price' => Products::max('price_monthly'),
                'min_price' => Products::min('price_monthly'),
                'features_stats' => [
                    'domain_included' => Products::where('domain_included', true)->count(),
                    'ssh_access' => Products::where('ssh_access', true)->count(),
                    'email_feature' => Products::where('email_feature', true)->count(),
                    'database_feature' => Products::where('database_feature', true)->count(),
                    'ssl_included' => Products::where('ssl_included', true)->count(),
                ],
                'recent_products' => Products::latest()->take(5)->get(),
            ];

            return response()->json(
                [
                    'success' => true,
                    'message' => 'Product statistics retrieved successfully',
                    'data' => $stats,
                ],
                200,
            );
        } catch (\Exception $e) {
            return response()->json(
                [
                    'success' => false,
                    'message' => 'Failed to retrieve product statistics',
                    'error' => $e->getMessage(),
                ],
                500,
            );
        }
    }

    /**
     * Get popular products (based on transaction count).
     *
     * @return JsonResponse
     */
    public function popular(): JsonResponse
    {
        try {
            $popularProducts = Products::withCount('transactions')->orderBy('transactions_count', 'desc')->take(10)->get();

            return response()->json(
                [
                    'success' => true,
                    'message' => 'Popular products retrieved successfully',
                    'data' => $popularProducts,
                ],
                200,
            );
        } catch (\Exception $e) {
            return response()->json(
                [
                    'success' => false,
                    'message' => 'Failed to retrieve popular products',
                    'error' => $e->getMessage(),
                ],
                500,
            );
        }
    }
}
