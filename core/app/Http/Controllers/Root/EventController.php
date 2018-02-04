<?php

namespace App\Http\Controllers\Root;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Event;
use Illuminate\Http\Request;
use Session;
use Datatables;
use DB;
use Auth;

class EventController extends Controller
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
        return view('root.event.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('root.event.create');
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
        $cek = Event::max('order_no');
        if($cek>0)
            $request['order_no'] = $cek + 1;
        
        $files = $request['images'];
        $path = 'files/events/';
        $name = rand(10000,99999).'.'.$files->getClientOriginalExtension();
        $files->move($path,$name);
        $request['image'] = $name;
        $requestData = $request->all();

        $event = Event::create($requestData);

        Session::flash('flash_message', 'Event added!');

        return redirect('root/event');
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
        $event = Event::findOrFail($id);

        return view('root.event.show', compact('event'));
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
        $event = Event::findOrFail($id);

        return view('root.event.edit', compact('event'));
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
            $path = 'files/events/';
            $name = rand(10000,99999).'.'.$files->getClientOriginalExtension();
            $files->move($path,$name);
            $request['image'] = $name;
        }
        $requestData = $request->all();

        $event = Event::findOrFail($id);
        $event->update($requestData);

        Session::flash('flash_message', 'Event updated!');

        return redirect('root/event');
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
        Event::destroy($id);

        Session::flash('flash_message', 'Event deleted!');

        return redirect('root/event');
    }

    public function anyData(Request $request)
    {
        DB::statement(DB::raw('set @rownum=0'));
        $event = Event::select([
            DB::raw('@rownum  := @rownum  + 1 AS rownum'), 'id', 'title', 'descriptions', 'image', 'order_no'])->orderBy('order_no');

         $datatables = app('datatables')->of($event)
            ->editColumn('image', function($event){
                return '<img src="'.url('files/events/').'/'.$event->image.'" style="max-width:150px;" />';
            })
            ->addColumn('action', function ($event) {
                return '<a href="event/'.$event->id.'/edit" class="btn btn-xs btn-primary rounded" data-toggle="tooltip" title="" data-original-title="'. trans('systems.edit') .'"><i class="fa fa-pencil"></i></a> <a onclick="deleteData('.$event->id.')" class="btn btn-xs btn-danger rounded" data-toggle="tooltip" title="" data-original-title="'. trans('systems.delete') .'"><i class="fa fa-trash"></i></a>';
            });

        if ($keyword = $request->get('search')['value']) {
            $datatables->filterColumn('rownum', 'whereRaw', '@rownum  + 1 like ?', ["%{$keyword}%"]);
        }

        if ($range = $datatables->request->get('range')) {
            $rang = explode(":", $range);
            if($rang[0] != "Invalid date" && $rang[1] != "Invalid date" && $rang[0] != $rang[1]){
                $datatables->whereBetween('events.created_at', ["$rang[0] 00:00:00", "$rang[1] 23:59:59"]);
            }else if($rang[0] != "Invalid date" && $rang[1] != "Invalid date" && $rang[0] == $rang[1]) {
                $datatables->whereBetween('events.created_at', ["$rang[0] 00:00:00", "$rang[1] 23:59:59"]);
            }
        }

        return $datatables->make(true);
    }
}
