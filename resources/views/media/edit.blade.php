@extends('layouts.master')

@section('content')
{{-- <p>
	<a href="{{ route('post.create') }}" class="btn btn-danger">Add New</a>
</p> --}}

<style type="text/css">
    #filedrag {
      display: none;
      font-weight: bold;
      text-align: center;
      padding: 1em 0;
      margin: 1em 0;
      color: #555;
      border: 2px dashed #555;
      border-radius: 7px;
      cursor: default;
    }

    #filedrag.hover {
      color: #f00;
      border-color: #f00;
      border-style: solid;
      box-shadow: inset 0 3px 4px #888;
    }
</style>

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

{!! Form::model($media, ['method' => 'PATCH', 'route' => ['am-admin.media.update', $media->id]]) !!}
<div class="box box-primary">
  <div class="box-header with-border">
      <h3 class="box-title">{{ $media->title }} - Edit</h3>
  </div><!-- /.box-header -->
  <div class="box-body">
      <div class="form-group">
        {!! Form::label('title', 'Title', ['class' => 'required']) !!}
        {!! Form::text('title', null, ['class' => 'form-control']) !!}
      </div>
      <div class="form-group">
          {!! Form::label('categories', 'Categories', ['class' => 'required']) !!}
          {!! Form::select('categories[]', $categories, $media->categories->lists('id')->all(), ['class' => 'form-control select2', 'multiple' => 'multiple', 'data-placeholder' => 'Select Categories', 'style' => 'width:100%']) !!}
      </div>
      <div class="form-group">
        {!! Form::label('description', 'Description') !!}
        {!! Form::textarea('description', null, ['class' => 'form-control']) !!}
      </div>
      <div class="form-group">
          {!! Form::label('preview', 'Preview', ['class' => 'required']) !!}
          <p>
            <img src="{{ url($media->url) }}" style="width:30%">
          </p>
      </div>
  </div><!-- /.box-body -->
  <div class="box-footer">
      {!! Form::submit('Update Changes', ['class' => 'btn btn-primary']) !!}
  </div>
</div><!-- /.box -->
{!! Form::close() !!}
@stop