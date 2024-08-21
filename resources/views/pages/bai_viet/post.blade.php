@extends('layout')
@section('content')
<div class="features_items"><!--features_items-->
       
                    <h2 class="title text-center"> DANH MỤC BÀI VIẾT </h2>

                    @foreach ($show_post as $key => $p)
                    <div class="clearfix">
                        <img src="{{URL::to('public/uploads/post/'.$p->post_image)}}"  style="float: left ; width :30%; padding:5px" class="col-md-6 float-md-end mb-3 ms-md-3" alt="...">
                      
                        
                            <p style="color:rgba(241, 116, 14, 0.966) ;font-size:20px;float: right" >{{$p->post_desc}}</p>
                        
                      
                            @extends('layout')
                            @section('content')
                            <div class="features_items"><!--features_items-->
                                   
                                                <h2 class="title text-center"> DANH MỤC BÀI VIẾT </h2>
                            
                                                @foreach ($show_post as $key => $p)
                                                <div class="product-image-wrapper">
                                                       
                                                    <div class="single-products">
                                                            <div class=" post">                                                  
                                                                <a href="{{URL::to('/bai-viet/'.$p->post_id)}}" style="color: black">
                                                                    
                                                                    <img src="{{URL::to('public/uploads/post/'.$p->post_image)}}"  style="float: left ; width :30%; padding:5px" alt="" />
                                                                    <p style="font-size:20px ;color:rgba(241, 116, 14, 0.966)">{{$p->post_title}}</p>
                                                                    <p style="font-size:18px">{{$p->post_desc}}</p>
                                                                 </a> 
                            
                                                                 <div class="text-right">
                                                                    <a href="{{url('/chi-tiet-bai-viet/'.$p->post_id)}}"  style="color:rgb(235, 170, 51)" class="btn btn-default btn-sm"> Xem bài viết </a>
                                                                 </div>
                                                              
                            
                                                            </div>
                                                          
                                                    </div>
                            
                                                    <div class="clearfix"></div>
                                               
                                                    <div class="choose">
                                                        <ul class="nav nav-pills nav-justified">
                                                            {{-- <li><a href="#"><i class="fa fa-plus-square"></i>Xem bài viết </a></li>
                                                             --}}
                                                        </ul>
                                                    </div>
                                                </div>
                                                    
                                                @endforeach
                                                    
                                                  
                                                  
                                </div>
                            @endsection  
                      </div>
                       
                      
                       
                       
                      </div>
                        
                    @endforeach
                        
                      
                      
    </div>
@endsection