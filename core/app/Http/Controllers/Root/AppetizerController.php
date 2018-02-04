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

class AppetizerController extends Controller
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
        return view('root.appetizer.index');
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
        
        return view('root.appetizer.create',compact('addon'));
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
        $request['menu'] = 'appetizer';
        $requestData = $request->all();
        $appetizer = Content::create($requestData);

        Session::flash('flash_message', 'Content added!');

        return redirect('root/appetizer');
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
        $appetizer = Content::findOrFail($id);
        $addons = Addons::whereIdContent($id)->orderBy('order_no')->get();

        return view('root.appetizer.show', compact('appetizer','addons'));
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
        
        $appetizer = Content::findOrFail($id);

        return view('root.appetizer.edit', compact('appetizer', 'addon'));
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
        $appetizer = Content::findOrFail($id);
        $requestData = $request->all();

        $appetizer->update($requestData);

        Session::flash('flash_message', 'Content updated!');

        return redirect('root/appetizer');
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
        $appetizer = Content::findOrFail($id);
        Content::destroy($id);

        Session::flash('flash_message', 'Content deleted!');

        return redirect('root/appetizer');
    }

    public function anyData(Request $request)
    {
        DB::statement(DB::raw('set @rownum=0'));
        $appetizer = Content::select([
            DB::raw('@rownum  := @rownum  + 1 AS rownum'), 'id', 'title', 'intro', 'descriptions', 'menu', 'addons'])->whereMenu('appetizer');

         $datatables = app('datatables')->of($appetizer)
            ->editColumn('title', function ($appetizer){
                return '<a href="appetizer/'.$appetizer->id.'">'.$appetizer->title.'</a>';
            })
            ->addColumn('action', function ($appetizer) {
                return '<a href="appetizer/'.$appetizer->id.'/edit" class="btn btn-xs btn-primary rounded" data-toggle="tooltip" title="" data-original-title="'. trans('systems.edit') .'"><i class="fa fa-pencil"></i></a> <a onclick="deleteData('.$appetizer->id.')" class="btn btn-xs btn-danger rounded" data-toggle="tooltip" title="" data-original-title="'. trans('systems.delete') .'"><i class="fa fa-trash"></i></a>';
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
        File::delete('files/appetizer/'.$addons->image);
        Addons::destroy($id);
        
        return 1;
    }
    
    
    public function addaddons($id)
    {
        $appetizer = Content::findOrFail($id);
        
        return view('root.appetizer.add-addons', compact('appetizer'));
    }
    
    public function saveaddons($id, Request $request)
    {
        $appetizer = Content::findOrFail($id);
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
            $path = 'files/appetizer/';
            $name = rand(10000,99999).'.'.$images->getClientOriginalExtension();
            $images->move($path,$name);
            $req['image'] = $name;   
        }
        Addons::create($req);
        
        return redirect('root/appetizer/'.$id);
    }
    
    public function editaddons($id)
    {
        $addons = Addons::findOrFail($id);
        $appetizer = Content::findOrFail($addons->id_content);
        
        return view('root.appetizer.edit-addons', compact('addons','appetizer'));
    }
    
    public function updateaddons($id, Request $request)
    {
        $addons = Addons::findOrFail($id);
        $appetizer = Content::findOrFail($addons->id_content);
        
        $req['id_content'] = $appetizer->id;
        $req['title'] = $request->title;
        $req['descriptions'] = $request->descriptions;
        $req['order_no'] = $request->order_no;
        $images = $request->images;
        if($images!=""){
            $images = $request['images'];
            $path = 'files/appetizer/';
            $name = rand(10000,99999).'.'.$images->getClientOriginalExtension();
            $images->move($path,$name);
            $req['image'] = $name;   
            File::delete($path.$addons->image);
        }
        
        $addons->update($req);
        
        return redirect('root/appetizer/'.$appetizer->id);
    }
}
