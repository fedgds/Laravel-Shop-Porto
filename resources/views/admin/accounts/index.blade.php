@extends('admin.master')
@section('title', 'Quản lý tài khoản')
@section('main-content')
<div class="content-wrapper">
  <section class="content-header">
    <h1>
      Quản lý tài khoản
    </h1>
  </section>

  <!-- Main content -->
  <section class="content">

    <!-- Default box -->
    <div class="col-xs-12">
        <div class="box">
          <div class="box-header">
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
                  <th>Tên tài khoản</th>
                  <th>Email</th>
                  <th>Ngày tạo</th>
                  <th>Vai trò</th>
                  <th>Tùy chọn</th>
                </tr>
                @forelse ($accounts as $item)
                  <tr>
                    <td>{{$loop->iteration}}</td>
                    <td>{{$item->name}}</td>
                    <td>{{$item->email}}</td>
                    <td>{{$item->created_at}}</td>
                    <td>{!!$item->role ? '<span class="label label-success">Admin</span>' : '<span class="label label-warning">Người dùng</span>'!!}</td>
                    @if ($item->role != 1)
                        <td>
                        <form action="{{route('category.destroy', $item)}}" method="POST">
                          @csrf
                          @method("DELETE")
                          <button onclick="return confirm('Bạn có chắc muốn xóa?')" type="submit" class="btn btn-danger">Xóa</button>
                        </form>
                       </td>
                    @endif
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


