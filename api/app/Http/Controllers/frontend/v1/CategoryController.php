<?php

namespace App\Http\Controllers\frontend\v1;

use App\Http\Controllers\BaseController;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductInventory;
use App\Models\Subcategory;
use App\Models\SubSubcategory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\URL;
use Illuminate\Validation\ValidationException;

class CategoryController extends BaseController
{


    /**
     * Construct example controller
     */
     public function __construct()
     {
//        $this->middleware('auth:customer');
     }

    /**
     * Get resources data from storage
     * @return JsonResponse
     */
    public function index(Request $request)
    {
        $base_icon_path = URL::to('/')."/uploads/category/";
        $base_icon_path = '';
        $query = DB::table('categories')->where('categories.deleted_at', null)
            ->select( 'id', 'name', 'slug', DB::raw("CONCAT('$base_icon_path',image) AS image"))
            ->where('status', 1);
        if ($request['type']) {
            $query->where('type', $request['type']);
        }
        $query->orderBy('sequence', 'ASC');
        if ($request['limit']) {
            $query->limit($request['limit']);
        }
        $data = $query->get();

        return $this->successResponse($data, 'Data retrieved successfully', Response::HTTP_OK);
    }

    /**
     * Get resources data from storage
     * @return JsonResponse
     */
    public function subCategories(Request $request)
    {
        $base_icon_path = URL::to('/')."/uploads/category/";
        $base_icon_path = '';
        $query = DB::table('subcategories')->where('subcategories.deleted_at', null)
            ->select( 'id', 'name', 'slug', DB::raw("CONCAT('$base_icon_path',image) AS image"))
            ->where('status', 1);
        if ($request['type']) {
            $query->where('type', $request['type']);
        }
        $query->orderBy('sequence', 'ASC');
        if ($request['limit']) {
            $query->limit($request['limit']);
        }
        $data = $query->get();

        return $this->successResponse($data, 'Data retrieved successfully', Response::HTTP_OK);
    }

    /**
     * Get sub categories data with sub-sub categories from storage
     * @return JsonResponse
     * @throws ValidationException
     */
    public function subCategoryWithSubSubCategory(Request $request)
    {
        $this->validate($request, [
            'category_id'      => 'required|exists:categories,id',
        ]);
        $base_icon_path = URL::to('/')."/uploads/category/";
        $base_icon_path = '';
        $query = Subcategory::with('activeSubSubCategories:id,category_id,sub_category_id,name,slug')->where('category_id', $request['category_id'])
            ->where('status', 1)->where('subcategories.deleted_at', null)
            ->select( 'id', 'category_id', 'name', 'slug', DB::raw("CONCAT('$base_icon_path',image) AS image"));
        if ($request['type']) {
            $query->where('type', $request['type']);
        }
        $query->orderBy('sequence', 'ASC');
        if ($request['limit']) {
            $query->limit($request['limit']);
        }
        $data = $query->get();

        return $this->successResponse($data, 'Data retrieved successfully', Response::HTTP_OK);
    }

    /**
     * Get category with sub category with sub-sub categories
     * @return JsonResponse
     */
    public function categoryWithSubCategoryWithSubSubCategory(Request $request)
    {
        $base_icon_path = URL::to('/')."/uploads/category/";
        $query = Category::with( 'activeSubCategories:id,category_id,name,slug', 'activeSubCategories.activeSubSubCategories:id,category_id,sub_category_id,name,slug')
            ->has('activeSubCategories')->where('status', 1)->select( 'id', 'name', 'slug', DB::raw("CONCAT('$base_icon_path',icon) AS icon"))
            ->where('categories.deleted_at', null);
        $query->orderBy('sequence', 'ASC');
        if ($request['limit']) {
            $query->limit($request['limit']);
        }
        $data = $query->get();

        return $this->successResponse($data, 'Data retrieved successfully', Response::HTTP_OK);
    }
}
