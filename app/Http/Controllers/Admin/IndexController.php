<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Redirect;
use Hash;
use Auth;

class IndexController extends Controller {

	public function index() {
		
		return view('admin.index.index');
	}
	public function home() {
		
		return view('admin.index.home');
	}
}
