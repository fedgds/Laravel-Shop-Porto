@extends('admin.master')
@section('title', 'Quản lý sản phẩm')
@section('main-content')
<div class="content-wrapper">
  <section class="content-header">
    <h1>
      Quản lý sản phẩm
    </h1>
  </section>

  <!-- Main content -->
  <section class="content">

    <!-- Default box -->
    <div class="col-xs-12">
        <div class="box">
          <div class="box-header">
            <form action="{{ route('product.index') }}" method="get" class="mb-2">
              <div class="row">
                <div class="col-xs-3">
                    <select name="category_id" class="form-control">
                        <option value="0">Tất cả mục</option>
                        @if (!empty(getAllCategories()))
                            @foreach (getAllCategories() as $item)
                                <option value="{{$item->id}}" {{request()->category_id==$item->id?'selected':false}}>{{$item->name}}</option>
                            @endforeach
                        @endif
                    </select>
                </div>
                <div class="col-xs-2">
                    <select name="status" class="form-control">
                        <option value="">Tất cả trạng thái</option>
                        <option value="0" {{request()->status=='0'?'selected':false}}>Hiển thị</option>
                        <option value="1" {{request()->status=='1'?'selected':false}}>Ẩn</option>
                    </select>
                </div>
                <div class="col-xs-5">
                  <input type="search" value="{{ request()->keywords }}" name="keywords" class="form-control" placeholder="Search...">
                </div>
                <div class="col-xs-2">
                    <button type="submit" class="btn btn-primary btn-block">Search</button>
                </div>
              </div>            
            </form>
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
                  <th>Nổi bật</th>
                  <th>Trạng thái</th>
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
                    <td>{!!$item->stock ? '<span class="label label-success">Nổi bật</span>' : '<span class="label label-warning">Không</span>'!!}</td>
                    <td>{!!$item->status ? '<span class="label label-success">Hiển thị</span>' : '<span class="label label-warning">Ẩn</span>'!!}</td>
                    <td>
                      <a href="{{route('product.edit', $item)}}" class="btn btn-success">Sửa</a>
                     </td>
                     <td>
                      <form action="{{route('product.destroy', $item)}}" method="POST">
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
            {{-- pagination --}}
            <div class="box-footer clearfix">
              <ul class="pagination pagination-sm no-margin pull-right">
                  @if ($products->onFirstPage())
                      <li class="disabled"><span>Start</span></li>
                  @else
                      <li><a href="{{ $products->url(1) }}">Start</a></li>
                  @endif
          
                  @if ($products->previousPageUrl())
                      <li><a href="{{ $products->previousPageUrl() }}">Previous</a></li>
                  @else
                      <li class="disabled"><span>Previous</span></li>
                  @endif
          
                  @foreach (range(1, $products->lastPage()) as $page)
                      <li class="{{ ($products->currentPage() == $page) ? 'active' : '' }}">
                          <a href="{{ $products->url($page) }}">{{ $page }}</a>
                      </li>
                  @endforeach
          
                  @if ($products->nextPageUrl())
                      <li><a href="{{ $products->nextPageUrl() }}">Next</a></li>
                  @else
                      <li class="disabled"><span>Next</span></li>
                  @endif
          
                  @if ($products->hasMorePages())
                      <li><a href="{{ $products->url($products->lastPage()) }}">End</a></li>
                  @else
                      <li class="disabled"><span>End</span></li>
                  @endif
              </ul>
            </div>
            {{-- end pagination --}}
            <a href="{{route('product.trash')}}" class="btn btn-primary"><i class="fa fa-trash"></i>Thùng rác</a>
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


