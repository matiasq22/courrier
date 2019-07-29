 @extends('admin.layout')

@section('header')

    <h1>
        Todas las publicaciones
        <small>Optional description</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Inicio</a></li>
        <li class="active">Posts</li>
    </ol>

@stop

@section('content')
          <div class="box box-primary">
            <div class="box-header">
              <h3 class="box-title">Listado de posts</h3>
                <button class="btn btn-primary pull-right"
                        id="create_post" data-toggle="modal"
                        data-target="#create_post"><i class="fa fa-plus">Crear Publicacion</i></button>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="posts-table" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Id</th>
                  <th>Titulo</th>
                  <th>Acciones</th>
                </tr>
                </thead>
                <tbody>
                  @forelse($posts as $post)
                  <tr>
                  <td>{{ $post->id }}</td>
                  <td>{{ $post->title }}</td>
                  <td>
                      <a href=""><i class="glyphicon glyphicon-plus"></i></a>
                      <a href="{{route('admin.posts.edit', ['post' => $post])}}"><i class="glyphicon glyphicon-pencil"></i></a>
                      <a href="{{route('admin.posts.destroy', ['post'=>$post])}}"><i class="glyphicon glyphicon-remove"></i></a>
                  </td>
                  </tr>
                  @empty
                  Lista Vacia
                  @endforelse
                </tbody>
              </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
@stop


 @include('admin.dialogs._create_post')

@push('styles')
    <link rel="stylesheet" href="/adminlte/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
@endpush

@push('scripts')
    <script src="/adminlte/bower_components/datatables.net/js/jquery.dataTables.min.js" defer ></script>
    <script src="/adminlte/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js" defer ></script>
    <script>
        $(document).ready(function(){
            $('#posts-table').DataTable()
        });
    </script>
    <script>

    </script>
@endpush