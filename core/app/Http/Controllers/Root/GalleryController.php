<?php

namespace App\Http\Controllers\Root;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Gallery;
use Illuminate\Http\Request;
use Session;
use Datatables;
use DB;
use Auth;

class GalleryController extends Controller
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
        return view('root.gallery.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('root.gallery.create');
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
        $request['order_no'] = 1;
        $cek = Gallery::max('order_no');
        if($cek>0)
            $request['order_no'] = $cek + 1;
        
        $files = $request['images'];
        if($files!=""){
            $path = 'files/galleries/';
            $name = rand(10000,99999).'.'.$files->getClientOriginalExtension();
            $files->move($path,$name);
            $request['image'] = $name;
        }
        $requestData = $request->all();

        $gallery = Gallery::create($requestData);

        Session::flash('flash_message', 'Gallery added!');

        return redirect('root/gallery');
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
        $gallery = Gallery::findOrFail($id);

        return view('root.gallery.show', compact('gallery'));
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
        $gallery = Gallery::findOrFail($id);

        return view('root.gallery.edit', compact('gallery'));
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
        $files = $request['images'];
        if($files!=""){
            $path = 'files/galleries/';
            $name = rand(10000,99999).'.'.$files->getClientOriginalExtension();
            $files->move($path,$name);
            $request['image'] = $name;
        }
        $requestData = $request->all();

        $gallery = Gallery::findOrFail($id);
        $gallery->update($requestData);

        Session::flash('flash_message', 'Gallery updated!');

        return redirect('root/gallery');
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
        Gallery::destroy($id);

        Session::flash('flash_message', 'Gallery deleted!');

        return redirect('root/gallery');
    }

    public function anyData(Request $request)
    {
        DB::statement(DB::raw('set @rownum=0'));
        $gallery = Gallery::select([
            DB::raw('@rownum  := @rownum  + 1 AS rownum'), 'id', 'title', 'descriptions', 'image']);

         $datatables = app('datatables')->of($gallery)
            ->editColumn('image', function($gallery){
                if($gallery->image!="")
                    return '<img src="'.url('files/galleries/').'/'.$gallery->image.'" style="max-width:150px;" />';
                else
                    return '-';
            })
            ->addColumn('action', function ($gallery) {
                return '<a href="gallery/'.$gallery->id.'/edit" class="btn btn-xs btn-primary rounded" data-toggle="tooltip" title="" data-original-title="'. trans('systems.edit') .'"><i class="fa fa-pencil"></i></a> <a onclick="deleteData('.$gallery->id.')" class="btn btn-xs btn-danger rounded" data-toggle="tooltip" title="" data-original-title="'. trans('systems.delete') .'"><i class="fa fa-trash"></i></a>';
            });

        if ($keyword = $request->get('search')['value']) {
            $datatables->filterColumn('rownum', 'whereRaw', '@rownum  + 1 like ?', ["%{$keyword}%"]);
        }

        if ($range = $datatables->request->get('range')) {
            $rang = explode(":", $range);
            if($rang[0] != "Invalid date" && $rang[1] != "Invalid date" && $rang[0] != $rang[1]){
                $datatables->whereBetween('galleries.created_at', ["$rang[0] 00:00:00", "$rang[1] 23:59:59"]);
            }else if($rang[0] != "Invalid date" && $rang[1] != "Invalid date" && $rang[0] == $rang[1]) {
                $datatables->whereBetween('galleries.created_at', ["$rang[0] 00:00:00", "$rang[1] 23:59:59"]);
            }
        }

        return $datatables->make(true);
    }
}
