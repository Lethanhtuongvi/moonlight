@extends('admin_layout')
@section('admin_content')

<div class="row">
    <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
                    THÊM BÀI VIẾT 
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
                        <form role="form" action="{{URL::to('/save-post')}}" method="post" enctype="multipart/form-data">
                            {{ csrf_field() }}
                        <div class="form-group">
                            <label for="exampleInputEmail1"> Tiêu đề bài viết </label>
                            <input type="text" name ="post_title" class="form-control" id="exampleInputEmail1" placeholder=" Tên danh mục ">
                        </div>
                       
                        <div class="form-group">
                            <label for="exampleInputEmail1">Hình ảnh bài viết </label>
                            <input type="file" name ="post_image" class="form-control" id="exampleInputEmail1" placeholder=" Tên danh mục ">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Mô tả bài viết  </label>
                            <textarea style="resize: none " rows="5" class="form-control"  name="post_desc" id="ckeditor" placeholder="Mô tả sản phẩm  "></textarea> 
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Nội dung bài viết </label>
                            <textarea style="resize: none " rows="5" class="form-control"  name="post_content" id="ckeditor1"  placeholder="Mô tả nội dung sản phẩm  "></textarea> 
                        </div>
                        <div class="form-group">
                            
                            <label for="exampleInputPassword1"> Hiển thị </label>
                                <select name="post_status" class="form-control input-sm m-bot15">
                                    <option value="0"> Ẩn </option>
                                    <option value="1">Hiển thị bài viết </option>
                                </select>

                                    
                        </div>
                     
                       
                        <button type="submit" name="add_post" class="btn btn-info">Thêm bài viết    </button>
                    </form>
                    </div>

                </div>
            </section>

    </div>
    
</div>
@endsection