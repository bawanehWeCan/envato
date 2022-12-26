<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function userProfile($username)
    {
        $user = User::where('username', '=', $username)->firstOrFail();
        return view('user.profile')->with('user',$user);
    }

    public function editProfile()
    {
        $user = Auth::user();
        return view('user.edit')->with('user',$user);
    }

    public function storeProfile(Request $request)
    {
        $user = Auth::user();


        $validatedData = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            
        ]);

        if( !empty($request->password) ){
            $validatedData = $request->validate([
                'password' => [ 'string', 'min:8', 'confirmed'],
            ]);
        }
        if($request->username != $user->username){
            $validatedData = $request->validate([
                'username' => ['required', 'string', 'max:255', 'unique:tk_users', 'min:4','not_regex:/^.+$/i'],
            ]);
        }

        if($request->email != $user->email){
            $validatedData = $request->validate([
                'email' => ['required', 'string', 'email', 'max:255', 'unique:tk_users'],
            ]);
        }

        

        
        $user->name = $request->name;
        $user->username = $request->username;
        $user->email = $request->email;
        

        if( !empty( $request->password ) ){
            $user->password = Hash::make($request->password);
        }

        if ($request->hasfile('userimage')) {
            $destinationPath = public_path('uploads/files/avatars');
            $extension = $request->file('userimage')->getClientOriginalExtension();
            $fileName = uniqid().'.'.$extension;
            $fileName = url('/uploads/files/avatars').'/'.$fileName;
    
            $request->file('userimage')->move($destinationPath, $fileName);
            $user->image = $fileName;
        }
        $user->save();

        return redirect('/edit-profile')->with('success', 'تم تحديث الملف الشخصي');  


    }


    public function search(Request $request)
    {   
        if(empty($request->get('keyword'))){
            return redirect()->back();
        }
        $key = trim($request->get('keyword'));


        $users = User::query()
            ->where('name', 'like', "%{$key}%")
            ->orWhere('username', 'like', "%{$key}%")
            ->orderBy('created_at', 'desc')
            ->get();
            return view('user.search')->with('users',$users);
    }
}
