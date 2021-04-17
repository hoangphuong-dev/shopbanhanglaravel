<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
use Cart;
session_start();
class CartController extends Controller
{
	public function save_cart(Request $request) {
		$productID = $request->productid_hidden;
		$quantity = $request->quantity;
		$product_info = DB::table('tbl_product')->where('product_id', $productID)->get();
		
		
		// Cart::add('293ad', 'Product 1', 1, 9.99, 550);
		// Cart::destroy();
		$data['id'] = $product_info[0]->product_id;
		$data['qty'] = $quantity;
		$data['name'] = $product_info[0]->product_name;
		$data['price'] = $product_info[0]->product_price;
		$data['weight'] = '123';
		$data['options']['image'] = $product_info[0]->product_image;

		Cart::add($data);
		return Redirect::to('/show-cart');

		
	}
	public function show_cart() {
		$cate_product = DB::table('tbl_category_product')->where('category_status','0')->orderby('category_id','desc')->get();
		$brand_product = DB::table('tbl_brand_product')->where('brand_status','0')->orderby('brand_id','desc')->get();
		return view('pages.cart.show-cart')->with('category', $cate_product)->with('brand', $brand_product);
	}
	public function delete_to_cart($rowId) {
		Cart::update($rowId, 0);
		return Redirect::to('show-cart');
	}
	public function update_cart_quatity(Request $request) {
		$rowId = $request->rowId_cart;
		$qty = $request->cart_quantity;
		Cart::update($rowId,$qty);
		return Redirect::to('/show-cart');
	}
	
}
