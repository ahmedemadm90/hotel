<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:Customers|Customer Create|Customer Edit|Customer Delete|Customer Show', ['only' => ['index', 'store']]);
        $this->middleware('permission:Customer Create', ['only' => ['create', 'store']]);
        $this->middleware('permission:Customer Edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:Customer Delete', ['only' => ['destroy']]);
        $this->middleware('permission:Customer Show', ['only' => ['show']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $customers = Customer::all();
        return view('customers.index',compact('customers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('customers.create');
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
        $gallery=[];
        $request->validate([
            'nid'=>'required|unique:customers,nid',
            'name'=>'required|unique:customers,name',
            'email'=>'required|unique:customers,email',
            'country'=>'required',
            'gallery'=>'required',
            'gallery.*'=>'file|mimes:jpg,jpeg,gif,png',
        ]);
        foreach ($request->gallery as $galleryImg) {
            $ext = $galleryImg->extension();
            $imageName = uniqid() . "." . $ext;
            array_push($gallery, $imageName);
            $galleryImg->move(public_path("media/customers/"), $imageName);
        }
        $input['gallery']=$gallery;
        try {
            Customer::create($input);
            return redirect(route('customers.index'))->with(['success' => 'Customer Created Successfully']);
        } catch (\Throwable $th) {
            return redirect(route('customers.index'))->with(['error' => 'Something Went Wrong Please Contact System Admin']);
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request,$id)
    {
        $customer = Customer::find($id);
        return view('customers.show',compact('customer'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request,$id)
    {
        $customer = Customer::find($id);
        return view('customers.edit',compact('customer'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $gallery = [];
        $customer = Customer::find($id);
        $input = $request->all();
        if ($customer) {
            $request->validate([
                'nid' => 'required|unique:customers,nid,' . $id,
                'name'=>'required|unique:customers,name,' . $id,
                'email'=>'required|unique:customers,email,' . $id,
                'country'=>'required',
            ]);
            if (isset($request->gallery)) {
                foreach ($customer->gallery as $img) {
                    unlink(public_path('media/customers/' . $img));
                }
                $request->validate([
                    'gallery' => 'required',
                    'gallery.*' => 'file|mimes:jpg,jpeg,png,gif',
                ]);
                foreach ($request->gallery as $galleryImg) {
                    $ext = $galleryImg->extension();
                    $imageName = uniqid() . "." . $ext;
                    array_push($gallery, $imageName);
                    $galleryImg->move(public_path("media/customers/"), $imageName);
                }
                $input['gallery'] = $gallery;
            } else {
                $input['gallery'] = $customer->gallery;
            }
            $customer->update($input);
            return redirect(route('customers.index'))->with(['success' => 'room updated successfully']);
        } else {
            return redirect(route('customers.index'))->with(['error' => 'Invaled Room Selected']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request,$id)
    {
        $customer = Customer::find($id);
        if ($customer) {
            foreach ($customer->gallery as $img) {
                unlink(public_path('media/customers/' . $img));
                $customer->delete();
                return redirect(route('customers.index'))->with(['success' => 'customer Deleted successfully']);
            }
        } else {
            return redirect(route('customers.index'))->with(['error' => 'invaled customer Selected']);
        }
    }
}
