<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Add\Models\Post;
use App\Http\Requests;
use App\Models\Post as ModelsPost;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Redirect;
use PhpParser\Node\Stmt\Return_;

session_start();

class PostController extends Controller
{
    // public function AuthLogin(){
    //     $admin_id = Session::get('admin_id');
    //     if($admin_id){
    //         return Redirect::to('dashboard');
    //     }else{
    //         return Redirect::to('admin')->send();
    //     }
    // }

    public function add_post(){
        // $this-> AuthLogin();
        $cate_product =DB::table('tbl_category_product')->orderBy('category_id','desc')->get();
        return view('admin.post.add_post')->with('cate_product',$cate_product);
    }
    
    //
    public function all_post(){
    //    $this-> AuthLogin();
        # lấy tất cả dữ liễu thuộc bảng danh mục và gán vào biến  $all_category_product
        $all_post= DB::table('tbl_post')->orderBy('post_id','desc')->paginate(10);
        # vào view gọi 'admin.all_category_product' nơi hiển thị  
        # name ="all_category_product" biến foreach all 
        $manager_post = view('admin.post.all_post')->with('all_post',$all_post);
        return view('admin_layout')->with('admin.post.all_post',$manager_post );
        
    }

    public function save_post(Request $request){
        // $this-> AuthLogin();
       
        # lấy name = "ategory_product_name "  gửi yêu cầu qua biến $data['category_name'] ->trong csdl để lấy dữ liệu 
        $data = array();
    	$data['post_title'] = $request->post_title;
    	$data['post_desc'] = $request->post_desc;
        $data['post_content'] = $request->post_content;
        $data['post_status'] = $request->post_status;
        $data['post_image'] = $request->post_image;
        $get_image = $request->file('post_image');
        if($get_image){
            $get_name_image = $get_image->getClientOriginalName();
            $name_image = current(explode('.',$get_name_image));
            $new_image =  $name_image.rand(0,99).'.'.$get_image->getClientOriginalExtension();#mở rông đuôi ảnh
            $get_image->move('public/uploads/post',$new_image);
            $data['post_image']= $new_image;
            DB::table('tbl_post')->insert($data);
            Session::put('message','Thêm bài viết  thành công');
            return Redirect::to('all-post');
        }
        DB::table('tbl_product')->insert($data);
        $data['product_image']= ' ';
        Session::put('message','Thêm bài viết  thành công');
        return Redirect::to('all-post');


    }

    


    public function edit_post($post_id){
        // $this-> AuthLogin();
        // $all_post= DB::table('tbl_post')->orderBy('post_id','desc')->paginate(10);
        $edit_post = DB::table('tbl_post')->where('post_id',$post_id)->get();

        $manager_post  = view('admin.post.edit_post')->with('edit_post',$edit_post);

        return view('admin_layout')->with('admin.post.edit_post', $manager_post);
    }

    public function delete_post($post_id){
        // $this-> AuthLogin();
        DB::table('tbl_post')->where('post_id',$post_id)->delete();
        Session::put('message','Xóa  sản phẩm thành công');
        return Redirect::to('all-post');
    }


    public function update_post(Request $request ,$post_id){
        // $this-> AuthLogin();
        $data = array();
    	$data['post_title'] = $request->post_title;
        $data['post_desc'] = $request->post_desc;
        $data['post_content'] = $request->post_content;
        $data['post_status'] = $request->post_status;
        $data['post_image'] = $request->post_image;
        $get_image = $request->file('post_image');
        if($get_image){
            $get_name_image = $get_image->getClientOriginalName();
            $name_image = current(explode('.',$get_name_image));
            $new_image =  $name_image.rand(0,99).'.'.$get_image->getClientOriginalExtension();#mở rông đuôi ảnh
            $get_image->move('public/uploads/post',$new_image);
            $data['post_image']= $new_image;
            DB::table('tbl_post')->where('post_id',$post_id)->update($data);
            Session::put('message','Cập nhật sản thành công');
            Return Redirect::to('all-post');
        }
        DB::table('tbl_post')->where('post_id',$post_id)->update($data);
      
        Session::put('message','Cập nhật sản thành công');
        Return Redirect::to('all-post');

    }

    // #frontend
    // public function detials_product($product_id){
    //     $cate_product = DB::table('tbl_category_product')->where('category_status','0')->orderby('category_id','desc')->get();  

       
    //     $details_product = DB::table('tbl_product')
    //     ->join('tbl_category_product','tbl_category_product.category_id','=','tbl_product.category_id')
       
    //     ->where('tbl_product.product_id' ,$product_id)->get();

    //     foreach($details_product as $key => $value){
    //         $category_id = $value->category_id;
    //     }

    //     $related_product = DB::table('tbl_product')
    //     ->join('tbl_category_product','tbl_category_product.category_id','=','tbl_product.category_id')
       
    //     ->where('tbl_category_product.category_id',$category_id)->whereNotIn('tbl_product.product_id',[$product_id])->get();
        
    //     return view('pages.sanpham.show_details')->with('category',$cate_product)->with('product_detail',$details_product)->with('relate',$related_product);

    // }

    public function danh_muc_bai_viet(){
        $category=DB::table('tbl_category_product')->where('category_status','0')->orderBy('category_id','desc')->get();
        $all_product =DB::table('tbl_product')->where('product_status','0')->orderBy('product_id','desc')->limit(7)->get();

        $show_post= DB::table('tbl_post')->orderBy('post_id','desc')->paginate(10);
        # vào view gọi 'admin.all_category_product' nơi hiển thị  
       
      
        return view('pages.bai_viet.post')->with('category',$category)->with('all_product',$all_product)->with('show_post',$show_post);
       
       
    }

    public function bai_viet(){

    }
    
    public function chi_tiet_bai_viet(Request $request,$post_id){
        $category=DB::table('tbl_category_product')->where('category_status','0')->orderBy('category_id','desc')->get();
        $all_product =DB::table('tbl_product')->where('product_status','0')->orderBy('product_id','desc')->limit(4)->get();

        $show_post= DB::table('tbl_post')->orderBy('post_id','desc')->take(1)->get();
       
       
      
        return view('pages.bai_viet.chi_tiet_bai_viet')->with('category',$category)->with('all_product',$all_product)->with('show_post',$show_post);
       
    }
    

   
}
