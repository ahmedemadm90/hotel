<?php

namespace App\Http\Controllers;

use App\Models\MenuCategory;
use Illuminate\Http\Request;

class MenuCategoryController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:Menu Categories|Menu Category Create|Menu Category Edit|Menu Category Delete|Menu Category Show', ['only' => ['index', 'store']]);
        $this->middleware('permission:Menu Category Create', ['only' => ['create', 'store']]);
        $this->middleware('permission:Menu Category Edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:Menu Category Delete', ['only' => ['destroy']]);
        $this->middleware('permission:Menu Category Show', ['only' => ['show']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('menu categories.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('menu categories.create');
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
            'category_name'=> 'required|unique:menu_categories,category_name',
        ]);
        try {
            MenuCategory::create($request->all());
            return redirect(route('menu.categories.index'))->with(['success'=>'New Menu Category Was Added']);
        } catch (\Throwable $th) {
            return redirect(route('menu.categories.index'))->with(['error' => 'Not Added Please Contact Your System Admin']);
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\MenuCategory  $menuCategory
     * @return \Illuminate\Http\Response
     */
    public function show(MenuCategory $menuCategory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\MenuCategory  $menuCategory
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request,$id)
    {
        $category = MenuCategory::find($id);
        return view('menu categories.edit',compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\MenuCategory  $menuCategory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $category = MenuCategory::find($id);
        if ($category) {
            $request->validate([
                'category_name' => 'required|unique:menu_categories,category_name,'.$id,
            ]);
            try {
                $category->update($request->all());
                return redirect(route('menu.categories.index'))->with(['success' => 'New Menu Category Was Updated']);
            } catch (\Throwable $th) {
                return redirect(route('menu.categories.index'))->with(['error' => 'Not Updated Please Contact Your System Admin']);
            }
        } else {
            return redirect(route('menu.categories.index'))->with(['error' => 'Invaled Category']);
        }


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\MenuCategory  $menuCategory
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category = MenuCategory::find($id);
        $category->delete();
        return redirect(route('menu.categories.index'))->with(['success' => 'Category Deleted Successfully']);
    }
}
