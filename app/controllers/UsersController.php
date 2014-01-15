<?php

class UsersController extends BaseController {
    protected $layout = "main";

    public function __construct(){
        $this->beforeFilter('csrf', array('on'=>'post'));
        $this->beforeFilter('auth', array('only'=> array('getHome')));
    }

    public function getRegister() {
        return View::make('users.register');
    }

    public function getLogin() {
        return View::make('users.login');
    }

    public function postSignin() {
        if (Auth::attempt(array('email'=>Input::get('email'), 'password'=>Input::get('password')), true)) {
//            return Redirect::to('users/home')->with('message', 'You are now logged in!');
            return Redirect::to('users/home');
        } else {
            return Redirect::to('users/login')
                ->with('message', 'Your username/password combination was incorrect')
                ->withInput();
        }        
    }

    public function getLogout() {
        Auth::logout();
        return Redirect::to('/')->with('message', 'Logout successful');
    }

    public function getHome(){
        return View::make('users.home');
    }

    public function postCreate() {
        $validator = Validator::make(Input::all(), User::$rules);
 
        if ($validator->passes()) {
            // validation has passed, create user
            $user = new User;
            $user->firstname = Input::get('firstname');
            $user->lastname = Input::get('lastname');
            $user->email = Input::get('email');
            $user->password = Hash::make(Input::get('password'));
            $user->save();
 
            return Redirect::to('users/login')->with('message', 'Thanks for registering!');
        } else {
            // validation has failed, display error messages   
            return Redirect::to('users/register')->with('message', 'The following errors occurred')->withErrors($validator)->withInput();
            
        }        
    }
}

?>