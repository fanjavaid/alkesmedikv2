@extends('layouts.master')

@section('content')
{{-- <p>
	<a href="{{ route('post.create') }}" class="btn btn-danger">Add New</a>
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
                        <th>Preview</th>
                        <th>File</th>
                        <th>Created At</th>
                        <th>Actions</th>
                      </tr>
                    </thead>
                    <tbody>
                    @foreach($medias as $media)
                      <tr>
                        <td width="85px"><img src="{{ url($media->url) }}" style="width:80px" /></td>
                        <td>
                          {{ $media->title }} <br/>
                          <strong style="color:#3c8dbc">{{ strtoupper(pathinfo($media->path, PATHINFO_EXTENSION)) }}</strong>
                        </td>
                        <td>{{ $media->created_at }}</td>
                        <td width="150">
                          <a href="{{ route('am-admin.media.edit', $media->id) }}" class="btn btn-warning btn-xs">Edit</a>
                          <a href="{{ route('am-admin.media.show', $media->id) }}" class="btn btn-primary btn-xs">Detail</a>
                          {!! Form::open(['method' => 'DELETE', 'route' => ['am-admin.media.destroy', $media->id], 'style' => 'display:inline']) !!}
                            {!! Form::submit('Delete', ['class' => 'btn btn-danger btn-xs']) !!}
                          {!! Form::close() !!}
                        </td>
                      </tr>
                    @endforeach
                    </tbody>
                    <tfoot>
                      <tr>
                        <th>Preview</th>
                        <th>File</th>
                        <th>Created At</th>
                        <th>Actions</th>
                      </tr>
                    </tfoot>
                  </table>
                </div><!-- /.box-body -->
              </div><!-- /.box -->
@stop