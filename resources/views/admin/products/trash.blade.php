@extends('admin.master')
@section('title', 'Sản phẩm đã xóa')
@section('main-content')
<div class="content-wrapper">
  <section class="content-header">
    <h1>
      Sản phẩm đã xóa
    </h1>
  </section>

  <!-- Main content -->
  <section class="content">

    <!-- Default box -->
    <div class="col-xs-12">
        <div class="box">
          <div class="box-header">
            <a href="{{route('product.index')}}" class="btn btn-primary">Trở lại</a>
            <div class="box-tools">
              <div class="input-group input-group-sm" style="width: 150px;">
                <input type="text" name="table_search" class="form-control pull-right" placeholder="Search">

                <div class="input-group-btn">
                  <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
                </div>
              </div>
            </div>
          </div>
          <!-- /.box-header -->
          <div class="box-body table-responsive no-padding">
            @if (session('success'))
                <div class="alert alert-success text-center">{{session('success')}}</div>
            @endif
            <table class="table table-hover table-bordered text-center table-striped">
              <tbody>
                <tr>
                  <th>STT</th>
                  <th>Tên</th>
                  <th>Giá</th>
                  <th>Giá KM</th>
                  <th>Danh mục</th>
                  <th>Ảnh</th>
                  <th colspan="2">Tùy chọn</th>
                </tr>
                @forelse ($products as $item)
                  <tr>
                    <td>{{$loop->iteration}}</td>
                    <td>{{$item->name}}</td>
                    <td>{{number_format($item->price)}} đ</td>
                    <td>{{number_format($item->sale_price)}} đ</td>
                    <td>{{$item->category->name}}</td>
                    <td>
                      <img src="{{asset('storage/images')}}/{{$item->image}}" alt="" height="60px">
                    </td>
                    <td>
                      <a href="{{route('product.restore', $item)}}" class="btn btn-success">Khôi phục</a>
                      <a onclick="return confirm('Bạn có chắc muốn xóa?')" href="{{route('product.forceDelete', $item)}}" class="btn btn-danger">Xóa</a>
                     </td>
                  </tr>
                @empty
                    {{-- Xử lý khi rỗng --}}
                  <tr>
                    <td class="text-center" colspan="8">Chưa có dữ liệu</td>
                  </tr>
                @endforelse
              
              </tbody>
            </table>
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


