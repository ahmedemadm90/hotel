<?php

namespace App\Http\Controllers;

use App\Models\Room;
use App\Models\Service;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:Room Services|Room  Service|Room  Service|Room  Service|Room  Service', ['only' => ['index', 'store']]);
        $this->middleware('permission:Room Service Create', ['only' => ['create', 'store']]);
        $this->middleware('permission:Room Service Edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:Room Service Delete', ['only' => ['destroy']]);
        $this->middleware('permission:Room Service Show', ['only' => ['show']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('room services.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $service_request = Service::find($id);
        if($service_request){
            return view('room services.show',compact('service_request'));
        }else{
            return redirect(route('room.services.index'))->with(['error'=>'invaled request']);
        }

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $service_request = Service::find($id);
        if ($service_request) {
            return view('room services.edit', compact('service_request'));
        } else {
            return redirect(route('room.services.index'))->with(['error' => 'invaled request']);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Service $service)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $service_request = Service::find($id);
        if($service_request){
            $service_request->delete();
            return redirect(route('room.services.index'))->with(['success'=>'Deleted Successfully']);
        }else{
            return redirect(route('room.services.index'))->with(['success' => 'Invaled Request']);
        }
    }
    public function done($id)
    {
        $service_request = Service::find($id);
        if($service_request){
            $room = Room::find($service_request->room_id);
            $room->update([
                'state' => 'available',
            ]);
            $service_request->update([
                'state' => 'done',
                'date_out' => Carbon::today()->toDateString(),
            ]);
            return back()->with(['success' => 'The Request Fullfilled Successfully']);
        }else{
            return back()->with(['error' => 'Invaled Request']);
        }

    }
}
