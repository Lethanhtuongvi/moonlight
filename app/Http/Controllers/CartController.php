<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

use App\Http\Requests;
use App\Models\Coupon;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Redirect;
use PhpParser\Node\Stmt\Return_;
use Gloudemans\Shoppingcart\Facades\Cart;
session_start();

class CartController extends Controller
{
    // public function save_cart(Request $request){
      
    //     $productId = $request->productid_hidden;
    //     $quantity = $request->qty;
    //     $product_info = DB::table('tbl_product')->where('product_id',$productId)->first(); 
      
    //     $data['id']=$product_info->product_id;
    //     $data['qty'] = $quantity;
    //     $data['name'] = $product_info->product_name;
    //     $data['price'] = $product_info->product_price;
    //     $data['weight'] = $product_info->product_price;
    //     $data['options']['image'] = $product_info->product_image;
    //     Cart::add($data);
    //     // Cart::destroy();
    //     return Redirect::to('/show-cart');
    // }

    // public function show_cart(){

    //     $category=DB::table('tbl_category_product')->where('category_status','0')->orderBy('category_id','desc')->get();
    //     return view('pages.cart.show_cart')->with('category',$category);
    // }

    // public function delete_to_cart($rowId){
    //     Cart::update($rowId, 0);
    //     return Redirect::to('/show-cart');
    // }

    // public function update_cart_quantity(Request $request){
    //    $rowId = $request->rowId_cart;
    //    $qty = $request->cart_quantity;
    //    Cart::update($rowId, $qty);
    //    return Redirect::to('/show-cart');
    // }


    // ajax'
    public function add_cart_ajax(Request $request){
        $data = $request->all();

        $session_id = substr(md5(microtime()),rand(0,26),5);
        $cart = Session::get('cart');
        if($cart == TRUE){
            $is_avaiable =0;
            foreach($cart as $key =>$val){
                if($val['product_id']==$data['cart_product_id']){
                    $is_avaiable ++;
                }
            }
            if($is_avaiable==0){
                $cart[]= array(
                    'session_id' => $session_id,
                    'product_name'=>$data['cart_product_name'],
                    'product_id'=>$data['cart_product_id'],
                    'product_image'=>$data['cart_product_image'],
                    'product_price'=>$data['cart_product_price'],
                    'product_qty'=>$data['cart_product_qty']
                );
                Session::put('cart',$cart);
            }
        }else{
            $cart[]= array(
                'session_id' => $session_id,
                'product_name'=>$data['cart_product_name'],
                'product_id'=>$data['cart_product_id'],
                'product_image'=>$data['cart_product_image'],
                'product_price'=>$data['cart_product_price'],
                'product_qty'=>$data['cart_product_qty']



                
            );
        }
        Session::put('cart',$cart);
        Session::save();

     


    }

    public function gio_hang(){
        
        $category=DB::table('tbl_category_product')->where('category_status','0')->orderBy('category_id','desc')->get();
        return view('pages.cart.cart_ajax')->with('category',$category);
    }

    public function delete_product($session_id){
        $cart = Session::get('cart');
       
        if($cart==true){
            foreach($cart as $key => $val){
                if($val['session_id']==$session_id){
                    unset($cart[$key]);
                }
            }
            Session::put('cart',$cart);
            return redirect()->back()->with('message','Xóa sản phẩm thành công');

        }else{
            return redirect()->back()->with('message','Xóa sản phẩm thất bại');
        }
    }

    public function update_cart (Request $request){
        $data = $request->all();
        $cart = Session::get('cart');
        if($cart==true){
            // $message = '';

            foreach($data['cart_qty'] as $key => $qty){
                // $i = 0;
                
                foreach($cart as $session => $val){

                //     $i++;

                     if($val['session_id']==$key){

                         $cart[$session]['product_qty'] = $qty;
                //         $message.='<p style="color:blue">'.$i.') Cập nhật số lượng :'.$cart[$session]['product_name'].' thành công</p>';

                //     }elseif($val['session_id']==$key && $qty>$cart[$session]['product_quantity']){
                //         $message.='<p style="color:red">'.$i.') Cập nhật số lượng :'.$cart[$session]['product_name'].' thất bại</p>';
                    }

                }

            }

             Session::put('cart',$cart);
            return redirect()->back()->with('message','Cập nhật số lượng thành công ');
        }
        else{
                 return redirect()->back()->with('message','Cập nhật số lượng thất bại');
          }
        
    }

    public function delete_all_product(){
        $cart = Session::get('cart');
        if($cart==true){
            // Session::destroy();
            Session::forget('cart');
            Session::forget('coupon');
            return redirect()->back()->with('message','Xóa hết giỏ thành công');
        }
    }


    public function check_coupon(Request $request){
        $data= $request->all();
        $coupon = Coupon::where('coupon_code',$data['coupon'])->first();
        if($coupon){
            $cout_coupon = $coupon->count();
            if($cout_coupon >0){
                $coupon_session = Session::get('coupon');
                if($coupon_session==true){
                    $is_avaiable =0;
                    if($is_avaiable==0){
                        $cou []=array(
                            'coupon_code' => $coupon->coupon_code,
                            'coupon_condition' => $coupon->coupon_condition,
                            'coupon_number' => $coupon->coupon_number,

                        );
                        Session::put('coupon',$cou);
                    }
                }else{
                    $cou []=array(
                        'coupon_code' => $coupon->coupon_code,
                        'coupon_condition' => $coupon->coupon_condition,
                        'coupon_number' => $coupon->coupon_number,

                    );
                    Session::put('coupon',$cou);
                }
                Session::save();
                return redirect()->back()->with('message','Thêm mã giảm giá thành công');
            }
        } 

         else{
            return redirect()->back()->with('error','Mã giảm giá không đúng');
        }

    }

        
}


