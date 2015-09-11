@extends('layouts.master')

@section('content')

<div class="box box-primary">
<div class="box-header with-border">
  <h3 class="box-title">{{ $media->title }} - Details</h3>
</div><!-- /.box-header -->
<!-- form start -->
<div class="box-body">
    <div class="form-group">
      {!! Form::label('title','Title',['class' => 'required']) !!}
      <p>
        {{ $media->title }}
      </p>
    </div>

    <div class="form-group">
      {!! Form::label('categories', 'Categories', ['class' => 'required']) !!}
      <p>
        <?php $categoriesList = ""; ?>
        @foreach ($media->categories as $c)
            <?php $categoriesList .= $c->category_name . ', '; ?>
        @endforeach

        {{ substr($categoriesList, 0, strlen($categoriesList)-2) }}
      </p>
    </div>

    <div class="form-group">
      {!! Form::label('preview', 'Preview', ['class' => 'required']) !!}
      <p>
        <img src="{{ url($media->url) }}" style="width:30%">
      </p>
    </div>  

    <div class="form-group">
      {!! Form::label('Description') !!}
      <p>
        {!! $media->description !!}
      </p>
    </div>
</div><!-- /.box-body -->

<div class="box-footer">
  <a href="{{ route('am-admin.media.edit', $media->id) }}" class="btn btn-primary">Edit Post</a>
</div>
</div><!-- /.box -->
@stop