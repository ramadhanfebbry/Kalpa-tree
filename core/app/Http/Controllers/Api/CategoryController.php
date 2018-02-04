<?php

namespace App\Http\Controllers\Api;

use App\Category;
use App\Merchant;
use App\Promo;
use Illuminate\Http\Request;

class CategoryController extends Controller
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
            $categories = Category::where('name', 'LIKE', "%$keyword%")
				->orWhere('description', 'LIKE', "%$keyword%")
				->actived()
                ->paginate($perPage);
        } else {
            $categories = Category::actived()->paginate($perPage);
        }
		
		foreach ($categories as $category) :
			$merchant = Merchant::actived()->select(['id'])->where('id_category', $category->id)->get();
			$category['promo_total'] = Promo::whereIn('id_merchant', $merchant)->actived()->count();
		endforeach;
		
		$categories = $categories->toArray();
		$categories['status'] = 200;
		
		return response()->json($categories, 200);
	}
	
	/**
	 * @param type $id
	 * @param Request $request
	 * @return type
	 */
	public function show($id)
	{
		$category = Category::where('id', $id)->actived()->first();
		if (!$category) {
			return response()->json([
				'status' => 404,
				'message' => 'Bank is not found',
			], 404);
		}
		
		return response()->json([
			'status' => 200,
			'data' => $category
		], 200);
	}
}
