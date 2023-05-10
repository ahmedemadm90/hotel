<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Worker;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Arr;

class UserController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:Users|User Create|User Edit|User Delete|User Show', ['only' => ['index', 'store']]);
        $this->middleware('permission:User Create', ['only' => ['create', 'store']]);
        $this->middleware('permission:User Edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:User Delete', ['only' => ['destroy']]);
        $this->middleware('permission:User Show', ['only' => ['show']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $users = User::orderBy('id', 'DESC')->get();
        //dd($users);
        return view('users.index', compact('users'))
            ->with('i', ($request->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::pluck('name', 'name')->all();
        return view('users.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */



    public function store(Request $request)
    {
        $this->validate($request, [
            'worker_id' => 'required|exists:workers,id|unique:users,worker_id',
            'password' => 'required|same:confirm-password',
            'roles' => 'required',
        ]);
        $worker = Worker::find($request->worker_id);
        $input = $request->all();
        if ($worker) {
            if ($worker->user) {
                return redirect(route('users.index'))->with(['error'=>'This Worker Alreade Has A Login Username']);
            } else {
                $input['name'] = $worker->name;
                $input['email'] = $worker->email;
                $input['img'] = $worker->img;
                $input['active'] = $worker->state;
                $input['password'] = Hash::make($input['password']);
                $user = User::create($input);
                $user->assignRole($request->input('roles'));
                return redirect()->route('users.index')
                ->with('success', 'User created successfully');
            }
        } else {
            return redirect(route('users.index'))->with(['error' => 'You Can\'t Create Username For This Worker']);
        }


    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::find($id);
        return view('users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::find($id);
        $roles = Role::pluck('name', 'name')->all();
        $userRole = $user->roles->pluck('name', 'name')->all();

        return view('users.edit', compact('user', 'roles', 'userRole'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'password' => 'same:confirm-password',
            'roles' => 'required',
        ]);
        $user = User::find($id);
        $worker = Worker::find($user->worker_id);
        $input = $request->all();
        if (!empty($input['password'])) {
            $input['password'] = Hash::make($input['password']);
        } else {
            $input = Arr::except($input, array('password'));
        }
        $user->update($input);
        DB::table('model_has_roles')->where('model_id', $id)->delete();
        $user->assignRole($request->input('roles'));
        return redirect()->route('users.index')
            ->with('success', 'User updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        User::find($id)->delete();
        return redirect()->route('users.index')
            ->with('success', 'User deleted successfully');
    }
}
