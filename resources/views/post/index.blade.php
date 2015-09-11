@extends('layouts.master')

@section('content')
{{-- <p>
	<a href="{{ route('am-admin.post.create') }}" class="btn btn-danger">Add New</a>
</p> --}}

@if(Session::has('flash_message'))
  <div class="callout callout-success">
     <p>
        <i class="fa fa-check"></i> {!! Session::get('flash_message') !!} 
     </p>
  </div>
@endif

              <div class="box box-primary">
                {{-- <div class="box-header"></div><!-- /.box-header --> --}}
                <div class="box-body">
                  <table id="example1" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th>Title</th>
                        <th>Author</th>
                        <th>Created At</th>
                        <th>Actions</th>
                      </tr>
                    </thead>
                    <tbody>
                    @foreach($posts as $post)
                      <tr>
                        <td>{{ $post->title }}</td>
                        <td>{{ $post->user->name }}</td>
                        <td>{{ $post->created_at }}</td>
                        <td width="150">
                          <a href="{{ route('am-admin.post.edit', $post->id) }}" class="btn btn-warning btn-xs">Edit</a>
                          <a href="{{ route('am-admin.post.show', $post->id) }}" class="btn btn-primary btn-xs">Detail</a>
                          {!! Form::open(['method' => 'DELETE', 'route' => ['am-admin.post.destroy', $post->id], 'style' => 'display:inline']) !!}
                            {!! Form::submit('Delete', ['class' => 'btn btn-danger btn-xs']) !!}
                          {!! Form::close() !!}
                        </td>
                      </tr>
                    @endforeach
                    </tbody>
                    <tfoot>
                      <tr>
                        <th>Title</th>
                        <th>Author</th>
                        <th>Created At</th>
                        <th>Actions</th>
                      </tr>
                    </tfoot>
                  </table>
                </div><!-- /.box-body -->
              </div><!-- /.box -->
@stop