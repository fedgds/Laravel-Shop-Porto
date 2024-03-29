@extends('admin.master')
@section('title', 'Cập nhật sản phẩm')
@section('main-content')
<div class="content-wrapper">
  <section class="content-header">
    <h1>
      Cập nhật sản phẩm
    </h1>
  </section>

  <!-- Main content -->
  <section class="content">

    <!-- Default box -->
    <div class="col-xs-12">
        <div class="box">
          <!-- /.box-header -->
          <div class="box-body table-responsive no-padding">
            @if (session('error'))
                <div class="alert alert-danger text-center">{{session('error')}}</div>
            @endif
            @if (session('success'))
                <div class="alert alert-success text-center">{{session('success')}}</div>
            @endif
            <form action="{{route('product.update',$product)}}" method="post" enctype="multipart/form-data">
                @method('PUT')
                @csrf
                <input type="hidden" name="id" value="{{$product->id}}">
                <div class="box-body">
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="exampleInputEmail1">Tên sản phẩm</label>
                        <input type="text" class="form-control" id="productName" name="name" value="{{old('name') ?? $product->name}}" onkeyup="ChangeToSlug()">
                          @error('name')
                              <span style="color: red">{{$message}}</span>
                          @enderror
                      </div>
                      
                      <div class="form-group">
                        <label for="exampleInputEmail1">Giá sản phẩm</label>
                        <input type="text" class="form-control" id="exampleInputEmail1" name="price" value="{{old('price') ?? $product->price}}">
                          @error('price')
                              <span style="color: red">{{$message}}</span>
                          @enderror
                      </div>
  
                      <div class="form-group">
                        <label for="exampleInputEmail1">Ảnh sản phẩm</label>
                        <input type="file" class="form-control" id="exampleInputEmail1" name="photo">
                          @error('photo')
                              <span style="color: red">{{$message}}</span>
                          @enderror
                        <img src="{{asset('storage/images')}}/{{$product->image}}" alt="" width="50px">
                      </div>  

                      <div class="form-group">
                        <label for="exampleInputEmail1">Nổi bật: </label>
                        <div class="radio">
                          <label>
                            <input type="radio" name="stock" id="input" value="1" {{$product->stock == 1 ? 'checked' :false}}>
                            Nổi bật
                          </label>
                          <label>
                            <input type="radio" name="stock" id="input" value="0" {{$product->stock == 0 ? 'checked' :false}}>
                            Không
                          </label>
                        </div>
                        {{-- <input type="checkbox" name="stock" value="1" {{$product->stock == 1 ? 'checked' :false}}> --}}
                      </div>

                      <div class="form-group">
                        <label for="exampleInputEmail1">Chọn danh mục</label>
                        <select name="category_id" id="input" class="form-control">
                          <option value="">Chọn danh mục</option>
                          @foreach ($categories as $item)
                              <option value="{{$item->id}}" {{$product->category_id == $item->id ? 'selected':false}}>{{$item->name}}</option>
                          @endforeach
                        </select>
                        @error('category_id')
                              <span style="color: red">{{$message}}</span>
                          @enderror
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="exampleInputEmail1">Đường dẫn</label>
                        <input type="text" class="form-control" id="slug" name="slug" value="{{old('slug') ?? $product->slug}}">
                          @error('slug')
                              <span style="color: red">{{$message}}</span>
                          @enderror
                      </div>

                      <div class="form-group">
                        <label for="exampleInputEmail1">Giá khuyến mãi</label>
                        <input type="text" class="form-control" id="exampleInputEmail1" name="sale_price" value="{{old('sale_price') ?? $product->sale_price}}">
                          @error('sale_price')
                              <span style="color: red">{{$message}}</span>
                          @enderror
                      </div>

                      <div class="form-group">
                        <label for="exampleInputEmail1">Ảnh mô tả</label>
                        <input type="file" class="form-control" id="exampleInputEmail1" name="photos[]" multiple>
                          @error('photos')
                              <span style="color: red">{{$message}}</span>
                          @enderror
                          @foreach ($imgProduct as $item)
                              <img src="{{asset('storage/images')}}/{{$item->image}}" alt="" width="50px">
                          @endforeach
                      </div>

                      <div class="form-group">
                        <label for="exampleInputEmail1">Chọn trạng thái</label>
                        <div class="radio">
                          <label>
                            <input type="radio" name="status" id="input" value="1" {{$product->status == 1 ? 'checked' :false}}>
                            Hiện
                          </label>
                          <label>
                            <input type="radio" name="status" id="input" value="0" {{$product->status == 0 ? 'checked' :false}}>
                            Ẩn
                          </label>
                        </div>
                      </div>
                    </div>
                  </div>
                  
                    <div class="form-group">
                      <label for="exampleInputEmail1">Mô tả</label>
                      <textarea name="description" id="editor1" rows="10" cols="80">
                        {{old('description') ?? $product->description}}
                      </textarea>
                        @error('name')
                            <span style="color: red">{{$message}}</span>
                        @enderror
                    </div>
                    
                </div>
                <div class="form-group box-footer">
                    <button class="btn btn-success">Sửa sản phẩm</button>
                    <a href="{{route('product.index')}}" class="btn btn-success">Quay lại</a>
                </div>
            </form>
          </div>
          <!-- /.box-body -->
        </div>
        <!-- /.box -->
      </div>
    <!-- /.box -->

  </section>
  <!-- /.content -->
