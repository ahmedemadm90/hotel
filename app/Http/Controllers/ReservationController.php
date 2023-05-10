<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Reservation;
use App\Models\Room;
use App\Models\Service;
use App\Models\Transaction;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ReservationController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:Reservations|Reservation Create|Reservation Edit|Reservation Delete|Reservation Show|Cash OnHold|Bill|checkout', ['only' => ['index', 'store']]);
        $this->middleware('permission:Reservation Create', ['only' => ['create', 'store']]);
        $this->middleware('permission:Reservation Edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:Reservation Delete', ['only' => ['destroy']]);
        $this->middleware('permission:Reservation Show', ['only' => ['show']]);
        $this->middleware('permission:Cash OnHold', ['only' => ['reception']]);
        $this->middleware('permission:Bill', ['only' => ['bill']]);
        $this->middleware('permission:Reservation Checkout', ['only' => ['checkout']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function reception()
    {
        $registry = Transaction::where('state', 'reception')->sum('bill');
        return view('transactions.onhold',compact('registry'));
    }
    public function index()
    {
        return view('reservations.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('reservations.create');
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
            'customer_id'=> 'required|exists:customers,id',
            'room_id'=> 'required|exists:rooms,id',
            'from_date'=>'required|date',
            'to_date'=> 'required|date',
        ]);
        $input = $request->all();
        $input['state']='active';
        Reservation::create($input);
        $room = Room::find($input['room_id']);
        $room->update([
            'state'=>'unavailable',
        ]);
        return redirect(route('reservations.index'))->with(['success' => 'resevation avtivated successfully']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Reservation  $reservation
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request,$id)
    {
        $reservation = Reservation::find($id);
        return view('reservations.show',compact('reservation'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Reservation  $reservation
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        $reservation = Reservation::find($id);
        return view('reservations.edit', compact('reservation'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Reservation  $reservation
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $reservation = Reservation::find($id);
        $input = $request->all();
        if ($reservation) {
            $request->validate([
                'customer_id' => 'required|exists:customers,id',
                'room_id' => 'required|exists:rooms,id',
                'from_date' => 'required|date',
                'to_date' => 'required|date',
            ]);
            $reservation->update($input);
            return redirect(route('reservations.index'))->with(['success'=>'resevation updated successfully']);
        } else {
            return redirect(route('reservations.index'))->with(['error' => 'invaled reservation data']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Reservation  $reservation
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $reservation = Reservation::find($id);
        $reservation->delete();
        $room = Room::find($reservation->room_id);
        $room->update([
            'state'=>'available',
        ]);
        return redirect(route('reservations.index'))->with(['success' => 'resevation deleted successfully']);
    }
    public function checkout ($id)
    {
        $reservation = Reservation::find($id);
        if ($reservation) {
            if (Carbon::now()->toDateString() < $reservation->to_date); {
                $reservation->update([
                    'to_date' => Carbon::now()->toDateString(),
                ]);
            }
            /* Calculating The Bill */
            $order_bill = 0;
            $room = Room::find($reservation->room_id);
            $from_date = $reservation->from_date;
            $to_date = $reservation->to_date;
            $from_date = Carbon::parse($reservation->from_date);
            $to_date = Carbon::parse($reservation->to_date);
            $diff = $from_date->diffInDays($to_date);
            $bill = $diff * $reservation->room->price;
            $orders = Order::where('reservation_id', $reservation->id)->get();
            foreach ($orders as $order) {
                $order_bill += $order->total;
            }
            $bill = $order_bill + $bill;
            $reservation->update([
                'state' => 'checkedout',
                'bill' => $bill,
            ]);
            $room->update([
                'state' => 'Room Service',
            ]);
            Service::create([
                'room_id'=>$room->id,
                'date_in'=> Carbon::today()->toDateString(),
            ]);
            Transaction::create([
                'reservation_id'=>$reservation->id,
                'bill'=> $bill,
                'state'=> 'reception',
            ]);
            return redirect(route('reservations.index'))->with(['success'=>'Reservation Checkedout']);
        } else {
            return redirect(route('reservations.index'))->with(['error' => 'Invaled Reservation']);
        }



    }
    public function bill($id)
    {
        /* Calculating The Bill */
        $reservation = Reservation::find($id);
        $from_date = Carbon::parse($reservation->from_date);
        $to_date = Carbon::parse($reservation->to_date);
        $diff = $from_date->diffInDays($to_date);
        $reservation_bill = $diff * $reservation->room->price;
        $orders = Order::where('reservation_id',$reservation->id)->get();
        return view('reservations.bill',compact('reservation','orders', 'reservation_bill'));
    }
}
