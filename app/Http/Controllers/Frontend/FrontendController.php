<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;

use Auth;
class FrontendController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
		if(Auth::check()){
		
			$body_class = '';

			return view('frontend.index', compact('body_class'));
		
		}else{
		
			if (!session()->has('url.intended')) {
				session(['url.intended' => url()->previous()]);
			}
		
			return view('auth.login');
		}
    }

    public function profile()
    {
        $body_class = 'profile-page';

        return view('frontend.profile', compact('body_class'));
    }
}
