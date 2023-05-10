<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Worker;
use Illuminate\Http\Request;

class WorkerController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:Workers|Worker Create|Worker Edit|Worker Delete|Worker Show', ['only' => ['index', 'store']]);
        $this->middleware('permission:Worker Create', ['only' => ['create', 'store']]);
        $this->middleware('permission:Worker Edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:Worker Delete', ['only' => ['destroy']]);
        $this->middleware('permission:Worker Show', ['only' => ['show']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $workers = Worker::get();
        return view('workers.index', [
            'workers' => $workers,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('workers.create');
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
            "nid" => 'required|unique:workers,id',
            "name" => 'required|string',
            "email" => 'email|unique:workers,email',
            "job" => 'required|string',
            "start_date"  => 'required|date',
            "end_date"  => 'nullable|date',
            "img" => 'required|file|mimes:jpg,jpeg,png,gif',
        ]);
        $input = $request->all();
        $input['id']=$request->nid;
        if (isset($request->state)) {
            $request->state = 1;
        }else{
            $request->state = 0;
        }
        $img = $request->img;
        $ext = $img->extension();
        $imageName = uniqid() . "." . $ext;
        $img->move(public_path("media/workers/"), $imageName);
        $input['img'] = $imageName;
        try {
            Worker::create($input);
            return redirect(route('workers.index'))->with(['success' => 'Worker Creeated Successfully']);
        } catch (\Throwable $th) {
            return redirect(route('workers.index'))->with(['error' => 'Something Went Sideways Please Contact Your System Admin']);
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Worker  $worker
     * @return \Illuminate\Http\Response
     */
    public function show(Worker $worker)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Worker  $worker
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $worker = Worker::find($id);
        return view('workers.edit',compact('worker'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Worker  $worker
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $input = $request->all();
        $request->validate([
            "nid" => 'required|unique:workers,id,' . $id,
            "name" => 'required|string',
            "email" => 'email|unique:workers,email,' . $id,
            "job" => 'required|string',
            "start_date"  => 'required|date',
            "end_date"  => 'nullable|date',
            "img" => 'file|mimes:jpg,jpeg,png,gif',
        ]);
        $worker = Worker::find($id);
        if (isset($input['img'])) {
            if (isset($worker->img)) {
                unlink(public_path('media/workers/'.$worker->img));
                $img = $request->img;
                $ext = $img->extension();
                $imageName = uniqid() . "." . $ext;
                $img->move(public_path("media/workers/"), $imageName);
                $input['img'] = $imageName;
            } else {
                $img = $request->img;
                $ext = $img->extension();
                $imageName = uniqid() . "." . $ext;
                $img->move(public_path("media/workers/"), $imageName);
                $input['img'] = $imageName;
            }
        }
        if (isset($input['state'])) {
            $input['state']=1;
            $user=User::where('worker_id',$id)->first();
            $user->update([
                'name'=>$input['name'],
                'job'=>$input['job'],
                'email'=>$input['email'],
                'active'=>$input['state'],
            ]);
        }else{
            $input['state'] = 0;
            $user = User::where('worker_id', $id)->first();
            $user->update([
                'name' => $input['name'],
                'job' => $input['job'],
                'email' => $input['email'],
                'active' => $input['state'],
            ]);
        }
        if ($worker) {
            $worker->update($input);
            return redirect(route('workers.index'))->with(['success' => 'Worker Updated Successfully']);
        } else {
            return redirect(route('workers.index'))->with(['error'=>'Invaled Worker Selected']);
        }


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Worker  $worker
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $worker = Worker::find($id);
        if ($worker) {
            if (isset($worker->img)) {
                unlink("media/workers/$worker->img");
                $worker->delete();
                return redirect(route('workers.index'))->with(['success' => 'Worker Deleted Successfully']);
            } else {
                $worker->delete();
                return redirect(route('workers.index'))->with(['success' => 'Worker Deleted Successfully']);
            }
        } else {
            return redirect(route('workers.index'))->with(['error' => 'Invaled Worker']);
        }



    }
}
