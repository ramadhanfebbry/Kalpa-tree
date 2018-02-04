<?php

namespace App\Http\Controllers\Api;

use App\Bank;
use App\Category;
use App\PromoType;
use Illuminate\Http\Request;

class BankController extends Controller
{
	/**
	 * Bank, Category, PromoType
	 * 
	 * @return type
	 */
	public function all()
	{
		$banks = Bank::actived()->get();
		$categories = Category::actived()->get();
		$promoTypes = PromoType::actived()->get();
		
		$results = [];
		foreach ($banks as $bank) :
			$results['banks'][] = $bank;
		endforeach;
		foreach ($categories as $category) :
			$results['categories'][] = $category;
		endforeach;
		foreach ($promoTypes as $promoType) :
			$results['promo_types'][] = $promoType;
		endforeach;
		
		return response()->json([
			'status' => 200,
			'data' => $results,
		], 200);
	}
	
	/**
	 * @param Request $request
	 * @return type
	 */
    public function index(Request $request)
	{
		$keyword = $request->get('search');
        $perPage = 15;

		$banks = Bank::actived()->orderBy('name');
        if (!empty($keyword)) {
            $banks = $banks->where('name', 'LIKE', "%$keyword%")
				->orWhere('description', 'LIKE', "%$keyword%");
		}
        $banks = $banks->paginate($perPage);
		
		$banks = $banks->toArray();
		$banks['status'] = 200;
		
		return response()->json($banks, 200);
	}
	
	/**
	 * @param type $id
	 * @param Request $request
	 * @return type
	 */
	public function show($id)
	{
		$bank = Bank::with(['promos'])->where('id', $id)->actived()->first();
		if (!$bank) {
			return response()->json([
				'status' => 404,
				'message' => 'Bank is not found',
			], 404);
		}
		
		return response()->json([
			'status' => 200,
			'data' => $bank
		], 200);
	}
}
