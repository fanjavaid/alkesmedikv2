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
  <h3 class="box-title">Add New</h3>
</div><!-- /.box-header -->
<!-- form start -->
{!! Form::open(['route' => 'am-admin.category.store', 'role' => 'form']); !!}
  <div class="box-body">
    <div class="form-group">
      {!! Form::label('category_name','Category Name',['class' => 'required']) !!}
      {!! Form::text('category_name', null, ['class' => 'form-control']) !!}
    </div>
    <div class="form-group">
      {!! Form::label('Description') !!}
      {!! Form::textarea('description', null, ['class' => 'form-control']) !!}
    </div>
  </div><!-- /.box-body -->

  <div class="box-footer">
    {!! Form::submit('Save Changes', ['class' => 'btn btn-primary']) !!}
  </div>
{!! Form::close() !!}
</div><!-- /.box -->

@stop