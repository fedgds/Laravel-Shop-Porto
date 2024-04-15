@extends('admin.master')
@section('title', 'Thêm sản phẩm')
@section('main-content')
<div class="content-wrapper">
  <section class="content-header">
    <h1>
      Thêm sản phẩm
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
            <form action="{{route('product.store')}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="box-body">
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="exampleInputEmail1">Tên sản phẩm</label>
                        <input type="text" class="form-control" id="productName" name="name" value="{{old('name')}}" onkeyup="ChangeToSlug()">
                          @error('name')
                              <span style="color: red">{{$message}}</span>
                          @enderror
                      </div>
                      
                      <div class="form-group">
                        <label for="exampleInputEmail1">Giá sản phẩm</label>
                        <input type="text" class="form-control" id="exampleInputEmail1" name="price" value="{{old('price')}}">
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
                      </div>  

                      <div class="form-group">
                        <label for="exampleInputEmail1">Nổi bật: </label>
                        <input type="checkbox" name="stock" value="1">
                      </div>

                      <div class="form-group">
                        <label for="exampleInputEmail1">Chọn danh mục</label>
                        <select name="category_id" id="input" class="form-control">
                          <option value="">Chọn danh mục</option>
                          @foreach ($categories as $category)
                              @if ($category->parent_id === null)
                                  <option value="{{ $category->id }}">{{ $category->name }}</option>
                                  @if(count($category->childrenRecursive) > 0)
                                      @include('admin.categories.child_select', ['children' => $category->childrenRecursive, 'prefix' => '---'])
                                  @endif
                              @endif
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
                        <input type="text" class="form-control" id="slug" name="slug" value="{{old('slug')}}">
                        @error('slug')
                            <span style="color: red">{{$message}}</span>
                        @enderror
                      </div>

                      <div class="form-group">
                        <label for="exampleInputEmail1">Giá khuyến mãi</label>
                        <input type="text" class="form-control" id="exampleInputEmail1" name="sale_price" value="{{old('sale_price')}}">
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
                      </div>

                      <div class="form-group">
                        <label for="exampleInputEmail1">Chọn trạng thái</label>
                        <div class="radio">
                          <label>
                            <input type="radio" name="status" id="input" value="1" checked="checked">
                            Hiện
                          </label>
                          <label>
                            <input type="radio" name="status" id="input" value="0" >
                            Ẩn
                          </label>
                        </div>
                      </div>
                    </div>
                  </div>

                    <div class="form-group">
                      <label for="exampleInputEmail1">Mô tả</label>
                      <textarea name="description" id="editor1" rows="10" cols="80"></textarea>
                        
                    </div>
                    
                </div>
                <div class="form-group box-footer">
                    <button class="btn btn-success">Thêm sản phẩm</button>
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