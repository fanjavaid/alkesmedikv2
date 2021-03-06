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

{!! Form::model($product, ['method'=>'PATCH', 'route' => ['am-admin.product.update', $product->id], 'role' => 'form', 'enctype' => 'multipart/form-data']); !!}
<div class="box box-primary">
<div class="box-header with-border">
  <h3 class="box-title">{{ $product->product_name }} - Edit</h3>
</div><!-- /.box-header -->
<!-- form start -->
  <div class="box-body">
    <div class="row">
      <div class="col-sm-4">
          <div class="form-group">
            {!! Form::label('code','Product Code',['class' => 'required']) !!}
            {!! Form::text('code', null, ['class' => 'form-control']) !!}
          </div>
      </div>
      <div class="col-sm-8">
          <div class="form-group">
            {!! Form::label('product_name','Product Name',['class' => 'required']) !!}
            {!! Form::text('product_name', null, ['class' => 'form-control']) !!}
          </div>
      </div>
    </div>

    <div class="row">
      <div class="col-sm-2">
        <div class="form-group">
          {!! Form::label('sku','SKU (Stock)',['class' => 'required']) !!}
          {!! Form::text('sku', null, ['class' => 'form-control']) !!}
        </div>
      </div>
      <div class="col-sm-2">
        <div class="form-group">
          {!! Form::label('price','Price') !!}
          {!! Form::text('price', null, ['class' => 'form-control']) !!}
        </div>
      </div>
      <div class="col-sm-4">
        <div class="form-group">
          {!! Form::label('discount','Discount (%)') !!}
          {!! Form::text('discount', null, ['class' => 'form-control']) !!}
        </div>
      </div>
      <div class="col-sm-4">
        <div class="form-group">
            {!! Form::label('categories', 'Categories', ['class' => 'required']) !!}
            {!! Form::select('categories[]', $categories, $product->categories->lists('id')->all(), ['class' => 'form-control select2', 'multiple' => 'multiple', 'data-placeholder' => 'Select Categories', 'style' => 'width:100%']) !!}
        </div>
      </div>
    </div>

    <div class="form-group">
      {!! Form::label('Description') !!}
      {!! Form::textarea('description', null, ['class' => 'form-control', 'id'=> 'content']) !!}
    </div>

    <div class="row">
      <div class="col-sm-6">
        <div class="form-group">
          {!! Form::label('Featured Image') !!}
          {!! Form::file('featured_image', null, ['class' => 'form-control']) !!}
          <p class="help-block">Allowed extension : png, jpg, jpeg, bmp.</p>
          <p>
            @if(File::exists(base_path() . '/public/images/product/' . $product->featured_image) && $product->featured_image != null && $product->featured_image != "")
                <img src="{{ url('/images/product/' . $product->featured_image) }}" style="width:30%">
                <br>
                <a href="{{ route('product.removeImage', $product->featured_image) }}" class="btn btn-danger btn-xs"><i class="fa fa-remove"></i> Remove Image</a>
            @endif
          </p>
        </div>
      </div>
    </div>
  </div><!-- /.box-body -->
</div><!-- /.box -->

<!-- Box Attributes -->
<div class="box box-primary">
    <div class="box-header with-border">
      <h3 class="box-title">Attributes</h3>
      <div class="box-tools">
        <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
      </div>
    </div><!-- /.box-header -->
    
    <div class="box-body">
    @if ($attrElements != null)
        {{-- START: loop attributes --}}
        @foreach ($attrElements as $attr)
            <div class="form-group">
              {!! Form::label('attribute', $attr['name']) !!}
              {!! $attr['element'] !!}
            </div>
        @endforeach
        {{-- END: loop attributes --}}
    @endif
</div>

    <div class="box-footer">
        {!! Form::submit('Save Changes', ['class' => 'btn btn-primary']) !!}
    </div>
</div>

{!! Form::close() !!}
@stop