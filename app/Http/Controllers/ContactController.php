<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Contact;



class ContactController extends Controller
{
    public function lien_he(Request $request){

        //$slider = Slider::orderBy('slider_id','DESC')->where('slider_status','1')->take(4)->get();
      
        $meta_desc = "Liên hệ"; 
        $meta_keywords = "Liên hệ";
        $meta_title = "Liên hệ với chúng tôi";
        $url_canonical = $request->url();
        
        
    	$cate_product = DB::table('tbl_category_product')->where('category_status','0')->orderby('category_id','desc')->get(); 
        $contact = Contact::where('info_id',1)->get();
    	return view('pages.lienhe.contact')->with('category',$cate_product)->with('meta_desc',$meta_desc)->with('meta_keywords',$meta_keywords)->with('meta_title',$meta_title)->with('url_canonical',$url_canonical)->with('contact',$contact);
        //->with('all_product',$all_product)->with('slider',$slider);
    }
    public function information(){
        $contact = Contact::where('info_id',1)->get();
    	return view('admin.information.add_information')->with(compact('contact'));
    }
    public function save_info(Request $request){
        $data = $request->all();

    	$contact = new Contact;

    	$contact->info_contact = $data['info_contact'];
        $contact->info_map = $data['info_map'];
    	$contact->save();
        return redirect()->back()->with('message','Cập nhật thông tin website thành công');
    	
    }
    public function update_info(Request $request,$info_id){
        $data = $request->all();

    	$contact = Contact::find($info_id);

    	$contact->info_contact = $data['info_contact'];
        $contact->info_map = $data['info_map'];
    	$contact->save();
        return redirect()->back()->with('message','Cập nhật thông tin website thành công');
    	
    }
}
