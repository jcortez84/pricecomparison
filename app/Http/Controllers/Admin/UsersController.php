<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\Role;
use App\RoleUser;

class UsersController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::with('roles')->paginate(10);
       
        return view('admin.users.index')->with('users', $users);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $role_employee = new Role();
        $role_employee->name = 'manager';
        $role_employee->description = 'The admin has superuser privilege';
        $role_employee->save();
        $role_manager = new Role();
        $role_manager->name = 'employee';
        $role_manager->description = 'An Employee can access the admin panel';
        $role_manager->save();
        $role_employee = new Role();
        $role_employee->name = 'customer';
        $role_employee->description = 'A Customer has access to their own suscriptions';
        $role_employee->save();
        $role_manager = new Role();
        $role_manager->name = 'merchant';
        $role_manager->description = 'A merchant can add a shop for products listing';
        $role_manager->save();
  
        $manager = new RoleUser();
        $manager->role_id = 1;
        $manager->user_id = 1;
        $manager->save();
        $users = User::find($id);
        $roles = Role::all()->pluck('name', 'id');
        return view('admin.users.edit')->with(compact('users', 'roles'));
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
