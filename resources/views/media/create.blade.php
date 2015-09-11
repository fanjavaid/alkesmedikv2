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

{!! Form::open(['route' => 'am-admin.media.store', 'role' => 'form', 'enctype' => 'multipart/form-data']) !!}
<div class="box box-primary">
  <div class="box-header with-border">
      <h3 class="box-title">Add New</h3>
  </div><!-- /.box-header -->
  <div class="box-body">
      <div class="form-group">
        {!! Form::label('upload', 'Files to upload', ['class' => 'required']) !!}
        {!! Form::file('mediafile[]', ['multiple' => 'multiple']) !!}
        <p class="help-block">Allowed extension : png, jpg, jpeg, bmp. You can upload more than one images.</p>
        <div id="filedrag">Or drop files here</div>
      </div>
      <div class="form-group">
          {!! Form::label('categories', 'Categories', ['class' => 'required']) !!}
          {!! Form::select('categories[]', $categories, null, ['class' => 'form-control select2', 'multiple' => 'multiple', 'data-placeholder' => 'Select Categories', 'style' => 'width:100%']) !!}
      </div>
  </div><!-- /.box-body -->
  <div class="box-footer">
      {!! Form::submit('Upload Now', ['class' => 'btn btn-primary']) !!}
  </div>
</div><!-- /.box -->
{!! Form::close() !!}
@stop