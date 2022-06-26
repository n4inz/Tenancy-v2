<?php

namespace App\Http\Controllers;

use App\Models\Domain;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    // View
    public function login_view()
    {
        //  return User::with('domain')->get();
        return view('login');
    }

    public function register_view()
    {
        return view('register');  
    }

    // Logic

    public function register_store(Request $request)
    {
        $request->validate([
            'full_name' => ['required'],
            'sub_domain' => ['required'],
        ]);

      $mail =  str_replace(' ','_',$request->full_name);
      $domain =  str_replace(' ','_',$request->sub_domain);

       $user = User::create([
            'name' => $request->full_name,
            'email' =>  $mail.'@mail.com',
            'password' => Hash::make(123456),
        ]);

        Domain::create([
            'user_id' => $user->id,
            'domain' => $domain
        ]);

        Auth::login($user);


        return redirect()->route('dashboard', ['subdomain' => $domain]);
        
    }

    public function login_store(Request $request)
    {
        $data =  $request->validate([
            'email' => ['required'],
            'password' => ['required'],
        ]);
        $credentials = [
            'email' => str_replace(' ','_',$request->email).'@mail.com',
            'password' => 123456
        ];
        
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
           
            return redirect()->route('dashboard', ['subdomain' => auth()->user()->domain->domain]);
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');

        
    }

    public function logout(Request $request)
    {
        Auth::logout();
    
        $request->session()->invalidate();
    
        $request->session()->regenerateToken();
    
        return redirect(to:env('APP_URL'));
    }
}
