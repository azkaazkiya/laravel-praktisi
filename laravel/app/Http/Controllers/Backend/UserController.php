<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    //
    public function UserView(){
        //$allDataUser-User::all();
        $data['allDataUser']=user::all();
        return view('backend.user.view_user', $data);

    }

    public function UserAdd(){
        //$allDataUser-User::all();
        //$data['allDataUser']=user::all();
        return view('backend.user.add_user');

    }

    public function UserStore(Request $request){  
        
        
        $validateData=$request->validate([
            'email' =>'required|unique:users',
            'textNama' =>'required',
        ]);
        // dd($request);
        $data=new User();
        $data->usertype=$request->selectUser;
        $data->name=$request->textNama;
        $data->email=$request->email;
        $data->password=bcrypt($request->password);
        $data->save();

        return redirect()->route('user.view')->with('info','Tambah user berhasil');
    }


    public function UserEdit($id){
        // dd('Berhasil masuk controller user edit');
        $editData= User::find($id);
        return view('backend.user.edit_user', compact('editData'));

    }

    public function UserUpdate(Request $request, $id){  
        
        
        $validateData=$request->validate([
            'email' =>'required|unique:users',
            'textNama' =>'required',
        ]);
        // dd($request);
        $data=user::find($id);
        $data->usertype=$request->selectUser;
        $data->name=$request->textNama;
        $data->email=$request->email;
        // if($request->password=""){
        //     $data->password=bcrypt($request->password);
        // }
        
        $data->save();

        return redirect()->route('user.view')->with('info','Update user berhasil');
    }

    public function UserDelete($id){
        // dd('Berhasil masuk controller user edit');
        $deleteData= User::find($id);
        $deleteData->delete();

         return redirect()->route('user.view')->with('info','Delete user berhasil');

    }
}
