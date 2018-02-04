<?php

namespace App\Http\Controllers\Root;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Slider;
use Illuminate\Http\Request;
use Session;
use Datatables;
use DB;
use Auth;

class SliderController extends Controller
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
        return view('root.slider.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('root.slider.create');
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
        $cek = Slider::max('order_no');
        if($cek>0)
            $request['order_no'] = $cek + 1;
        
        $files = $request['images'];
        $path = 'files/sliders/';
        $name = rand(10000,99999).'.'.$files->getClientOriginalExtension();
        $files->move($path,$name);
        $request['image'] = $name;
        $requestData = $request->all();

        $slider = Slider::create($requestData);

        Session::flash('flash_message', 'Slider added!');

        return redirect('root/slider');
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
        $slider = Slider::findOrFail($id);

        return view('root.slider.show', compact('slider'));
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
        $slider = Slider::findOrFail($id);

        return view('root.slider.edit', compact('slider'));
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
            $path = 'files/sliders/';
            $name = rand(10000,99999).'.'.$files->getClientOriginalExtension();
            $files->move($path,$name);
            $request['image'] = $name;
        }
        $requestData = $request->all();

        $slider = Slider::findOrFail($id);
        $slider->update($requestData);

        Session::flash('flash_message', 'Slider updated!');

        return redirect('root/slider');
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
        Slider::destroy($id);

        Session::flash('flash_message', 'Slider deleted!');

        return redirect('root/slider');
    }

    public function anyData(Request $request)
    {
        DB::statement(DB::raw('set @rownum=0'));
        $slider = Slider::select([
            DB::raw('@rownum  := @rownum  + 1 AS rownum'), 'id', 'title', 'image', 'order_no'])->orderBy('order_no');

         $datatables = app('datatables')->of($slider)
            ->editColumn('image', function($slider){
                return '<img src="'.url('files/sliders/').'/'.$slider->image.'" style="max-width:150px;" />';
            })
            ->addColumn('action', function ($slider) {
                return '<a href="slider/'.$slider->id.'/edit" class="btn btn-xs btn-primary rounded" data-toggle="tooltip" title="" data-original-title="'. trans('systems.edit') .'"><i class="fa fa-pencil"></i></a> <a onclick="deleteData('.$slider->id.')" class="btn btn-xs btn-danger rounded" data-toggle="tooltip" title="" data-original-title="'. trans('systems.delete') .'"><i class="fa fa-trash"></i></a>';
            });

        if ($keyword = $request->get('search')['value']) {
            $datatables->filterColumn('rownum', 'whereRaw', '@rownum  + 1 like ?', ["%{$keyword}%"]);
        }

        if ($range = $datatables->request->get('range')) {
            $rang = explode(":", $range);
            if($rang[0] != "Invalid date" && $rang[1] != "Invalid date" && $rang[0] != $rang[1]){
                $datatables->whereBetween('sliders.created_at', ["$rang[0] 00:00:00", "$rang[1] 23:59:59"]);
            }else if($rang[0] != "Invalid date" && $rang[1] != "Invalid date" && $rang[0] == $rang[1]) {
                $datatables->whereBetween('sliders.created_at', ["$rang[0] 00:00:00", "$rang[1] 23:59:59"]);
            }
        }

        return $datatables->make(true);
    }
}
