@extends('layouts.master')

@section('content')
{{-- <p>
	<a href="{{ route('category.create') }}" class="btn btn-danger">Add New</a>
</p>
 --}}
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
                        <th>Category Name</th>
                        <th>Description</th>
                        <th>Created At</th>
                        <th>Actions</th>
                      </tr>
                    </thead>
                    <tbody>
                    @foreach($categories as $category)
                      <tr>
                        <td>{{ $category->category_name }}</td>
                        <td>{{ $category->description }}</td>
                        <td>{{ $category->created_at }}</td>
                        <td width="100">
                          <a href="{{ route('am-admin.category.edit', $category->id) }}" class="btn btn-warning btn-xs">Edit</a>
                          {!! Form::open(['method' => 'DELETE', 'route' => ['am-admin.category.destroy', $category->id], 'style' => 'display:inline']) !!}
                            {!! Form::submit('Delete', ['class' => 'btn btn-danger btn-xs']) !!}
                          {!! Form::close() !!}
                        </td>
                      </tr>
                    @endforeach
                    </tbody>
                    <tfoot>
                      <tr>
                        <th>Category Name</th>
                        <th>Description</th>
                        <th>Created At</th>
                        <th>Actions</th>
                      </tr>
                    </tfoot>
                  </table>
                </div><!-- /.box-body -->
              </div><!-- /.box -->
@stop