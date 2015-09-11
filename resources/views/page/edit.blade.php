@extends('layouts.master')

@section('content')

@if($errors->any())
    <div class="callout callout-danger">
      @foreach($errors->all() as $error)
        <p>{{ $error }}</p>
      @endforeach
    </div>
@endif

@if(Session::has('flash_message'))
<div class="callout callout-success">
   <p>
      <i class="fa fa-check"></i> {!! Session::get('flash_message') !!} 
   </p>
</div>
@endif

<div class="box box-primary">
<div class="box-header with-border">
  <h3 class="box-title">{{ $page->title }} - Edit</h3>
</div><!-- /.box-header -->
<!-- form start -->
{!! Form::model($page, ['method' => 'PATCH', 'route' => ['am-admin.page.update', $page->id], 'role' => 'form', 'enctype' => 'multipart/form-data']); !!}
  <div class="box-body">
    <div class="form-group">
      {!! Form::label('title','Title',['class' => 'required']) !!}
      {!! Form::text('title', null, ['class' => 'form-control']) !!}
    </div>

    <div class="row">
      <div class="col-sm-6">
          <div class="form-group">
            {!! Form::label('author', 'Author', ['class' => 'required']) !!}
            {!! Form::select('user_id', $authors, $page->user->lists('id')->all(), ['class' => 'form-control select2', 'data-placeholder' => 'Select Author', 'style' => 'width:100%']) !!}
          </div>  
      </div>
      <div class="col-sm-6">
          <div class="form-group">
            {!! Form::label('parent_id', 'Parent Page', ['class' => 'required']) !!}
            {!! Form::select('parent_id', $pages, ($page->parent['id'] == null)? 0 : $page->parent['id'], ['class' => 'form-control select2', 'data-placeholder' => 'Select Author']) !!}
          </div>
      </div>
    </div>

    <div class="form-group">
      {!! Form::label('Content') !!}
      {!! Form::textarea('content', null, ['class' => 'form-control', 'id'=> 'content']) !!}
    </div>

    <div class="row">
      <div class="col-sm-6">
        <div class="form-group">
          {!! Form::label('Featured Image') !!}
          {!! Form::file('featured_image', null, ['class' => 'form-control']) !!}
          <p class="help-block">Allowed extension : png, jpg, jpeg, bmp.</p>
          @if(File::exists(base_path() . '/public/images/post/' . $page->featured_image) && $page->featured_image != null && $page->featured_image != '')
          <p>
            <img src="{{ url('/images/page/' . $page->featured_image) }}" style="width:30%">
            <br>
            <a href="{{ route('page.removeImage', $page->featured_image) }}" class="btn btn-danger btn-xs"><i class="fa fa-remove"></i> Remove Image</a>
          </p>
          @endif
        </div>
      </div>
      <div class="col-sm-6">
        <div class="form-group">
          {!! Form::label('Post Type') !!}
          {!! Form::text('post_type', 'page', ['class' => 'form-control', 'readonly']) !!}
        </div>
      </div>
    </div>

  </div><!-- /.box-body -->

  <div class="box-footer">
    {!! Form::submit('Update Changes', ['class' => 'btn btn-primary']) !!}
  </div>
{!! Form::close() !!}
</div><!-- /.box -->
@stop