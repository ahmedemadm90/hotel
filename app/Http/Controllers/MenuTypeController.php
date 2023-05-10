<?php

namespace App\Http\Controllers;

use App\Models\MenuCategory;
use App\Models\MenuType;
use Illuminate\Http\Request;

class MenuTypeController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:Menu Types|Menu Type Create|Menu Type Edit|Menu Type Delete|Menu Type Show', ['only' => ['index', 'store']]);
        $this->middleware('permission:Menu Type Create', ['only' => ['create', 'store']]);
        $this->middleware('permission:Menu Type Edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:Menu Type Delete', ['only' => ['destroy']]);
        $this->middleware('permission:Menu Type Show', ['only' => ['show']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('menu types.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('menu types.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //dd($request->all());
        $request->validate([
            'menu_category_id'=>'required|exists:menu_categories,id',
            'type_name'=>'required|unique:menu_types,type_name',
            'price'=>'required',
        ]);
        try {
            MenuType::create($request->all());
            return redirect(route('menu.types.index'))->with(['success'=>'Created Successfully']);
            //code...
        } catch (\Throwable $th) {
            return redirect(route('menu.types.index'))->with(['success' => 'Not Added Please Contact Your System Admin']);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\MenuType  $menuType
     * @return \Illuminate\Http\Response
     */
    public function show(MenuType $menuType)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\MenuType  $menuType
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request,$id)
    {
        $type = MenuType::find($id);
        return view('menu types.edit',compact('type'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\MenuType  $menuType
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        $type = MenuType::find($id);
        $request->validate([
            'menu_category_id' => 'required|exists:menu_categories,id',
            'type_name' => 'required|unique:menu_types,type_name,' . $id,
            'price' => 'required',
        ]);
        try {
            $type->update($request->all());
            return redirect(route('menu.types.index'))->with(['success' => 'Updated Successfully']);
            //code...
        } catch (\Throwable $th) {
            return redirect(route('menu.types.index'))->with(['success' => 'Not Updated Please Contact Your System Admin']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\MenuType  $menuType
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request,$id)
    {
        $type = MenuType::find($id);
        $type->delete();
        return redirect(route('menu.types.index'))->with(['success' => 'Deleted Successfully']);
    }
}
