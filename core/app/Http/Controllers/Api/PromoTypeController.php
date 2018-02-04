<?php

namespace App\Http\Controllers\Api;

use App\PromoType;
use Illuminate\Http\Request;

class PromoTypeController extends Controller
{
    /**
	 * @param Request $request
	 * @return type
	 */
    public function index(Request $request)
	{
		$keyword = $request->get('search');
        $perPage = 15;

        if (!empty($keyword)) {
            $promoTypes = PromoType::where('name', 'LIKE', "%$keyword%")
				->orWhere('description', 'LIKE', "%$keyword%")
				->actived()
                ->paginate($perPage);
        } else {
            $promoTypes = PromoType::paginate($perPage);
        }
		
		$promoTypes = $promoTypes->toArray();
		$promoTypes['status'] = 200;
		
		return response()->json($promoTypes, 200);
	}
	
	/**
	 * @param type $id
	 * @param Request $request
	 * @return type
	 */
	public function show($id)
	{
		$merchant = PromoType::with(['promos'])->where('id', $id)->actived()->first();
		if (!$merchant) {
			return response()->json([
				'status' => 404,
				'message' => 'Promo Type is not found',
			], 404);
		}
		
		return response()->json([
			'status' => 200,
			'data' => $merchant
		], 200);
	}
}
