<?php
namespace App\Http\Controllers\Home;
use App\Http\Controllers\Controller;
use Redirect;
use Hash;
use Auth;

class IndexController extends Controller {
	public function index() {
		
		/*if (Auth::user()->is_special == 1) {
			return view('home.index.special');
		} else {
			return view('home.index.index');
		}*/
		return view('home.index.index');
	}
}
