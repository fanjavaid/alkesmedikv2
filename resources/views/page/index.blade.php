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
                        <th>Parent Page</th>
                        <th>Author</th>
                        <th>Created At</th>
                        <th>Actions</th>
                      </tr>
                    </thead>
                    <tbody>
                    @foreach($pages as $page)
                      <tr>
                        <td>{{ $page->title }}</td>
                        <td>{{ ($page->parent['title'] != null)? $page->parent['title'] : '-' }}</td>
                        <td>{{ $page->user->name }}</td>
                        <td>{{ $page->created_at }}</td>
                        <td width="150">
                          <a href="{{ route('am-admin.page.edit', $page->id) }}" class="btn btn-warning btn-xs">Edit</a>
                          <a href="{{ route('am-admin.page.show', $page->id) }}" class="btn btn-primary btn-xs">Detail</a>
                          {!! Form::open(['method' => 'DELETE', 'route' => ['am-admin.page.destroy', $page->id], 'style' => 'display:inline']) !!}
                            {!! Form::submit('Delete', ['class' => 'btn btn-danger btn-xs']) !!}
                          {!! Form::close() !!}
                        </td>
                      </tr>
                    @endforeach
                    </tbody>
                    <tfoot>
                      <tr>
                        <th>Title</th>
                        <th>Parent Page</th>
                        <th>Author</th>
                        <th>Created At</th>
                        <th>Actions</th>
                      </tr>
                    </tfoot>
                  </table>
                </div><!-- /.box-body -->
              </div><!-- /.box -->
@stop