<?php

namespace Aoeng\Laravel\Admin\Advertisement\Http\Controllers;

use Aoeng\Laravel\Admin\Advertisement\Models\Advertisement;
use Aoeng\Laravel\Support\Traits\ResponseJsonActions;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

/**
 * @group 广告图片 AdvertisementController
 * Class AdvertisementController
 * @package App\Http\Controllers
 */
class AdvertisementController extends Controller
{
    use ResponseJsonActions;

    /**
     * 广告列表 AdvertisementController_index
     * @bodyParam type string 类型的flag
     * @param Request $request
     * @return JsonResponse
     */
    public function index(Request $request)
    {
        $advertisements = Advertisement::query()
            ->when($request->input('type', false), function ($query, $type) {
                $query->whereHas('types', function ($query) use ($type) {
                    $query->where('flag', $type);
                });
            })
            ->where('is_display', 1)
            ->orderByDesc('sort')
            ->paginate();

        return $this->responseJson($advertisements);
    }

    /**
     * 广告详情 AdvertisementController_show
     * @bodyParam id int ID
     * @param Request $request
     * @return JsonResponse
     */
    public function show(Request $request)
    {
        $advertisement = Advertisement::query()
            ->where('is_display', 1)
            ->find($request->input('id'));

        return $this->responseJson($advertisement);
    }
}
