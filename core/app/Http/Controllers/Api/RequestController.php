<?php

namespace App\Http\Controllers\Api;

use Auth;
use Validator;

use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

use App\Promo;
use DB;
use Hash;
use File;

class RequestController extends Controller {

    public function promoGet(Request $request) {
      $lat = $request->latitude;
      $lon = $request->longitude;

      $rad = $request->radius;
      $R = 6371;

      $maxLat = $lat + rad2deg($rad/$R);
      $minLat = $lat - rad2deg($rad/$R);
      $maxLon = $lon + rad2deg(asin($rad/$R) / cos(deg2rad($lat)));
      $minLon = $lon - rad2deg(asin($rad/$R) / cos(deg2rad($lat)));


      $promos = Promo::whereBetween("latitude", [$minLat, $maxLat])
      ->whereBetween("longitude", [$minLon, $maxLon])
      ->get();

      return response()->json($promos);
    }


}
