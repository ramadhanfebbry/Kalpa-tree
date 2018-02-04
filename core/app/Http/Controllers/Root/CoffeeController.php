<?php

namespace App\Http\Controllers\Root;

use App\Gallery;
use App\Http\Controllers\Controller;
use App\Page;
use DB;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Session;

class CoffeeController extends Controller
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
        return view('root.coffee.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('root.coffee.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     *
     * @return RedirectResponse|Redirector
     */
    public function store(Request $request)
    {
        $request['order_no'] = 1;
        $cek = Page::max('order_no');
        if($cek>0)
            $request['order_no'] = $cek + 1;
        
        $files = $request['images'];
        if($files!=""){
            $path = 'files/pages/';
            $name = rand(10000,99999).'.'.$files->getClientOriginalExtension();
            $files->move($path,$name);
            $request['image'] = $name;
        }
        $requestData = $request->all();
		$requestData['type'] = Page::TYPE_COFFEE;

        $page = Page::create($requestData);

        Session::flash('flash_message', 'Coffee added!');

        return redirect('root/coffee');
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
        $page = Page::findOrFail($id);

        return view('root.coffee.show', compact('page'));
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
        $page = Page::findOrFail($id);

        return view('root.coffee.edit', compact('page'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @param Request $request
     *
     * @return RedirectResponse|Redirector
     */
    public function update($id, Request $request)
    {
        $files = $request['images'];
        if($files!=""){
            $path = 'files/pages/';
            $name = rand(10000,99999).'.'.$files->getClientOriginalExtension();
            $files->move($path,$name);
            $request['image'] = $name;
        }
        $requestData = $request->all();

        $page = Page::findOrFail($id);
        $page->update($requestData);

        Session::flash('flash_message', 'Coffee updated!');

        return redirect('root/coffee');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     *
     * @return RedirectResponse|Redirector
     */
    public function destroy($id)
    {
        Page::destroy($id);

        Session::flash('flash_message', 'Coffee deleted!');

        return redirect('root/coffee');
    }

    public function anyData(Request $request)
    {
        DB::statement(DB::raw('set @rownum=0'));
        $page = Page::select([
            DB::raw('@rownum  := @rownum  + 1 AS rownum'), 'id', 'title', 'image', 'status', 'order_no'])
				->typeCoffee()
				->ordered();

         $datatables = app('datatables')->of($page)
            ->editColumn('image', function($page){
                if($page->image!="")
                    return '<img src="'.url('files/pages/').'/'.$page->image.'" style="max-width:150px;" />';
                else
                    return '-';
            })
			->editColumn('status', function($page){
                return $page->getStatusLabel();
            })
            ->addColumn('action', function ($page) {
                return '<a href="coffee/'.$page->id.'/edit" class="btn btn-xs btn-primary rounded" data-toggle="tooltip" title="" data-original-title="'. trans('systems.edit') .'"><i class="fa fa-pencil"></i></a> <a onclick="deleteData('.$page->id.')" class="btn btn-xs btn-danger rounded" data-toggle="tooltip" title="" data-original-title="'. trans('systems.delete') .'"><i class="fa fa-trash"></i></a>';
            });

        if ($keyword = $request->get('search')['value']) {
            $datatables->filterColumn('rownum', 'whereRaw', '@rownum  + 1 like ?', ["%{$keyword}%"]);
        }

        if ($range = $datatables->request->get('range')) {
            $rang = explode(":", $range);
            if($rang[0] != "Invalid date" && $rang[1] != "Invalid date" && $rang[0] != $rang[1]){
                $datatables->whereBetween('pages.created_at', ["$rang[0] 00:00:00", "$rang[1] 23:59:59"]);
            }else if($rang[0] != "Invalid date" && $rang[1] != "Invalid date" && $rang[0] == $rang[1]) {
                $datatables->whereBetween('pages.created_at', ["$rang[0] 00:00:00", "$rang[1] 23:59:59"]);
            }
        }

        return $datatables->make(true);
    }
}
