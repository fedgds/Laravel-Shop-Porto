@extends('admin.master')
@section('title', 'Thêm danh mục')
@section('main-content')
<div class="content-wrapper">
  <section class="content-header">
    <h1>
      Thêm danh mục
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
            <form action="{{route('category.store')}}" method="post">
                @csrf
                <div class="box-body">
                    <div class="form-group">
                      <label for="exampleInputEmail1">Tên danh mục</label>
                      <input type="text" class="form-control" id="exampleInputEmail1" name="name" value="{{old('name')}}">
                        @error('name')
                            <span style="color: red">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">Chọn danh mục cha</label>
                      <select name="parent_id" id="parent_id" class="form-control">
                          <option value="">Chọn danh mục cha</option>
                          @foreach ($categories as $category)
                              @if ($category->parent_id === null)
                                  <option value="{{ $category->id }}">{{ $category->name }}</option>
                                  @if(count($category->childrenRecursive) > 0)
                                      @include('admin.categories.child_select', ['children' => $category->childrenRecursive, 'prefix' => '---'])
                                  @endif
                              @endif
                          @endforeach
                      </select>
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
                <div class="form-group box-footer">
                    <button class="btn btn-success">Thêm danh mục</button>
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


