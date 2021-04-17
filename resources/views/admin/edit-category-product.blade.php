@extends('admin_layout')
@section('admin_content')
<div class="row">
    <div class="col-lg-12">
        <section class="panel">
            <header class="panel-heading">
                Cập nhật danh mục sản phẩm
            </header>
            <div class="panel-body">
                @php
                $message = Session::get('message');
                if($message) {
                    echo '<span class="text_alert">'.$message.'</span>';
                    Session::put('message', null);
                }
                @endphp
                @foreach ($edit_category_product as $key => $edit_value)
                <div class="position-center">
                    <form role="form" method="post" action="{{URL::to('/update-category-product/'.$edit_value->category_id)}}">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label for="exampleInputEmail1">Tên danh mục</label>
                            <input value="{{ $edit_value->category_name }}" type="text" name="category_product_name" class="form-control" id="exampleInputEmail1" placeholder="Tên danh mục">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Mô tả danh mục</label>
                            <textarea style="resize: none;" rows="5" type="text" name="category_product_desc" class="form-control" id="exampleInputPassword1" placeholder="Mô tả danh mục">{{ $edit_value->category_desc }}</textarea>
                        </div>
                        <button type="submit" name="update_category_product" class="btn btn-info">Cập nhật danh mục</button>
                    </form>
                </div>
                @endforeach
            </div>
        </section>

    </div>

</div>
@endsection