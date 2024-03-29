@extends('admin.master')
@section('title', 'Cập nhật danh mục')
@section('main-content')
<div class="content-wrapper">
  <section class="content-header">
    <h1>
      Cập nhật danh mục
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
            <form action="{{route('category.update',$category)}}" method="post">
                @method('PUT')
                @csrf
                <input type="hidden" name="id" value="{{$category->id}}">
                <div class="box-body">
                    <div class="form-group">
                      <label for="exampleInputEmail1">Tên danh mục</label>
                      <input type="text" class="form-control" id="exampleInputEmail1" name="name" value="{{old('name') ?? $category->name}}">
                        @error('name')
                            <span style="color: red">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">Chọn danh mục cha</label>
                      <select name="parent_id" id="input" class="form-control">
                          <option value="">Chọn danh mục cha</option>
                          @foreach ($categories as $item)
                              @if ($item->id != $category->id && $item->parent_id === null) <!-- Loại bỏ danh mục đang chỉnh sửa và chỉ hiển thị các danh mục cha -->
                                  <option value="{{ $item->id }}" {{ $category->parent_id == $item->id ? 'selected' : '' }}>
                                      {{ $item->name }}
                                  </option>
                                  @if(count($item->childrenRecursive) > 0)
                                      @include('admin.categories.child_select', ['children' => $item->childrenRecursive, 'prefix' => '---', 'selected' => $category->parent_id])
                                  @endif
                              @endif
                          @endforeach
                      </select>
                  </div>
                                                
                  
                    <div class="form-group">
                      <label for="exampleInputEmail1">Chọn trạng thái</label>
                      <div class="radio">
                        <label>
                          <input type="radio" name="status" id="input" value="1" {{$category->status == 1 ? 'checked' :false}}>
                          Hiện
                        </label>
                        <label>
                          <input type="radio" name="status" id="input" value="0" {{$category->status == 0 ? 'checked' :false}}>
                          Ẩn
                        </label>
                      </div>
                    </div>
                </div>
                <div class="form-group box-footer">
                    <button class="btn btn-success">Sửa danh mục</button>
                    <a href="{{route('category.index')}}" class="btn btn-success">Quay lại</a>
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


