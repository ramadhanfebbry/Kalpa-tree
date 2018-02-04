<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Addons;
use App\Content;
use App\Slider;
use App\Event;
use App\Gallery;
use App\Career;
use App\Contact;
use Illuminate\Http\Request;
use Session;
use Datatables;
use DB;
use Auth;
use File;

class WebController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $animation = Slider::where('order_no','1')->first();
        $slider = Slider::where('order_no','!=','1')->orderBy('order_no')->get();
        $about = Content::whereMenu('about')->first();
        $menus = Content::whereMenu('menus')->first();
        $event = Event::orderBy('order_no')->get();
        $gallery = Gallery::orderBy('order_no')->get();
        $teams = Content::whereMenu('our-teams')->first();
        $team = Addons::whereIdContent($teams['id'])->orderBy('order_no')->get();
        $career = Career::orderBy('id')->get();
        $location = Content::whereMenu('location')->first();
		
		$coffees = \App\Page::typeCoffee()->ordered()->actived()->get();
		$restaurants = \App\Page::typeRestaurant()->ordered()->actived()->get();
		$barLounges = \App\Page::typeBarLounge()->ordered()->actived()->get();
        
        return view('web.index', compact('slider', 'about', 'menus', 'event', 'gallery', 'teams', 'team', 'career', 'location', 'animation',
				'coffees', 'restaurants', 'barLounges'));
    }
    
    public function appetizer()
    {
        $appetizer = Content::whereMenu('appetizer')->first();
        $addon = Addons::whereIdContent($appetizer['id'])->get();
        
        return view('web.appetizer', compact('appetizer', 'addon'));
    }
    
    public function maindishes()
    {
        $maindishes = Content::whereMenu('main-dishes')->first();
        $addon = Addons::whereIdContent($maindishes['id'])->get();
        
        return view('web.main-dishes', compact('maindishes', 'addon'));
    }
    
    public function desserts()
    {
        $desserts = Content::whereMenu('desserts')->first();
        $addon = Addons::whereIdContent($desserts['id'])->get();
        
        return view('web.desserts', compact('desserts', 'addon'));
    }
    
    public function drinks()
    {
        $drinks = Content::whereMenu('drinks')->first();
        $addon = Addons::whereIdContent($drinks['id'])->get();
        
        return view('web.drinks', compact('drinks', 'addon'));
    }
    
    public function sendcontact(Request $req)
    {
        Contact::create($req->all());
        
        return redirect('/');
    }
}
