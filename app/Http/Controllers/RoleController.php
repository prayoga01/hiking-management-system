<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use RealRashid\SweetAlert\Facades\Alert;


class RoleController extends Controller
{
    public function index(){

        $user = User::all();
        return view('admin.userlist',[
            'users'=>$user,
        ]);
      
    }

    public function edit($user)
    {
        $value = User::find($user);
        return view('admin.formedituser',[
            'user'=>$value,
        ]);
    }
    
    public function update(Request $request)
    {
        $user = User::find($request->user_id);
        $rules = [
            'is_admin' => 'required',
        ];
          
        $validatedData = $request->validate($rules);
    
           
            $value = User::find($user);

            $validatedData['user_id'] = auth()->user()->id;
            
            User::where('id', $user->id)
                    ->update([
                        'is_admin' => $validatedData['is_admin']
                    ]);

            Alert::success('success', 'Your work has been saved!');
            return redirect('/users');
        // dd($user);
    }
    
    
}