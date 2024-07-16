<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DataTables;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use DB;

class UserController extends Controller
{
    function __construct()
    {
         $this->middleware('permission:manage-user', ['only' => ['index','create','store','edit','update']]);
    }

    public function index(Request $request)
    {
        $users = User::where('id','!=',1)->get();
        return view('admin.users', compact('users'));
    }
    
    public function create()
    {
        $roles = Role::where('id','!=',1)->pluck('name','name')->all();
        return view('admin.add_user',compact('roles'));
    }

    public function store(Request $request)
    {
        $validator = $request->validate( ['name' => 'required', 
            'email' => 'required|unique:users,email',
            'password' => 'required|confirmed']);
        $user = User::create([
            'name' => $request->name, 
            'email' => $request->email,
            'password' => bcrypt($request->password)
        ]);

        $roles = $request->input('roles');

        if(empty($roles))
        {
            $roles = 'Manager';
            $user->approver1 = $request->approver1;
            $user->approver2 = $request->approver2;
            $user->save();
        }

        $user->assignRole($roles);
        
        return redirect('admin/users')->with('success','User added successfully');
    }
    
    public function edit(User $user)
    {
        //$user = User::with(array('approver_1','approver_2'))->where('id',$user->id)->first();
        $roles = Role::where('id','!=',1)->pluck('name','name')->all();
        $userRole = $user->roles->pluck('name','name')->first();
        return view('admin.edit_user', compact('user','roles','userRole'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Partner  $partner
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $validator = $request->validate( ['name' => 'required',
            'password' => 'confirmed',
            'email' => 'unique:users,email,' . $user->id,
        ]);

        $user->name = $request->name;

        if($request->password)
            $user->password = bcrypt($request->password);

        $roles = $request->input('roles');

        if(empty($roles))
        {
            $roles = 'Manager';
            $user->approver1 = $request->approver1;
            $user->approver2 = $request->approver2;
        }
        elseif($roles == 'Admin')
        {            
            $user->approver1 = null;
            $user->approver2 = null;
        }
        
        $user->save();

        if($user->userRole != $roles)
        {            
            DB::table('model_has_roles')->where('model_id',$user->id)->delete();

            $user->assignRole($roles);
        }

        return redirect('admin/users')->with('success','User updated successfully');
    }
}
