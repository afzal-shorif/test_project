<?php

namespace App\Http\Controllers;

use Auth;
use Validator;
use App\Models\Prime_model;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;
use Illuminate\Validation\ValidationException;


class Authorization extends Controller
{

    /**
     * @return View
     */
    public function index(){
        return view('login');
    }

    /**
     * @param Request $request
     * @return Redirector
     * @throws ValidationException
     */
    public function check_login(Request $request){
        // set validation rule
        $this->validate($request,
            [
                'email' => 'required|email',
                'password' => 'required|alphaNum|min:3'
            ]
        );

        // store the form value in $user_data array
        $user_data = array(
            'email' => $request->get('email'),
            'password' => $request->get('password')
        );

        if(Auth::attempt($user_data)){
            // success attempt
            // start session and redirect Home@index

            $user = Prime_model::get_user_id_and_type($user_data['email']);

            $cart = array();
            $request->session()->put('authorize', 'anyValue');
            $request->session()->put('user_type', $user[1]);
            $request->session()->put('user_id', $user[0]);
            $request->session()->put('cart', $cart);

            return redirect('/home');
        }else{
            // fail login
            // go back with error message

            return back()->with('error', 'Invalid Email or Password');
        }

    }

    public function sign_up(){

    }

}
