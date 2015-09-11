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
  <h3 class="box-title">{{ $post->title }} - Edit</h3>
</div><!-- /.box-header -->
<!-- form start -->
{!! Form::model($post, ['method' => 'PATCH', 'route' => ['am-admin.post.update', $post->id], 'role' => 'form', 'enctype' => 'multipart/form-data']); !!}
  <div class="box-body">
    <div class="form-group">
      {!! Form::label('title','Title',['class' => 'required']) !!}
      {!! Form::text('title', null, ['class' => 'form-control']) !!}
    </div>

    <div class="row">
      <div class="col-sm-6">
          <div class="form-group">
            {!! Form::label('author', 'Author', ['class' => 'required']) !!}
            {!! Form::select('user_id', $authors, $post->user->lists('id')->all(), ['class' => 'form-control select2', 'data-placeholder' => 'Select Author', 'style' => 'width:100%']) !!}
          </div>  
      </div>
      <div class="col-sm-6">
          <div class="form-group">
            {!! Form::label('categories', 'Categories', ['class' => 'required']) !!}
            {!! Form::select('categories[]', $categories, $post->categories->lists('id')->all(), ['class' => 'form-control select2', 'multiple' => 'multiple', 'data-placeholder' => 'Select Categories', 'style' => 'width:100%']) !!}
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
          <p>
            @if(File::exists(base_path() . '/public/images/post/' . $post->featured_image) && $post->featured_image != null && $post->featured_image != "")
                <img src="{{ url('/images/post/' . $post->featured_image) }}" style="width:30%">
                <br>
                <a href="{{ route('post.removeImage', $post->featured_image) }}" class="btn btn-danger btn-xs"><i class="fa fa-remove"></i> Remove Image</a>
            @endif
          </p>
        </div>
      </div>
      <div class="col-sm-6">
        <div class="form-group">
          {!! Form::label('Post Type') !!}
          {!! Form::text('post_type', 'post', ['class' => 'form-control', 'readonly']) !!}
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