</div>
@endsection
@section('custom-js')
  
<script src="{{asset('assets')}}/ckeditor/ckeditor.js"></script>
<script>
  CKEDITOR.replace( 'editor1' );
</script>
<script language="javascript">
    function ChangeToSlug() {
    var productName, slug;

    // Lấy text từ thẻ input productName 
    productName = document.getElementById("productName").value;

    // Đổi chữ hoa thành chữ thường
    slug = productName.toLowerCase();

    // Đổi ký tự có dấu thành không dấu
    slug = slug.replace(/á|à|ả|ạ|ã|ă|ắ|ằ|ẳ|ẵ|ặ|â|ấ|ầ|ẩ|ẫ|ậ/gi, 'a');
    slug = slug.replace(/é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ/gi, 'e');
    slug = slug.replace(/i|í|ì|ỉ|ĩ|ị/gi, 'i');
    slug = slug.replace(/ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ/gi, 'o');
    slug = slug.replace(/ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự/gi, 'u');
    slug = slug.replace(/ý|ỳ|ỷ|ỹ|ỵ/gi, 'y');
    slug = slug.replace(/đ/gi, 'd');

    // Xóa các ký tự đặc biệt
    slug = slug.replace(/\`|\~|\!|\@|\#|\||\$|\%|\^|\&|\*|\(|\)|\+|\=|\,|\.|\/|\?|\>|\<|\'|\"|\:|\;|_/gi, '');

    // Đổi khoảng trắng thành ký tự gạch ngang
    slug = slug.replace(/ /gi, "-");

    // Đổi nhiều ký tự gạch ngang liên tiếp thành 1 ký tự gạch ngang
    // Phòng trường hợp người nhập vào quá nhiều ký tự trắng
    slug = slug.replace(/\-\-\-\-\-/gi, '-');
    slug = slug.replace(/\-\-\-\-/gi, '-');
    slug = slug.replace(/\-\-\-/gi, '-');
    slug = slug.replace(/\-\-/gi, '-');

    // Xóa các ký tự gạch ngang ở đầu và cuối
    slug = "@" + slug + "@";
    slug = slug.replace(/\@\-|\-\@|\@/gi, '');

    // Loại bỏ các dấu cách thừa
    slug = slug.replace(/\s+/g, '');

    // In slug ra textbox có id “slug”
    document.getElementById('slug').value = slug;
  }

</script>
@endsection

