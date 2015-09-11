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
  <h3 class="box-title">{{ $attribute->attribute_name }} - Edit</h3>
</div><!-- /.box-header -->
<!-- form start -->
{!! Form::model($attribute, ['method' => 'PATCH', 'route' => ['am-admin.attribute.update', $attribute->id]]) !!}
  <div class="box-body">
    <div class="row">
      <div class="col-sm-6">
          <div class="form-group">
            {!! Form::label('attribute_name','Attribute Name',['class' => 'required']) !!}
            {!! Form::text('attribute_name', null, ['class' => 'form-control']) !!}
          </div>
      </div>
      <div class="col-sm-6">
          <div class="form-group">
            {!! Form::label('type','Editor Type',['class' => 'required']) !!}
            {!! Form::select('type', ['text' => 'Textfield', 'editor' => 'Rich Text Editor'],null, ['class' => 'form-control select2']) !!}
          </div>
      </div>
    </div>
    <div class="form-group">
      {!! Form::label('Description') !!}
      {!! Form::textarea('description', null, ['class' => 'form-control']) !!}
    </div>
  </div><!-- /.box-body -->

  <div class="box-footer">
    {!! Form::submit('Update Changes', ['class' => 'btn btn-primary']) !!}
  </div>
{!! Form::close() !!}
</div><!-- /.box -->

@stop