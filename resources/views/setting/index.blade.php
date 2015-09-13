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
  <h3 class="box-title">Site Configuration</h3>
</div><!-- /.box-header -->
<!-- form start -->
{!! Form::model($setting, ['method' => 'PATCH','route' => ['am-admin.setting.update', $setting->id], 'role' => 'form', 'enctype' => 'multipart/form-data']); !!}
  <div class="box-body">
    <div class="form-group">
      {!! Form::label('site_title','Site Title',['class' => 'required']) !!}
      {!! Form::text('site_title', null, ['class' => 'form-control']) !!}
    </div>
    <div class="form-group">
      {!! Form::label('tagline', 'Tagline') !!}
      {!! Form::text('tagline', null, ['class' => 'form-control']) !!}
    </div>
    <div class="form-group">
      {!! Form::label('email_address', 'Email Address') !!}
      {!! Form::text('email_address', null, ['class' => 'form-control']) !!}
    </div>
    <div class="form-group">
      {!! Form::label('Banner') !!}
      {!! Form::file('site_banner', null, ['class' => 'form-control']) !!}
      <p class="help-block">Allowed extension : png, jpg, jpeg, bmp.</p>
      @if ($setting->site_banner != null && $setting->site_banner != '')
        <img src="{{ asset("images/setting/$setting->site_banner") }}" alt="Site Banner" style="width:50%">
      @endif
    </div>
  </div><!-- /.box-body -->

  <div class="box-footer">
    {!! Form::submit('Save Changes', ['class' => 'btn btn-primary']) !!}
  </div>
{!! Form::close() !!}
</div><!-- /.box -->

@stop