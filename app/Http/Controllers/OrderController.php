<?php

namespace App\Http\Controllers;

use App\Models\MenuType;
use App\Models\Order;
use Carbon\Carbon;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:Orders|Order Create|Order Edit|Order Delete|Order Show', ['only' => ['index', 'store']]);
        $this->middleware('permission:Order Create', ['only' => ['create', 'store']]);
        $this->middleware('permission:Order Edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:Order Delete', ['only' => ['destroy']]);
        $this->middleware('permission:Order Show', ['only' => ['show']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('orders.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('orders.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = $request->all();
        $qtyArr = [];
        $typesArr = [];
        $typePriceArr = [];
        $total = [];
        foreach ($request->qty as $qty) {
            array_push($qtyArr,$qty);
        }
        foreach ($request->types as $id) {
            $type = MenuType::find($id);
            array_push($typesArr,$type->type_name);
            array_push($typePriceArr,$type->price);
        }
        $total = array_map(
            function ($x, $y) {
                return $x * $y;
            },
            $qtyArr,
            $typePriceArr
        );
        $input['qty']=$qtyArr;
        $input['types']= $typesArr;
        $input['prices']= $typePriceArr;
        $input['date']= Carbon::now();
        $input['total']= array_sum($total);
        Order::create($input);
        return redirect(route('orders.index'))->with(['success'=>'Order Created Successfully']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request,$id)
    {
        $order = Order::find($id);
        $arr = array_combine($order->qty, $order->types);
        return view('orders.edit',compact('order','arr'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //dd($request->all());
        $order = Order::find($id);
        $input = $request->all();
        $qtyArr = [];
        $typesArr = [];
        $typePriceArr = [];
        $total = [];
        foreach ($request->qty as $qty) {
            array_push($qtyArr, $qty);
        }
        foreach ($request->types as $id) {
            $type = MenuType::find($id);
            array_push($typesArr, $type->type_name);
            array_push($typePriceArr, $type->price);
        }
        $total = array_map(
            function ($x, $y) {
                return $x * $y;
            },
            $qtyArr,
            $typePriceArr
        );
        $input['qty'] = $qtyArr;
        $input['types'] = $typesArr;
        $input['prices'] = $typePriceArr;

        $input['total'] = array_sum($total);

        $order->update($input);
        return redirect(route('orders.index'))->with(['success' => 'Order Updated Successfully']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $order = Order::find($id);
        $order->delete();
        return redirect(route('orders.index'))->with(['success' => 'Order deleted Successfully']);
    }
}
