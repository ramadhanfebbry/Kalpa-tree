<?php

namespace App\Http\Controllers\Api;

use App\Merchant;
use App\MerchantReview;
use Illuminate\Http\Request;

class MerchantController extends Controller
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
		$sort = $request->get('sort');
		$R = 6371;
		$perPage = 15;
		
		$merchants = Merchant::with(['category', 'merchantImages', 'branchs', 'merchantReviews'])->actived();
		if (!empty($keyword)) {
			$merchants = $merchants->where('name', 'LIKE', "%$keyword%");
		}
		
		if (!empty($latitude) && !empty($longitude) && !empty($radius)) {
			$maxLatitude = $latitude + rad2deg($radius/$R);
			$minLatitude = $latitude - rad2deg($radius/$R);
			$maxLongitude = $longitude + rad2deg(asin($radius/$R) / cos(deg2rad($latitude)));
			$minLongitude = $longitude - rad2deg(asin($radius/$R) / cos(deg2rad($latitude)));
			
			$merchants = $merchants->whereBetween('latitude', [$minLatitude, $maxLatitude])
				->whereBetween('longitude', [$minLongitude, $maxLongitude]);
		}
		
		if (!empty($sort)) {
			switch($sort) {
				case 'most_view':
					$merchants = $merchants->orderBy('most_view', 'desc');
					break;
				case 'price':
					$merchants = $merchants->orderBy('price_range', 'desc');
					break;
				case 'recomended':
					//$merchants = $merchants->orderBy('merchant_reviews.exceptional', 'desc');
					break;
			}
		}
		
		$merchants = $merchants->paginate($perPage);
		foreach ($merchants as $merchant) :
			$merchant['exceptional'] = $merchant->reviewExceptional();
		endforeach;
		
		$merchants = $merchants->toArray();
		$merchants['status'] = 200;
		
		return response()->json($merchants, 200);
	}
	
	/**
	 * @param type $id
	 * @param Request $request
	 * @return type
	 */
	public function show($id)
	{
		$merchant = Merchant::with(['category', 'merchantImages', 'branchs', 'merchantOpeningHours'])->where('id', $id)->actived()->first();
		if (!$merchant) {
			return response()->json([
				'status' => 404,
				'message' => 'Merchant is not found',
			], 404);
		}
		
		$merchant['exceptional'] = $merchant->reviewExceptional();
		$merchant['people_rated'] = $merchant->reviewPeopleRated();
		
		return response()->json([
			'status' => 200,
			'data' => $merchant
		], 200);
	}
	
	/**
	 * @param type $id
	 * @return type
	 */
	public function merchantReviewByMerchantId($id)
	{
		$merchantReviews = MerchantReview::with(['merchant', 'user'])->where('id_merchant', $id)->actived()->get();
		if (!$merchantReviews) {
			return response()->json([
				'status' => 404,
				'message' => 'Merchant Reviews is not found',
			], 404);
		}
		
		return response()->json([
			'status' => 200,
			'data' => $merchantReviews,
		], 200);
	}
	
	/**
	 * save merchant review must be there the token
	 * method POST
	 * 
	 * @param Request $request
	 * @return type
	 */
	public function saveMerchantReview(Request $request)
	{
		$validator = \Validator::make($request->all(), [
			'id_merchant' => 'required|exists:merchants,id',
			'id_user' => 'required|exists:users,id', // unique id_user and id_merchant
			'cleaniess' => 'required|numeric|min:1|max:5',
			'service' => 'required|numeric|min:1|max:5',
			'food_dining' => 'required|numeric|min:1|max:5',
			'facilities' => 'required|numeric|min:1|max:5',
			'room_comfort' => 'required|numeric|min:1|max:5',
			'value_for_money' => 'required|numeric|min:1|max:5',
		]);
		
		$request['status'] = MerchantReview::STATUS_ACTIVE;
		
		if ($validator->fails()) {
			return response()->json([
				'status' => 400,
				'message' => 'Some Parameters is required',
				'validators' => $validator->errors(),
			], 400);
		} else {
			$only = $request->only(['cleaniess', 'service', 'food_dining', 'facilities', 'room_comfort', 'value_for_money']);
			$request['exceptional'] = collect($only)->avg();
			
			$review = MerchantReview::create($request->all());
			
			return response()->json([
				'status' => 201,
				'message' => 'Review is successfully saved.',
				'data' => $review,
			], 201);
		}
	}
	
	/**
	 * this action must be there the token
	 * method POST
	 * 
	 * @param type $merchantId
	 * @param type $userId
	 * @return type
	 */
	public function merchantReviewCheckAvailability(Request $request)
	{
		$validator = \Validator::make($request->all(), [
			'id_merchant' => 'required|exists:merchants,id',
			'id_user' => 'required|exists:users,id',
		]);
		
		if ($validator->fails()) {
			return response()->json([
				'status' => 400,
				'message' => 'Some Parameters is required',
				'validators' => $validator->errors(),
			], 400);
		}
		
		$merchantId = $request->id_merchant;
		$userId = $request->id_user;
		
		$merchantReview = MerchantReview::where('id_merchant', $merchantId)
				->where('id_user', $userId)
				->actived()
				->first();
		
		if (!$merchantReview) {
			return response()->json([
				'status' => 404,
				'is_availabe' => true,
				'message' => 'Review is not found, this user is available to submit review',
			], 404);
		}
		
		return response()->json([
			'status' => 200,
			'is_availabe' => false,
			'message' => 'Review has found.',
		], 200);
	}
	
	private function getMerchantReviewAverage($id)
	{
		$merchantReview = MerchantReview::where('id_merchant', $id);
		$data = [
			'cleaniess' => number_format($merchantReview->avg('cleaniess'), 1),
			'service' => number_format($merchantReview->avg('service'), 1),
			'food_dining' => number_format($merchantReview->avg('food_dining'), 1),
			'facilities' => number_format($merchantReview->avg('facilities'), 1),
			'room_comfort' => number_format($merchantReview->avg('room_comfort'), 1),
			'value_for_money' => number_format($merchantReview->avg('value_for_money'), 1),
		];
		
		return [
			'total' => $merchantReview->count(),
			'people_rated' => $merchantReview->count(),
			'exceptional' => number_format(collect($data)->avg(), 1),
			'data' => $data,
		];
	}
	
	/**
	 * @param type $id
	 * @return type
	 */
	public function merchantReviewAverageByMerchantId($id)
	{
		$data = $this->getMerchantReviewAverage($id);
		$data = array_merge(['status' => 200], $data);
		
		return response()->json($data);
	}
	
	/**
	 * @param type $id
	 * @return type
	 */
	public function saveMostViewCounter($id)
	{
		$merchant = Merchant::where('id', $id)->actived()->first();
		if (!$merchant) {
			return response()->json([
				'status' => 404,
				'message' => 'Merchant is not found.',
			], 404);
		}
		
		$merchant->most_view = $merchant->most_view + 1;
		$merchant->save();
		
		return response()->json([
			'status' => 200,
			'message' => 'Merchant Most view is successfully modified.',
			'data' => $merchant,
		], 200);
	}
}
