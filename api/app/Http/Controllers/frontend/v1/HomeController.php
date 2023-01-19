<?php

namespace App\Http\Controllers\frontend\v1;

use App\Http\Controllers\BaseController;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

use App\Models\Banner;
use App\Models\Menu;
use App\Models\Content;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\URL;
use Symfony\Component\HttpFoundation\Response;

class HomeController extends BaseController
{
    /**
     * Return active banners
     * @return JsonResponse
     */
    public function banners(Request $request)
    {
        $imagePath = URL::to('/')."/uploads/banner/";
        $query = Banner::with('activeButtons:id,banner_id,name,route_link,color,bg_color')
            ->select('id', 'heading', 'meta_details', DB::raw("CONCAT('$imagePath',image) AS image"), 'alignment', 'banner_route_link')
            ->where('status', 1)->orderBy('sequence', 'asc');
        if ($request['limit']) {
            $query->limit($request['limit']);
        }
        $banners = $query->get();

        return $this->successResponse($banners, 'Data retrieved successfully', Response::HTTP_OK);
    }

    /**
     * Return all manus
     * @return JsonResponse
     */
    public function menus()
    {
        $menu = Menu::where('status', 1)->orderBy('sequence', 'asc')->get();

        return $this->successResponse($menu, 'All menu List', Response::HTTP_OK);
    }

    public function content(Request $request)
    {
        $content = Content::where('id', $request->id)->get();
        return $this->successResponse($content, 'All content List', Response::HTTP_OK);
    }
    public function homeContents()
    {
        $homeContents = HomeContent::where('status', 1)->orderBy('id', 'DESC')->get();
        return $this->successResponse($homeContents, 'All homeContents List', Response::HTTP_OK);
    }
}
