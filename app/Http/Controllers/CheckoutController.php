<?php

namespace App\Http\Controllers;
use DB;
use Session;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Redirect;
use Cart;
session_start();
class CheckoutController extends Controller {
	public function login_checkout(){
		$cate_product = DB::table('tbl_category_product')->where('category_status','0')->orderby('category_id','desc')->get();
		$brand_product = DB::table('tbl_brand_product')->where('brand_status','0')->orderby('brand_id','desc')->get();


		return view('pages.checkout.login-checkout')->with('category', $cate_product)->with('brand', $brand_product);
	}
	public function add_customer(Request $request) {
		$data = array();
		$data['customer_name'] = $request->customer_name;
		$data['customer_email'] = $request->customer_email;
		$data['customer_password'] = md5($request->customer_password);
		$data['customer_phone'] = $request->customer_phone;

		$customer_id = DB::table('tbl_customer')->insertGetId($data);
		Session::put('customer_id', $customer_id);
		Session::put('customer_name', $request->customer_name);
		return Redirect::to('/checkout');
	}
	public function checkout(){
		$cate_product = DB::table('tbl_category_product')->where('category_status','0')->orderby('category_id','desc')->get();
		$brand_product = DB::table('tbl_brand_product')->where('brand_status','0')->orderby('brand_id','desc')->get();
		return view('pages.checkout.show-checkout')->with('category', $cate_product)->with('brand', $brand_product);
	}

	public function save_checkout_customer(Request $request){
		$data = array();
		$data['shipping_name'] = $request->shipping_name;
		$data['shipping_email'] = $request->shipping_email;
		$data['shipping_phone'] = $request->shipping_phone;
		$data['shipping_address'] = $request->shipping_address;
		$data['shipping_note'] = $request->shipping_note;

		$shipping_id = DB::table('tbl_shipping')->insertGetId($data);
		// echo "shipping_id";
		Session::put('shipping_id', $shipping_id);
		return Redirect::to('/payment');
	}
	public function payment(){
		echo"Bạn lại vào đây rồi !";
	}
	public function logout_customer(){
		Session::flush();
		return Redirect::to('login-checkout');
	}
	// function này đang lỗi => fixbug này sau 
	public function login_customer(Request $request){
		$email = $request->email_account;
		$password = md5($request->password_account);

		$result = DB::table('tbl_customer')->where('customer_email', $email)->where('customer_password', $password)->first();
		if($result) {
			Session::put('customer_id', $result->customer_id);
			return Redirect::to('/show-checkout');
		} else {
			return Redirect::to('login-checkout');
		}
	}
}
