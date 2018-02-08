<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Auth;
use Validator;

//Importing laravel-permission models
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

use Session;

class PermissionController extends Controller {

    public function __construct() {
        $this->middleware(['auth']); //isAdmin middleware lets only users with a //specific permission permission to access these resources
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $permissions = Permission::orderBy('id','desc')->paginate(10); //Get all permissions

        return view('permissions.index')->with('permissions', $permissions);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        $roles = Role::get(); //Get all roles

        return view('permissions.create')->with('roles', $roles);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {

        // validate the input
        $validation = Validator::make( $request->all(), [
            'name'=>'required',
        ]);

// redirect on validation error
        if ( $validation->fails() ) {
            // change below as required
            return \Redirect::back()->withInput()->withErrors( $validation->messages() );
        }
        else {
            $name = $request['name'];
            $permission = new Permission();
            $permission->name = $name;

            $roles = $request['roles'];

            $permission->save();

            if (!empty($request['roles'])) { //If one or more role is selected
                foreach ($roles as $role) {
                    $r = Role::where('id', '=', $role)->firstOrFail(); //Match input role to db record

                    $permission = Permission::where('name', '=', $name)->first(); //Match input //permission to db record
                    $r->givePermissionTo($permission);
                }
            }

            return redirect()->route('permissions.index')
                ->with('flash_message',
                    'Permission '. $permission->name.' added.');


        }
    }




    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        return redirect()->route('permissions.index');
    }





    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        $permission = Permission::findOrFail($id);

        return view('permissions.edit', compact('permission'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        $permission = Permission::findOrFail($id);
        // validate the input
        $validation = Validator::make( $request->all(), [
            'name'=>'required',
        ]);
// redirect on validation error
        if ( $validation->fails() ) {
            // change below as required
            return \Redirect::back()->withInput()->withErrors( $validation->messages() );
        }
        else {
            $input = $request->all();
            $permission->fill($input)->save();

            return redirect()->route('permissions.edit',$permission->id)
                ->with('flash_message',
                    'Permission ' . $permission->name . ' updated.');
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        $permission = Permission::findOrFail($id);

        //Make it impossible to delete this specific permission
        if ($permission->name == "ตั้งค่า") {
            return redirect()->route('permissions.index')
                ->with('danger',
                    'Cannot delete this Permission.');
        }
        else{
            $permission->delete();

            return redirect()->route('permissions.index')
                ->with('flash_message',
                    'Permission deleted.');
        }



    }

    public function destroyMany(Request $request)
    {
        if ($request->multi_id != null){
            $permission = Permission::findOrFail($request->multi_id);

        //Make it impossible to delete this specific permission
            $msg = "";
            $count_error=0;
            $count_delete=0;
            foreach ($permission as $permission){
                if ($permission->name == "ตั้งค่า") {
              if($count_error == 0){
                  $msg .= " ".$permission->name;
              }
              else{
                  $msg .= ", ".$permission->name;
              }
              $count_error++;

          }
          else{
              $permission->delete();
              $count_delete++;
          }

      }
      if($count_error != 0 && $count_delete != 0){
          return redirect()->route('permissions.index')
              ->with(['flash_message'=>
                  'Permission deleted.','danger'=>'Cannot delete permission'.$msg."."]);
      }
            else if($count_error == 0 && $count_delete != 0){
                return redirect()->route('permissions.index')
                    ->with(['flash_message'=>
                        'Permission deleted.']);
            }
            else if($count_error != 0 && $count_delete == 0){
                return redirect()->route('permissions.index')
                    ->with(['danger'=>'Cannot delete permission'.$msg."."]);
            }

        }
        else{
            return redirect()->route('permissions.index')
                ->with('warning',
                    'Please select at least one record.');

        }
    }


}