@extends('admin_layout')
@section('admin_content')

<div class="row">
    <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
                    THÊM SẢN PHẨM 
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
                        <form role="form" action="{{URL::to('/save_product')}}" method="post" enctype="multipart/form-data">
                            {{ csrf_field() }}
                        <div class="form-group">
                            <label for="exampleInputEmail1">Tên sản phẩm </label>
                            <input type="text" name ="product_name" class="form-control" id="exampleInputEmail1" placeholder=" Tên danh mục ">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1"> Giá sản phẩm  </label>
                            <input type="text" name ="product_price" class="form-control" id="exampleInputEmail1" placeholder=" Tên danh mục ">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Hình ảnh sản phẩm </label>
                            <input type="file" name ="product_image" class="form-control" id="exampleInputEmail1" placeholder=" Tên danh mục ">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Mô tả sản phẩm </label>
                            <textarea style="resize: none " rows="5" class="form-control"  name="product_desc" id="ckeditor" placeholder="Mô tả sản phẩm  "></textarea> 
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Nội dung sản phẩm  </label>
                            <textarea style="resize: none " rows="5" class="form-control"  name="product_content" id="ckeditor1"  placeholder="Mô tả nội dung sản phẩm  "></textarea> 
                        </div>
                        <div class="form-group">
                            
                            <label for="exampleInputPassword1"> Danh mục sản phẩm  </label>
                                <select name="product_cate" class="form-control input-sm m-bot15">
                                    @foreach($cate_product as $key => $cate)
                                    <option value="{{$cate->category_id}}">{{$cate->category_name}}</option>
                                @endforeach
                                </select>

                                    
                        </div>
                        <div class="form-group">
                            
                            <label for="exampleInputPassword1"> Hiển thị </label>
                                <select name="product_status" class="form-control input-sm m-bot15">
                                    <option value="0"> Hiển thị danh mục </option>
                                    <option value="1">Ẩn</option>
                                </select>

                                    
                        </div>
                       
                        <button type="submit" name="add_category_product" class="btn btn-info">Thêm sản phẩm   </button>
                    </form>
                    </div>

                </div>
            </section>

    </div>
    
</div>
@endsection