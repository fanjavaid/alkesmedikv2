@extends('layouts.master')

@section('content')

<div class="box box-primary">
<div class="box-header with-border">
  <h3 class="box-title">{{ $post->title }} - Details</h3>
</div><!-- /.box-header -->
<!-- form start -->
  <div class="box-body">
    <div class="form-group">
      {!! Form::label('title','Title',['class' => 'required']) !!}
      <p>
        {{ $post->title }}
      </p>
    </div>

    <div class="row">
      <div class="col-sm-6">
          <div class="form-group">
            {!! Form::label('author', 'Author', ['class' => 'required']) !!}
            <p>
              {{ $post->user->name }}
            </p>
          </div>  
      </div>
      <div class="col-sm-6">
          <div class="form-group">
            {!! Form::label('categories', 'Categories', ['class' => 'required']) !!}
            <p>
              <?php $categoriesList = ""; ?>
              @foreach ($post->categories as $c)
                  <?php $categoriesList .= $c->category_name . ', '; ?>
              @endforeach

              {{ substr($categoriesList, 0, strlen($categoriesList)-2) }}
            </p>
          </div>
      </div>
    </div>

    <div class="form-group">
      {!! Form::label('Content') !!}
      <p>
        {!! $post->content !!}
      </p>
    </div>

    <div class="row">
      <div class="col-sm-6">
        <div class="form-group">
          {!! Form::label('Featured Image') !!}
          <p>
            <img src="{{ url('/images/post/' . $post->featured_image) }}" style="width:100%">
          </p>
        </div>
      </div>
    </div>

  </div><!-- /.box-body -->

  <div class="box-footer">
    <a href="{{ route('am-admin.post.edit', $post->id) }}" class="btn btn-primary">Edit Post</a>
  </div>
</div><!-- /.box -->
@stop