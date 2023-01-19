<?php

namespace App\Http\Controllers\frontend\v1;

use App\Http\Controllers\BaseController;
use App\Models\Product;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\URL;
use Illuminate\Validation\ValidationException;

class ProductController extends BaseController
{
    /**
     * Construct example controller
     */
     public function __construct()
     {
//         $this->middleware('auth:customer');
     }

    /**
     * Get products data from storage, also filter product
     * @return JsonResponse
     */
    public function index(Request $request)
    {
        $limit = $request['limit'] ? $request['limit'] : 15;
        $base_image_path = URL::to('/')."/uploads/product/thumbnail/";
        $base_image_path = '';

        /** DB query: query builder for faster query */
        $query = DB::table('products')->where('products.deleted_at', null)
            ->leftJoin('product_inventory', 'products.id', '=', 'product_inventory.product_id')
            ->where('status', 1)
            ->select('products.id', 'products.code', 'products.name', 'products.slug', 'products.product_type', 'products.avg_ratings',
                DB::raw("CONCAT('$base_image_path',products.main_image) AS image"),
                DB::raw("product_inventory.unit_price AS price"),
                DB::raw("product_inventory.discount_amount AS discount_amount"),
                DB::raw("product_inventory.discount AS discount"),
                DB::raw("product_inventory.discount_type AS discount_type")
            );
        /** Some basic filter */
        if ($request['city_id']) {
            $query->where("city_id", $request['city_id']);
        }
        if ($request['state_id']) {
            $query->where("state_id", $request['state_id']);
        }
        if ($request['country_id']) {
            $query->where("country_id", $request['country_id']);
        }
        if ($request['seller_id']) {
            $query->where("seller_id", $request['seller_id']);
        }
        if ($request['category_id']) {
            $query->where("category_id", $request['category_id']);
        }
        if ($request['sub_category_id']) {
            $query->where("sub_category_id", $request['sub_category_id']);
        }
        if ($request['sub_sub_category_id']) {
            $query->where("sub_sub_category_id", $request['sub_sub_category_id']);
        }
        if ($request['param'] === 'top-deal') {
            $query->where("top_deal", 1);
        }

        $data = $query->orderBy('name', 'asc')->simplePaginate($limit);

        return $this->successResponse($data, 'Data retrieved successfully', Response::HTTP_OK);
    }

    /**
     * Get a single product with product slug
     * @return JsonResponse
     */
    public function product($slug)
    {
        $check_exist = Product::where('slug', $slug)->where('status', 1)->exist();
        if ($check_exist) {
            $base_image_path = URL::to('/')."/uploads/product/thumbnail/";
            $data = Product::with('category:id,name', 'productInventories:id,product_id,initial_qty AS qty,unit_price AS price,discount_amount,discount,discount_type')
                ->select(DB::raw("CONCAT('$base_image_path',mainimage) AS image"), 'id', 'cat_id', 'name', 'slug', 'code', 'brand AS generic', 'manufacturer', 'details', 'features')
                ->where('slug', $slug)->where('status', 1)->first();
            $data['image_path'] = $base_image_path;
            return $this->successResponse($data, 'product details', Response::HTTP_OK);
        }else {
            $data[] = null;
            return $this->successResponse($data, 'No Data Found', Response::HTTP_OK);
        }
    }

    /**
     * Get new arrival products with six sub categories
     * @return JsonResponse
     */
    public function recentArrivalProducts(Request $request)
    {
        $limit = $request['limit'] ? $request['limit'] : 10;
        $base_image_path = URL::to('/')."/uploads/product/thumbnail/";
        $base_image_path = '';

        /** DB query: query builder for faster query */
        $query = DB::table('products')->where('products.deleted_at', null)
            ->leftJoin('product_inventory', 'products.id', '=', 'product_inventory.product_id')
            ->where('status', 1)->where('recent_arrival', 1)
            ->select('products.id', 'products.code', 'products.sub_category_id', 'products.name', 'products.slug', 'products.avg_ratings',
                DB::raw("CONCAT('$base_image_path',products.main_image) AS image"),
                DB::raw("product_inventory.unit_price AS price"),
                DB::raw("product_inventory.discount_amount AS discount_amount"),
            );
        /** Some basic filter */
        if ($request['city_id']) {
            $query->where("city_id", $request['city_id']);
        }
        if ($request['state_id']) {
            $query->where("state_id", $request['state_id']);
        }
        if ($request['country_id']) {
            $query->where("country_id", $request['country_id']);
        }
        $sub_query = $query;
        $data['sub_categories'] = DB::table('subcategories')->whereIn('id', $sub_query->pluck('sub_category_id')->unique())->limit(6)->select('id','name')->get();
        foreach ($data['sub_categories'] as $key => $sub_categories) {
            if ($request['sub_category_id'] && $request['sub_category_id'] == $sub_categories->id) {
                $sub_categories->flag = true;
                $data['products'] = $query->where('products.sub_category_id', $sub_categories->id)->orderBy('sequence', 'asc')->limit($limit)->get();
            }elseif(!$request['sub_category_id'] && $key === 0) {
                $sub_categories->flag = true;
                $data['products'] = $query->where('products.sub_category_id', $sub_categories->id)->orderBy('sequence', 'asc')->limit($limit)->get();
            }else {
                $sub_categories->flag = false;
            }
        }

        return $this->successResponse($data, 'Data retrieved successfully', Response::HTTP_OK);
    }
}
