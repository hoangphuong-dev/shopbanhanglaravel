@extends('admin_layout')
@section('admin_content')
<div class="row">
    <div class="col-lg-12">
        <section class="panel">
            <header class="panel-heading">
                Cập nhật sản phẩm
            </header>
            <div class="panel-body">
                @php
                $message = Session::get('message');
                if($message) {
                    echo '<span class="text_alert">'.$message.'</span>';
                    Session::put('message', null);
                }
                @endphp
                <div class="position-center">
                    @foreach ($edit_product as $key => $pro)
                    <form role="form" method="post" action="{{URL::to('/update-product/'.$pro->product_id)}}" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label for="exampleinputemail1">Tên sản phẩm</label>
                            <input type="text" name="product_name" class="form-control" id="exampleinputemail1" value="{{ $pro->product_name }}">
                        </div>
                        <div class="form-group">
                            <label for="exampleinputemail1">Giá sản phẩm</label>
                            <input type="text" name="product_price" class="form-control" id="exampleinputemail1" value="{{ $pro->product_price }}">
                        </div>
                        <div class="form-group">
                           <label for="exampleinputpassword1">Hình ảnh sản phẩm</label>
                           <input type="file" name="product_image" class="form-control" id="exampleinputemail1">
                          <img width="100" height="100" src="../public/upload/product/{{$pro->product_image }}" alt="Đây là ảnh sản phẩm">
                       </div>
                       <div class="form-group">
                        <label for="exampleinputpassword1">Mô tả sản phẩm</label>
                        <textarea style="resize: none;" rows="5" type="text" name="product_desc" class="form-control" id="exampleinputpassword1" >{{ $pro->product_desc }}
                        </textarea>
                    </div>
                    <div class="form-group">
                        <label for="exampleinputpassword1">Nội dung sản phẩm</label>
                        <textarea style="resize: none;" rows="5" type="text" name="product_content" class="form-control" id="exampleinputpassword1">{{ $pro->product_content }}
                        </textarea>
                    </div>
                    <div class="form-group">
                        <label for="exampleinputfile">Danh mục sản phẩm</label>
                        <select name="product_category" class="form-control input-sm m-bot15">
                            @foreach ($cate_product as $key => $cate)
                            <option 
                            <?php if($cate->category_id == $pro->category_id) echo "selected" ?> 
                            value="{{ $cate->category_id }}">{{ $cate->category_name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="exampleinputfile">Thương hiệu sản phẩm</label>
                        <select name="product_brand" class="form-control input-sm m-bot15">
                            @foreach ($brand_product as $key => $brand)
                            <option 
                            <?php if($brand->brand_id == $pro->brand_id) echo "selected" ?> 
                            value="{{ $brand->brand_id }}">{{ $brand->brand_name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="exampleinputfile">Hiển thị</label>
                        <select name="product_status" class="form-control input-sm m-bot15">
                            <option value="0">ẩn</option>
                            <option value="1">hiển thị</option>
                        </select>
                    </div>
                    <button type="submit" name="add_category_product" class="btn btn-info">Cập nhật sản phẩm</button>
                </form>
                @endforeach
            </div>

        </div>
    </section>

</div>

</div>
@endsection