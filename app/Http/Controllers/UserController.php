<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Models\User;
use \App\Models\Image;
use \App\Models\Post;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::user()->permissions != 1){
            return back();
        }
        $users = User::all();
        return view("users/index", compact('users'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('users/create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {   
        $data = request()->validate([
            'username' => 'required',
            'email' => 'required|email',
            'password' => 'required'
        ]);   
        $username = $request->username;
        $email = $request->email;
        $password = $request->password;
        if (strlen($password)<8){
            return back()->withErrors([
                'password' => 'Password needs to be atleast 8 characters',
            ]);
        }
        if (strlen($username)<3){
            return back()->withErrors([
                'username' => 'Username needs to be atleast 3 characters',
            ]);
        }
        if (sizeof(User::where('username',$username)->get())!=0){
            return back()->withErrors([
                'username' => 'Username is taken',
            ]);
        }
        if (preg_match("[\W]", $request->username) == 1) {
            return back()->withErrors([
                'username' => 'Username can not be symbols',
            ]);
        }
        $password = Hash::make($password);
        $user = User::create(['username'=>$username, 'email' => $email, 'password' => $password]);
        $image = $user->image()->create(['filename'=>'default.png']);
        Auth::loginUsingId($user->id);
        $request->session()->put('user',$user);
        session(['profile' => $user]);
        return redirect('users/profile/'.$username);
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
        if ($user!=null){
            session(['profile' => $user]);
            return redirect('users/profile/'.$user['username']);
        }
        return redirect('home');
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($user)
    {
        $userver = User::where('username',$user) -> first();
        if (Auth::id()==$userver['id']){
            return view('users/edit');
        }
        return back();
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $user = User::find(Auth::id());
        $data = request()->validate([
            'email' => 'email'
        ]);
        if ($request->hasFile('image')) {
            $image = $request->image;
            Image::where('imageable_id',session('user')['id'])->
        where('imageable_type', 'App\Models\User')->delete();
            $extension = $image->getClientOriginalExtension();
            $filename = time() . "." . $extension;
            $request->image->move('images', $filename);
            $image = $user->image()->create(['filename'=>$filename]);
           
            $user->save();   
        }
        else if ($request['username']){
            $username = $request->username;
            if (strlen($username)<3){
                return back()->withErrors([
                    'username' => 'Username needs to be atleast 3 characters',
                ]);
            }
            if (User::where('username',$username)==null){
                return back()->withErrors([
                    'username' => 'Username is taken',
                ]);
            }
            if (preg_match("[\W]", $username) == 1) {
                return back()->withErrors([
                    'username' => 'Username can not be symbols',
                ]);
            }
            $update = ['username'=>$username];
            $user->update($update);
        }
        else if ($request['email']){
            $email = $request->email;
            $update = ['email'=>$email];
            $user->update($update);
        }
        else if ($request['password']){
            $password = $request->password;
            if (strlen($password)<8){
                return back()->withErrors([
                    'password' => 'Password needs to be atleast 8 characters',
                ]);
            }
            $password = Hash::make($password);
            $update = ['password'=>$password];
            $user->update($update);
        }else{
            return back();
        }
        session(['user' => $user]);
        session(['profile' => $user]);
        return redirect('users/profile/'.$user->username);
    }
    public function login(){
        if (session('user')==null)
        {
            return view('users/login'); 
        }
        return redirect('users/profile/'.session('user')['username']);  
    }
    public function auth(Request $request){
        $credentials = $request->only('username', 'password');
        if (Auth::attempt($credentials)) {
            $user = User::find(Auth::id());
            $request->session()->put('user',$user);
            session(['profile' => $user]);
            session(['permissions'=>$user->permissions]);
            if($user->permissions == 1){
                return redirect('users/admin');
            }
            return redirect('users/profile/'.session('user')['username']);
        }
        return back()->withErrors([
            'username' => 'Username or password incorrect',
        ]);
    }
    public function logout(){
        session()->flush();
        Auth::logout();
        return redirect("home");
    }
    public function displayProfile($user){
        $users = User::all();
        $userver = User::where('username',$user) -> first();
        if (session('profile')['username']==$user){
            $posts = Post::where('user_id',session('profile')['id'])->latest();
            return view("users/profile")->with(array('users'=>$users))->with(array('posts'=>$posts));
        }
        return redirect("users/show/".$userver['id']);
    }
    public function findProfile(Request $request){
        $data = request()->validate([
            'username' => 'required'
        ]);
        $user = User::where('username',$data['username']) -> first();
        if ($user!=null){
            return redirect("users/show/".$user['id']);
        }
        return back()->withErrors([
            'username' => 'Username not found',
        ]);
    }
    public function adminHome(){
        return view("users/admin");
    }
}
