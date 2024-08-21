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

class HomeController extends Controller
{
    public function index(Request $request){

        // //seo 
        // $meta_desc = "Tìm kiếm sản phẩm"; 
        // $meta_keywords = "Tìm kiếm sản phẩm";
        // $meta_title = "Tìm kiếm sản phẩm";
        // $url_canonical = $request->url();
        //    //--seo  
        $category=DB::table('tbl_category_product')->where('category_status','0')->orderBy('category_id','desc')->get();
        $all_product =DB::table('tbl_product')->where('product_status','0')->orderBy('product_id','desc')->limit(12)->get();
        return view('pages.home')->with('category',$category)->with('all_product',$all_product);
       
       
    	
    }

    public function search(Request $request){
        $keywords = $request->keywords_submit;
        $category=DB::table('tbl_category_product')->where('category_status','0')->orderBy('category_id','desc')->get();
        
        $search_product = DB::table('tbl_product')->where('product_name','like','%'.$keywords.'%')->get(); 

        return view('pages.sanpham.search')->with('category',$category)->with('search_product',$search_product);
       
       
    }

    public function get_sp(Request $request){

        // //seo 
        // $meta_desc = "Tìm kiếm sản phẩm"; 
        // $meta_keywords = "Tìm kiếm sản phẩm";
        // $meta_title = "Tìm kiếm sản phẩm";
        // $url_canonical = $request->url();
        //    //--seo  
        $category=DB::table('tbl_category_product')->where('category_status','0')->orderBy('category_id','desc')->get();
        $all_product =DB::table('tbl_product')->where('product_status','0')->orderBy('product_id','desc')->limit(12)->get();
        return view('pages.sanpham.sanpham')->with('category',$category)->with('all_product',$all_product);
       
    	
    }

    
}
