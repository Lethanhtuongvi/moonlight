<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

use App\Http\Requests;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Redirect;
use PhpParser\Node\Stmt\Return_;

session_start();


class ProductController extends Controller
{
    // public function AuthLogin(){
    //     $admin_id = Session::get('admin_id');
    //     if($admin_id){
    //         return Redirect::to('dashboard');
    //     }else{
    //         return Redirect::to('admin')->send();
    //     }
    // }

    public function add_product(){
        // $this-> AuthLogin();
        $cate_product =DB::table('tbl_category_product')->orderBy('category_id','desc')->get();
        return view('admin.add_product')->with('cate_product',$cate_product);
    }
    
    //
    public function all_product(){
    // $this-> AuthLogin();
       $all_product = DB::table('tbl_product')
       ->join('tbl_category_product','tbl_category_product.category_id','=','tbl_product.category_id')
       ->orderBy('tbl_product.product_id','desc')->get();
       $manager_product = view('admin.all_product')->with('all_product',$all_product);
       return view('admin_layout')->with('admin.all_product',$manager_product );
    }

    public function save_product(Request $request){
        // $this-> AuthLogin();
       
        # lấy name = "ategory_product_name "  gửi yêu cầu qua biến $data['category_name'] ->trong csdl để lấy dữ liệu 
        $data = array();
    	$data['product_name'] = $request->product_name;
    	$data['product_price'] = $request->product_price;
    	$data['product_desc'] = $request->product_desc;
        $data['product_content'] = $request->product_content;
        $data['category_id'] = $request->product_cate;
        $data['product_status'] = $request->product_status;
        $data['product_image'] = $request->product_status;
        $get_image = $request->file('product_image');
        if($get_image){
            $get_name_image = $get_image->getClientOriginalName();
            $name_image = current(explode('.',$get_name_image));
            $new_image =  $name_image.rand(0,99).'.'.$get_image->getClientOriginalExtension();#mở rông đuôi ảnh
            $get_image->move('public/uploads/product',$new_image);
            $data['product_image']= $new_image;
            DB::table('tbl_product')->insert($data);
            Session::put('message','Thêm sản thành công');
            Return Redirect::to('all_product');
        }
        DB::table('tbl_product')->insert($data);
        $data['product_image']= ' ';
        Session::put('message','Thêm sản thành công');
        Return Redirect::to('add_product');


    }

    
    public function unactive_product($product_id){
        // $this-> AuthLogin();
        DB::table('tbl_product')->where('product_id',$product_id)->update(['product_status'=>1]);
        Session::put('message','Không kích hoạt danh mục sản phẩm thành công');
        return Redirect::to('all_product');
    }

    public function active_product($product_id){
        // $this-> AuthLogin();
        DB::table('tbl_product')->where('product_id',$product_id)->update(['product_status'=>0]);
        Session::put('message','Kích hoạt danh mục sản phẩm thành công');
        return Redirect::to('all_product');
    }

    public function edit_product($product_id){
        // $this-> AuthLogin();
        $cate_product =DB::table('tbl_category_product')->orderBy('category_id','desc')->get();
        $edit_product = DB::table('tbl_product')->where('product_id',$product_id)->get();

        $manager_product  = view('admin.edit_product')->with('edit_product',$edit_product)->with('cate_product', $cate_product);

        return view('admin_layout')->with('admin.edit_product', $manager_product);
    }

    public function delete_product($product_id){
        // $this-> AuthLogin();
        DB::table('tbl_product')->where('product_id',$product_id)->delete();
        Session::put('message','Xóa  sản phẩm thành công');
        return Redirect::to('all_product');
    }


    public function update_product(Request $request ,$product_id){
        // $this-> AuthLogin();
        $data = array();
    	$data['product_name'] = $request->product_name;
    	$data['product_price'] = $request->product_price;
    	$data['product_desc'] = $request->product_desc;
        $data['product_content'] = $request->product_content;
        $data['category_id'] = $request->product_cate;
        $data['product_status'] = $request->product_status;
        $data['product_image'] = $request->product_status;
        $get_image = $request->file('product_image');
        if($get_image){
            $get_name_image = $get_image->getClientOriginalName();
            $name_image = current(explode('.',$get_name_image));
            $new_image =  $name_image.rand(0,99).'.'.$get_image->getClientOriginalExtension();#mở rông đuôi ảnh
            $get_image->move('public/uploads/product',$new_image);
            $data['product_image']= $new_image;
            DB::table('tbl_product')->where('product_id',$product_id)->update($data);
            Session::put('message','Cập nhật sản thành công');
            Return Redirect::to('all_product');
        }
        DB::table('tbl_product')->where('product_id',$product_id)->update($data);
      
        Session::put('message','Cập nhật sản thành công');
        Return Redirect::to('all_product');

    }

    #frontend
    public function detials_product($product_id){
        $cate_product = DB::table('tbl_category_product')->where('category_status','0')->orderby('category_id','desc')->get();  

       
        $details_product = DB::table('tbl_product')
        ->join('tbl_category_product','tbl_category_product.category_id','=','tbl_product.category_id')
       
        ->where('tbl_product.product_id' ,$product_id)->get();

        foreach($details_product as $key => $value){
            $category_id = $value->category_id;
        }

        $related_product = DB::table('tbl_product')
        ->join('tbl_category_product','tbl_category_product.category_id','=','tbl_product.category_id')
       
        ->where('tbl_category_product.category_id',$category_id)->whereNotIn('tbl_product.product_id',[$product_id])->get();
        
        return view('pages.sanpham.show_details')->with('category',$cate_product)->with('product_detail',$details_product)->with('relate',$related_product);

    }


  

    
}
