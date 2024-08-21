@extends('admin_layout')
@section('admin_content')

<div class="row">
    <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
                    CẬP NHẬT BÀI VIẾT 
                </header>
                <?php
                $message = Session::get('message');
                if($message){
                    echo '<span class="text-alert">'.$message.'</span>';
                    Session::put('message',null);
                }
                ?>
                <div class="panel-body">
                    <div class="position-center">
                        @foreach($edit_post as $key=>$post_edit)
                        <form role="form" action="{{URL::to('/update-post/'.$post_edit->post_id)}}" method="post" enctype="multipart/form-data">
                            {{ csrf_field() }}
                        <div class="form-group">
                            <label for="exampleInputEmail1">Tiêu đề bài viết  </label>
                            <input type="text" name ="post_title" class="form-control" id="exampleInputEmail1" value="{{$post_edit->post_title}}" >
                        </div>
                       
                        <div class="form-group">
                            <label for="exampleInputEmail1">Hình ảnh bài viết  </label>
                            <input type="file" name ="post_image" class="form-control" id="exampleInputEmail1" >
                            <img src="{{URL::to('public/uploads/post/'.$post_edit->post_image)}}" alt="" style=" height:100px ; weight:100px">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Mô tả bài viết </label>
                            <textarea style="resize: none " rows="5" class="form-control"  name="post_desc" id="exampleInputPassword1" >{{$post_edit->post_desc}}</textarea> 
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Nội bài viết  </label>
                            <textarea style="resize: none " rows="5" class="form-control"  name="post_content" id="exampleInputPassword1" >{{$post_edit->post_content}}</textarea> 
                        </div>

                        <div class="form-group">
                            
                            <label for="exampleInputPassword1"> Hiển thị </label>
                                <select name="post_status" class="form-control input-sm m-bot15">
                                    <option value="0"> Ẩn </option>
                                    <option value="1">Hiển thị bài viết </option>
                                </select>

                                    
                        </div>
                      
                      
                        <button type="submit" name="add_post" class="btn btn-info">Cập nhật bài viết</button>
                    </form>
                    @endforeach
                    </div>

                </div>
            </section>

    </div>
    
</div>
@endsection