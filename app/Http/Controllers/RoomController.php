<?php

namespace App\Http\Controllers;

use App\Models\Room;
use Illuminate\Http\Request;

class RoomController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:Rooms|Room Create|Room Edit|Room Delete|Room Show', ['only' => ['index', 'store']]);
        $this->middleware('permission:Room Create', ['only' => ['create', 'store']]);
        $this->middleware('permission:Room Edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:Room Delete', ['only' => ['destroy']]);
        $this->middleware('permission:Room Show', ['only' => ['show']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $rooms = Room::orderBy('room_no')->get();
        return view('rooms.index', compact('rooms'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('rooms.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'room_no' => 'required|unique:rooms,room_no',
            'price' => 'required',
            'description' => 'required',
            'gallery' => 'required',
            'gallery.*' => 'file|mimes:jpg,jpeg,png,gif',
        ]);
        $gallery = [];
        foreach ($request->gallery as $galleryImg) {
            $ext = $galleryImg->extension();
            $imageName = uniqid() . "." . $ext;
            array_push($gallery, $imageName);
            $galleryImg->move(public_path("media/rooms/"), $imageName);
        }
        $input = $request->all();
        $input['state'] = "available";
        $input['gallery'] = $gallery;
        Room::create($input);
        return redirect(route('rooms.index'))->with(['success' => 'Created Successfully']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Room  $room
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        $room = Room::find($id);
        return view('rooms.show', compact('room'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Room  $room
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        $room = Room::find($id);
        return view('rooms.edit', compact('room'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Room  $room
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $gallery = [];
        $room = Room::find($id);
        $input = $request->all();
        if ($room) {
            $request->validate([
                'room_no' => 'required|unique:rooms,room_no,' . $id,
                'price' => 'required',
                'description' => 'required',
            ]);
            if (isset($request->gallery)) {
                foreach ($room->gallery as $img) {
                    unlink(public_path('media/rooms/' . $img));
                }
                $request->validate([
                    'gallery' => 'required',
                    'gallery.*' => 'file|mimes:jpg,jpeg,png,gif',
                ]);
                foreach ($request->gallery as $galleryImg) {
                    $ext = $galleryImg->extension();
                    $imageName = uniqid() . "." . $ext;
                    array_push($gallery, $imageName);
                    $galleryImg->move(public_path("media/rooms/"), $imageName);
                }
                $input['gallery'] = $gallery;
            } else {
                $input['gallery'] = $room->gallery;
            }
            $room->update($input);
            return redirect(route('rooms.index'))->with(['success' => 'room updated successfully']);
        } else {
            return redirect(route('rooms.index'))->with(['error' => 'Invaled Room Selected']);
        }


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Room  $room
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request,$id)
    {
        $room = Room::find($id);
        if ($room) {
            foreach($room->gallery as $img){
                unlink(public_path('media/rooms/'.$img));
            }
            $room->delete();
            return redirect(route('rooms.index'))->with(['success' => 'room Deleted successfully']);
        } else {
            return redirect(route('rooms.index'))->with(['error' => 'invaled Room Selected']);
        }

    }
}
