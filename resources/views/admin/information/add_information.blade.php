@extends('admin_layout')
@section('admin_content')
<div class="row">
            <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                           Thêm thông tin website
                        </header>
                        <?php
                                $message = Session::get('message');
                                if($message){
                                    echo '<span class="text-alert" style="color: red;font-size: 17px;width: 100%;text-align: center;font-weight: bold;">'.$message.'</span>';
                                    Session::put('message',null);
                                }
                            ?>
                        <div class="panel-body">

                            <div class="position-center">
                            @foreach($contact as $key => $cont)
                                <form role="form" action="{{URL::to('/update-info/'.$cont->info_id)}}" method="post">
                                    {{ csrf_field() }}
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Thông tin liên hệ</label>
                                    <textarea style="resize: none" rows="8" class="form-control" name="info_contact" id="ckeditor" placeholder="Mô tả danh mục">{{$cont->info_contact}}"</textarea>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Bản đồ</label>
                                    <textarea style="resize: none" rows="8" class="form-control" name="info_map" id="exampleInputPassword1" placeholder="Mô tả danh mục">{{$cont->info_map}}"</textarea>
                                </div>

                                <button type="submit" name="add_info" class="btn btn-info">Cập nhật thông tin</button>
                                </form>
                            @endforeach
                            </div>

                        </div>
                    </section>

            </div>
@endsection