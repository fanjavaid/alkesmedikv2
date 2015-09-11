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
  <h3 class="box-title">{{ $product->code }} - Detail</h3>
</div><!-- /.box-header -->
<!-- form start -->
  <div class="box-body">
    <div class="row">
      <div class="col-sm-4">
          <div class="form-group">
            {!! Form::label('code','Product Code',['class' => 'required']) !!}
            <p>
              {{ $product->code }}
            </p>
          </div>
      </div>
      <div class="col-sm-8">
          <div class="form-group">
            {!! Form::label('product_name','Product Name',['class' => 'required']) !!}
            <p>
              {{ $product->product_name }}
            </p>
          </div>
      </div>
    </div>

    <div class="row">
      <div class="col-sm-2">
        <div class="form-group">
          {!! Form::label('sku','SKU (Stock)',['class' => 'required']) !!}
          <p>
              {{ $product->sku }}
            </p>
        </div>
      </div>
      <div class="col-sm-2">
        <div class="form-group">
          {!! Form::label('price','Price') !!}
          <p>
              IDR {{ number_format($product->price) }}
            </p>
        </div>
      </div>
      <div class="col-sm-4">
        <div class="form-group">
          {!! Form::label('discount','Discount (%)') !!}
          <p>
            {{ $product->discount }}
          </p>
        </div>
      </div>
      <div class="col-sm-4">
        <div class="form-group">
            {!! Form::label('categories', 'Categories', ['class' => 'required']) !!}
            <p>
              <?php $categoriesList = ""; ?>
              @foreach ($product->categories as $c)
                  <?php $categoriesList .= $c->category_name . ', '; ?>
              @endforeach

              {{ substr($categoriesList, 0, strlen($categoriesList)-2) }}
            </p>
        </div>
      </div>
    </div>

    <div class="form-group">
      {!! Form::label('Description') !!}
      <p>
        {!! $product->description !!}
      </p>
    </div>

    <div class="row">
      <div class="col-sm-4">
        <div class="form-group">
          {!! Form::label('Featured Image') !!}
          <p>
            <img src="{{ url('/images/product/' . $product->featured_image) }}" style="width:100%">
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
        @foreach ($product->attributes as $attr)
            {!! Form::label('attribute_name', $attr->attribute_name, ['class' => 'required']) !!}
            <p>{{ $attr->pivot->value }}</p>
        @endforeach
    </div> 

    <div class="box-footer">
        <a href="{{ route('am-admin.product.edit', $product->id) }}" class="btn btn-primary">Edit Product</a>
    </div>
</div>

@stop