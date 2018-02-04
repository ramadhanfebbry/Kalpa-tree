<?php

namespace App\Http\Controllers\Root;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Addons;
use App\Content;
use Illuminate\Http\Request;
use Session;
use Datatables;
use DB;
use Auth;
use File;

class DrinksController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('root');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        return view('root.drinks.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $addon = array(
            '-'         =>  'Default',
            'images'    =>  'Images',
            'table'     =>  'Table',
            'column'    =>  'Column'
        );
        
        return view('root.drinks.create',compact('addon'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        $request['menu'] = 'drinks';
        $requestData = $request->all();
        $drinks = Content::create($requestData);

        Session::flash('flash_message', 'Content added!');

        return redirect('root/drinks');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        $drinks = Content::findOrFail($id);
        $addons = Addons::whereIdContent($id)->orderBy('order_no')->get();

        return view('root.drinks.show', compact('drinks','addons'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $addon = array(
            '-'         =>  'Default',
            'images'    =>  'Images',
            'table'     =>  'Table',
            'column'    =>  'Column'
        );
        
        $drinks = Content::findOrFail($id);

        return view('root.drinks.edit', compact('drinks', 'addon'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update($id, Request $request)
    {
        $drinks = Content::findOrFail($id);
        $requestData = $request->all();

        $drinks->update($requestData);

        Session::flash('flash_message', 'Content updated!');

        return redirect('root/drinks');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        $drinks = Content::findOrFail($id);
        Content::destroy($id);

        Session::flash('flash_message', 'Content deleted!');

        return redirect('root/drinks');
    }

    public function anyData(Request $request)
    {
        DB::statement(DB::raw('set @rownum=0'));
        $drinks = Content::select([
            DB::raw('@rownum  := @rownum  + 1 AS rownum'), 'id', 'title', 'intro', 'descriptions', 'menu', 'addons'])->whereMenu('drinks');

         $datatables = app('datatables')->of($drinks)
            ->editColumn('title', function ($drinks){
                return '<a href="drinks/'.$drinks->id.'">'.$drinks->title.'</a>';
            })
            ->addColumn('action', function ($drinks) {
                return '<a href="drinks/'.$drinks->id.'/edit" class="btn btn-xs btn-primary rounded" data-toggle="tooltip" title="" data-original-title="'. trans('systems.edit') .'"><i class="fa fa-pencil"></i></a> <a onclick="deleteData('.$drinks->id.')" class="btn btn-xs btn-danger rounded" data-toggle="tooltip" title="" data-original-title="'. trans('systems.delete') .'"><i class="fa fa-trash"></i></a>';
            });

        if ($keyword = $request->get('search')['value']) {
            $datatables->filterColumn('rownum', 'whereRaw', '@rownum  + 1 like ?', ["%{$keyword}%"]);
        }

        if ($range = $datatables->request->get('range')) {
            $rang = explode(":", $range);
            if($rang[0] != "Invalid date" && $rang[1] != "Invalid date" && $rang[0] != $rang[1]){
                $datatables->whereBetween('contents.created_at', ["$rang[0] 00:00:00", "$rang[1] 23:59:59"]);
            }else if($rang[0] != "Invalid date" && $rang[1] != "Invalid date" && $rang[0] == $rang[1]) {
                $datatables->whereBetween('contents.created_at', ["$rang[0] 00:00:00", "$rang[1] 23:59:59"]);
            }
        }

        return $datatables->make(true);
    }
    
    public function deleteaddons($id)
    {
        $addons = Addons::findOrFail($id);
        File::delete('files/drinks/'.$addons->image);
        Addons::destroy($id);
        
        return 1;
    }
    
    
    public function addaddons($id)
    {
        $drinks = Content::findOrFail($id);
        
        return view('root.drinks.add-addons', compact('drinks'));
    }
    
    public function saveaddons($id, Request $request)
    {
        $drinks = Content::findOrFail($id);
        $addon = Addons::whereIdContent($id)->max('order_no');
        $order = $addon + 1;
        
        $req['id_content'] = $id;
        $req['title'] = $request->title;
        $req['descriptions'] = $request->descriptions;
        $req['order_no'] = $order;
        $images = $request->images;
        $req['image'] = '-';
        if($images!=""){
            $images = $request['images'];
            $path = 'files/drinks/';
            $name = rand(10000,99999).'.'.$images->getClientOriginalExtension();
            $images->move($path,$name);
            $req['image'] = $name;   
        }
        Addons::create($req);
        
        return redirect('root/drinks/'.$id);
    }
    
    public function editaddons($id)
    {
        $addons = Addons::findOrFail($id);
        $drinks = Content::findOrFail($addons->id_content);
        
        return view('root.drinks.edit-addons', compact('addons','drinks'));
    }
    
    public function updateaddons($id, Request $request)
    {
        $addons = Addons::findOrFail($id);
        $drinks = Content::findOrFail($addons->id_content);
        
        $req['id_content'] = $drinks->id;
        $req['title'] = $request->title;
        $req['descriptions'] = $request->descriptions;
        $req['order_no'] = $request->order_no;
        $images = $request->images;
        if($images!=""){
            $images = $request['images'];
            $path = 'files/drinks/';
            $name = rand(10000,99999).'.'.$images->getClientOriginalExtension();
            $images->move($path,$name);
            $req['image'] = $name;   
            File::delete($path.$addons->image);
        }
        
        $addons->update($req);
        
        return redirect('root/drinks/'.$drinks->id);
    }
}
