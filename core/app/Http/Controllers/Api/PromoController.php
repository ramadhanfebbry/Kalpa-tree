<?php

namespace App\Http\Controllers\Api;

use App\Branch;
use App\Promo;
use App\PromoFavorite;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;

class PromoController extends Controller
{
    /**
	 * @param Request $request
	 * @return type
	 */
    public function index(Request $request)
	{
		$keyword = $request->get('search');
		$latitude = $request->get('latitude');
		$longitude = $request->get('longitude');
		$radius = $request->get('radius');
		$R = 6371;
		$perPage = 15;
		
		$promos = Promo::actived();
		if (!empty($keyword)) {
			$promos = $promos->where('title', 'LIKE', "%$keyword%");
		}
		
		if (!empty($latitude) && !empty($longitude) && !empty($radius)) {
			$maxLatitude = $latitude + rad2deg($radius/$R);
			$minLatitude = $latitude - rad2deg($radius/$R);
			$maxLongitude = $longitude + rad2deg(asin($radius/$R) / cos(deg2rad($latitude)));
			$minLongitude = $longitude - rad2deg(asin($radius/$R) / cos(deg2rad($latitude)));
			
			$promos = $promos->whereBetween('latitude', [$minLatitude, $maxLatitude])
				->whereBetween('longitude', [$minLongitude, $maxLongitude]);
		}

        $promos = $promos->paginate($perPage);
		
		$promos = $promos->toArray();
		$promos['status'] = 200;
		
		return response()->json($promos, 200);
	}
	
	/**
	 * @param type $id
	 * @param Request $request
	 * @return type
	 */
	public function show($id)
	{
		$promo = Promo::with(['merchant'])->where('id', $id)->actived()->first();
		if (!$promo) {
			return response()->json([
				'status' => 404,
				'message' => 'Promo is not found',
			], 404);
		}
		
		$promo['branchs'] = Branch::actived()->whereIn('id', explode(',', $promo->id_branch))->get();
		
		return response()->json([
			'status' => 200,
			'data' => $promo
		], 200);
	}
	
	/**
	 * @param type $id
	 * @param Request $request
	 */
	public function showPromoByMerchant($id, Request $request)
	{
        $perPage = 15;
		$promos = Promo::where('id_merchant', $id)->actived()->paginate($perPage);
		if (!$promos) {
			return response()->json([
				'status' => 404,
				'message' => 'Promo is not found',
			], 404);
		}

		$promos = $promos->toArray();
		$promos['status'] = 200;
		
		return response()->json($promos, 200);
	}
	
	/**
	 * @param type $id
	 * @return type
	 */
	public function listSimiliarPromos($id)
	{
		$promo = Promo::find($id);
		if (!$promo) {
			return response()->json([
				'status' => 404,
				'message' => 'Promo is not found.',
			], 404);
		}
		
		$promos = Promo::actived()->where('id_promo_type', $promo->id_promo_type)->paginate(15);
		
		$promos = $promos->toArray();
		$promos['status'] = 200;
		
		return response()->json($promos, 200);
	}
	
	/**
	 * @param type $id
	 * @return type
	 */
	public function listPromoFavoriteByUserId($id)
	{
		$user = JWTAuth::parseToken()->authenticate();
		
		if ($user->id != $id) {
			return response()->json([
				'status' => 403,
				'message' => 'Token not syncronize with parameter user id',
			], 403);
		}
		
		$favorites = PromoFavorite::with(['promo', 'user'])->where('id_user', $user->id)->orderBy('created_at', 'desc')->paginate(15);
		if (!$favorites) {
			return response()->json([
				'status' => 404,
				'message' => 'Promo Favorites is not found.',
			], 404);
		}
		
		$favorites = $favorites->toArray();
		$favorites['status'] = 200;
		
		return response()->json($favorites, 200);
	}
}
