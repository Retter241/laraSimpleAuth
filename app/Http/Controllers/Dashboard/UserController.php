<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use Auth;
use Hash;

class UserController extends Controller
{


     /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if(Auth::user()->root == 1){
        $data = User::paginate(5);
        return view('dashboard.users.index',compact('data'))
            ->with('i', ($request->input('page', 1) - 1) * 5);
        }
        else{
            $data = User::findOrFail(Auth::user()->id);
            return view('dashboard.users.index',compact('data'));
        }
       
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.users.create');
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
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|same:confirm-password'
        ]);

        $input = $request->all();
        $input['password'] = Hash::make($input['password']);
        $user = User::create($input);

        return redirect()->route('user.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        Auth::user()->root == 1 ? $user = User::find($id) : $user = User::find(Auth::user()->id);
        return view('dashboard.users.show',compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        Auth::user()->root == 1 ? $user = User::find($id) : $user = User::find(Auth::user()->id);
        return view('dashboard.users.edit',compact('user'));
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
            'name' => 'required',
            'email' => 'required|email|unique:users,email,'.$id,
            'password' => 'same:confirm-password'
        ]);

        $user = User::find($id);
        $input = $request->all();
        if(!empty($input['password'])){ 
            $input['password'] = Hash::make($input['password']);
        }else{
            $input['password'] = $user->password;
        }

        $user->update($input);
        
        return redirect()->route('user.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // check if admin
         if($id != 1){
            $user = User::findOrFail($id);
            $user->delete();
            return redirect()->route('user.index');
        }
        else {
            return redirect()->back();
        }
    }
}
