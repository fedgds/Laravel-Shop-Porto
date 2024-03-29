@extends('admin.master')
@section('title', 'Quản lý danh mục')
@section('main-content')
<div class="content-wrapper">
  <section class="content-header">
    <h1>
      Quản lý danh mục
    </h1>
  </section>

  <!-- Main content -->
  <section class="content">

    <!-- Default box -->
    <div class="col-xs-12">
        <div class="box">
          <div class="box-header">

            {{-- <div class="box-tools">
              <div class="input-group input-group-sm" style="width: 150px;">
                <input type="text" name="table_search" class="form-control pull-right" placeholder="Search">

                <div class="input-group-btn">
                  <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
                </div>
              </div>
            </div> --}}
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
                  <th>Tên danh mục</th>
                  <th>Danh mục cha</th>
                  <th>Ngày tạo</th>
                  <th>Ngày sửa</th>
                  <th>Trạng thái</th>
                  <th colspan="2">Tùy chọn</th>
                </tr>
                @forelse ($categories as $item)
                  <tr>
                    <td>{{$loop->iteration}}</td>
                    <td>{{$item->name}}</td>
                    <td>{{$item->parent_id}}</td>
                    <td>{{$item->created_at}}</td>
                    <td>{{$item->updated_at}}</td>
                    <td>{!!$item->status ? '<span class="label label-success">Hiển thị</span>' : '<span class="label label-warning">Ẩn</span>'!!}</td>
                    <td>
                      <a href="{{route('category.edit', $item)}}" class="btn btn-success">Sửa</a>
                     </td>
                     <td>
                      <form action="{{route('category.destroy', $item)}}" method="POST">
                        @csrf
                        @method("DELETE")
                        <button onclick="return confirm('Bạn có chắc muốn xóa?')" type="submit" class="btn btn-danger">Xóa</button>
                      </form>
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
            <a href="{{route('category.create')}}" class="btn btn-success">+Thêm mới danh mục</a>
            <a href="{{route('category.trash')}}" class="btn btn-primary"><i class="fa fa-trash"></i>Thùng rác</a>
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


