@extends('layouts.master')

@section('content')

<div class="box box-primary">
<div class="box-header with-border">
  <h3 class="box-title">{{ $page->title }} - Details</h3>
</div><!-- /.box-header -->
<!-- form start -->
  <div class="box-body">
    <div class="form-group">
      {!! Form::label('title','Title',['class' => 'required']) !!}
      <p>
        {{ $page->title }}
      </p>
    </div>

    <div class="row">
      <div class="col-sm-6">
          <div class="form-group">
            {!! Form::label('author', 'Author', ['class' => 'required']) !!}
            <p>
              {{ $page->user->name }}
            </p>
          </div>  
      </div>
      <div class="col-sm-6">
          <div class="form-group">
            {!! Form::label('parent_id', 'Parent Page', ['class' => 'required']) !!}
            <p>
              {{ ($page->parent['title'] != null)? $page->parent['title'] : '-' }}
            </p>
          </div>
      </div>
    </div>

    <div class="form-group">
      {!! Form::label('Content') !!}
      <p>
        {!! $page->content !!}
      </p>
    </div>

    <div class="row">
      <div class="col-sm-6">
        <div class="form-group">
          {!! Form::label('Featured Image') !!}
          <p>
            <img src="{{ url('/images/page/' . $page->featured_image) }}" style="width:100%">
          </p>
        </div>
      </div>
    </div>

  </div><!-- /.box-body -->

  <div class="box-footer">
    <a href="{{ route('am-admin.page.edit', $page->id) }}" class="btn btn-primary">Edit Page</a>
  </div>
</div><!-- /.box -->
@stop