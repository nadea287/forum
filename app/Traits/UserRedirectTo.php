<?php


namespace App\Traits;


trait UserRedirectTo
{
    public function redirectTo()
    {
        return str_replace(url('/'), '', session()->get('previousUrl', '/thread'));
    }
//
//    public function showForm()
//    {
//        session()->put('previousUrl', url()->previous());
//
//        if (str_replace(url('/'), '', url()->current()) == '/login') {
//            return view('auth.login');
//        } elseif (str_replace(url('/'), '', url()->current()) == '/register') {
//            return view('auth.register');
//        }
//    }
}
