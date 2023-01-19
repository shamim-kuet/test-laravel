<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\News;
use App\Models\Subcategory;
use Illuminate\Http\Request;

class FilterController extends Controller
{
    public function index(){
        return view('admin.pages.filter.index', [
            'prefixname' => 'Search',
            'title' => 'Search List',
            'page_title' => 'Search List',
            'categories' => Category::where('status',1)->get(),
            'subcategories' => Subcategory::where('status',1)->get(),
            'news' => News::where('status',1)->paginate(20),
        ]);
    }

    public function filter(Request $request){

        $category_id = $request->get('category');
        $subcategory_id = $request->get('subcateogry');

        if($category_id && $subcategory_id){
            $story = News::where('category_id',$category_id)->where('subcategory_id', $subcategory_id)->where('status',1)->get();
        }
        elseif($category_id){
            $story = News::where('category_id',$category_id)->where('status',1)->get();
        }
//        else if($subcategory_id){
//            $story = News::where('subcategory_id', $subcategory_id)->where('status',1)->get();
//        }
//        else if($category_id && $subcategory_id){
//            $story = News::where('category_id',$category_id)->where('subcategory_id', $subcategory_id)->where('status',1)->get();
//        }
        else {
            $story = null;
        }

        return view('admin.pages.filter.search', [
            'prefixname' => 'Search',
            'title' => 'Search List',
            'page_title' => 'Search List',
            'categories' => Category::where('status',1)->get(),
            'subcategories' => Subcategory::where('status',1)->get(),
            'news' => $story
        ]);
    }

    public function ajaxGetSubcategoryData(Request $request){
        if($request->ajax()){
            $subcat = Subcategory::where('category_id',$request->category_id)->get()->pluck("full_name","id");
            return response()->json($subcat);
        }
    }
}
