<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;
use Auth;

//Importing laravel-permission models
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

//Enables us to output flash messaging
use Session;

class UserController extends Controller {

    public function __construct() {
        $this->middleware(['auth', 'manageSetting']); //isAdmin middleware lets only users with a //specific permission permission to access these resources
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        //Get all users and pass it to the view
        $users = User::orderBy('id','desc')->paginate(10);
        return view('users.index')->with('users', $users);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        //Get all roles and pass it to the view
        $roles = Role::get();
        return view('users.create', ['roles'=>$roles]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        //Validate name, email and password fields
        $this->validate($request, [
            'name'=>'required|max:120',
            'email'=>'required|email|unique:users',
            'password'=>'required|min:6|confirmed',
            'roles'=>'required'
        ],[
            'name.required' => 'จำเป็นต้องระบุชื่อ',
            'name.max:120' => 'ชื่อต้องไม่เกิน 120 ตัวอักษร',
            'email.required'=>'จำเป็นต้องระบุอีเมล',
            'email.email'=>'ระบุอีเมลในรูปแบบ someone@example.com',
            'email.unique:users'=>'อีเมลที่ระบุถูกใช้งานแล้ว',
            'password.required'=>'จำเป็นต้องระบุรหัสผ่าน',
            'password.min:6'=>'ระบุรหัสผ่านอย่างน้อย 6 ตัว',
            'password.confirmed'=>'กรุณายืนยันรหัสผ่าน',
            'roles.required' => 'จำเป็นต้องกำหนดสิทธิ์การเข้าถึง'
        ]);

        $user = User::create($request->only('email', 'name', 'password')); //Retrieving only the email and password data

        $roles = $request['roles']; //Retrieving the roles field
        //Checking if a role was selected
        if (isset($roles)) {

            foreach ($roles as $role) {
                $role_r = Role::where('id', '=', $role)->firstOrFail();
                $user->assignRole($role_r); //Assigning role to user
            }
        }
        //Redirect to the users.index view and display message
        return redirect()->route('users.index')
            ->with('flash_message',
                'สร้างบัญชีผู้ใช้เรียบร้อยแล้ว');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        return redirect()->route('users.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        $user = User::findOrFail($id); //Get user with specified id
        $roles = Role::get(); //Get all roles

        return view('users.edit', compact('user', 'roles')); //pass user and roles data to view

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        $user = User::findOrFail($id); //Get role specified by id

        //Validate name, email and password fields
        $this->validate($request, [
            'name'=>'required|max:120',
            'email'=>'required|email|unique:users,email,'.$id,
            'roles'=>'required'
        ],[
            'name.required' => 'จำเป็นต้องระบุชื่อ',
            'name.max:120' => 'ชื่อต้องไม่เกิน 120 ตัวอักษร',
            'email.required'=>'จำเป็นต้องระบุอีเมล',
            'email.email'=>'ระบุอีเมลในรูปแบบ someone@example.com',
            'email.unique:users,email,'.$id=>'อีเมลที่ระบุถูกใช้งานแล้ว',
            'roles.required' => 'จำเป็นต้องกำหนดสิทธิ์การเข้าถึง'
        ]);
        $input = $request->only(['name', 'email']); //Retreive the name, email and password fields
        $roles = $request->roles; //Retreive all roles
        $user->fill($input)->save();

        if (isset($roles)) {
            $user->roles()->sync($roles);  //If one or more role is selected associate user to roles
        }
        else {
            $user->roles()->detach(); //If no role is selected remove exisiting role associated to a user
        }
        return redirect()->route('users.edit',$id)
            ->with('flash_message',
                'บันทึกข้อมูลเรียบร้อยแล้ว');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        //Find a user with a given id and delete
        $user = User::findOrFail($id);

        if ($user->email == Auth::user()->email) {
            return redirect()->route('users.index')
                ->with('danger',
                    'ไม่สามารถลบบัญชีผู้ใช้นี้ได้ เนื่องจากคุณกำลังเข้าสู่ระบบด้วยบัญชีผู้ใช้นี้');
        }
        else{
            $user->delete();
            return redirect()->route('users.index')
                ->with('flash_message',
                    'ลบบัญชีผู้ใช้เรียบร้อยแล้ว');
        }



    }

    public function destroyMany(Request $request)
    {
        if ($request->multi_id != null){
            $users = User::findOrFail($request->multi_id);

            //Make it impossible to delete this specific permission
            $msg = "";
            $count_error=0;
            $count_delete=0;
            foreach ($users as $user){
                if ($user->email == Auth::user()->email) {
                    $msg .= $user->email;
                    $count_error++;

                }
                else{
                    $user->delete();
                    $count_delete++;
                }

            }
            if($count_error != 0 && $count_delete != 0){
                return redirect()->route('users.index')
                    ->with(['flash_message'=>
                        'Users deleted.','danger'=>'ไม่สามารถลบบัญชี '.$msg." เนื่องจากคุณกำลังเข้าสู่ระบบด้วยบัญชีผู้ใช้นี้"]);
            }
            else if($count_error == 0 && $count_delete != 0){
                return redirect()->route('users.index')
                    ->with(['flash_message'=>
                        'ลบบัญชีผู้ใช้เรียบร้อยแล้ว']);
            }
            else if($count_error != 0 && $count_delete == 0){
                return redirect()->route('users.index')
                    ->with(['danger'=>'ไม่สามารถลบบัญชี '.$msg." เนื่องจากคุณกำลังเข้าสู่ระบบด้วยบัญชีผู้ใช้นี้"]);
            }

        }
        else{
            return redirect()->route('users.index')
                ->with('warning',
                    'กรุณาเลือกบัญชีผู้ใช้อย่างน้อย 1 บัญชี');

        }
    }
}