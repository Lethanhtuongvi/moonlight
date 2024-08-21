@extends('layout')
@section('content')
<div class="features_items"><!--features_items-->
       
                    <h2 class="title text-center" >  </h2>

                 
                    <div class="product-image-wrapper" style="border: none">
                    @foreach ($show_post as $key => $p)
                    <div class="clearfix" style="margin:20px">
                        <p style="font-size:20px ;color:rgba(241, 116, 14, 0.966) ;text-align: center; ">{{$p->post_title}}</p>
                        <p style="font-size:18px">{{$p->post_desc}}</p>
                        <img src="{{URL::to('public/uploads/post/'.$p->post_image)}}"  style="float: left ; width :100%; padding:5px" alt="" />
                      
                        <p style="font-size:18px">{{$p->post_content}}</p>
                      
                      
                      
                        
                      </div>
                    @endforeach
                   
                        <div class="choose">
                            <ul class="nav nav-pills nav-justified">
                                {{-- <li><a href="#"><i class="fa fa-plus-square"></i>Xem bài viết </a></li>
                                 --}}
                            </ul>
                        </div>
                    </div>
                        
                              
                      
                      
                    </div><!--features_items-->
                      {{-- <ul class="pagination pagination-sm m-t-none m-b-none">
                       {!!$all_product->links()!!}
                      </ul> --}}
        <!--/recommended_items-->
@endsection