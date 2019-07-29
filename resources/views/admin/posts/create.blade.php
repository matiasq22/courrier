@extends('admin.layout' )
@section('header')
    <h1>
        Posts
        <small>Crear Post</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{route('admin.home')}}"><i class="glyphicon glyphicon-home"></i> Inicio</a></li>
        <li><a href="{{route('admin.posts.index')}}"><i class="glyphicon glyphicon-pencil"></i> Posts</a></li>
        <li class="active">Crear</li>
    </ol>

@stop
@section('content')
    <form action="{{route('admin.posts.store')}}" method="POST">
        @csrf
        <div class="row">
            <div class="col-md-8">
                <div class="box box-primary">
                    <div class="box-body">
                        <div class="form-group ">
                            <label for="title">Titulo de la Publicacion</label>
                            <input class="form-control {{$errors->has('title') ? 'is-invalid' : ''}}" type="text" name="title" placeholder="Ingresa aqui el titulo de la publicacion" />

                        </div>
                        <div class="form-group">
                            <label for="body">Contenido de la publicacion</label>
                            <textarea class="form-control" id="editor" placeholder="Ingresa el contenido de la publicacion" name="body"  rows="10"></textarea>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="box box-primary">
                    <div class="box-body">
                        <div class="form-group">
                            <label>Fecha de publicacion:</label>
                            <div class="input-group date">
                                <div class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                </div>
                                <input type="text" name="published_at" class="form-control pull-right" id="datepicker">
                            </div>
                            <!-- /.input group -->
                        </div>
                        <label>Categorias</label>
                        <div class="form-group">
                            <select name="category_id" class="form-control">
                                <option>Seleccione una categoria</option>
                                @forelse($categories as $category)
                                    <option  value="{{$category->id}}">{{$category->name}}</option>
                                    @empty
                                    <option value="">Sin categorias</option>
                                @endforelse
                            </select>
                        </div>
                        <label>Etiquetas</label>
                        <div class="form-group">
                            <select name="tags[]" class="form-control select2"
                                    multiple="multiple"
                                    data-placeholder="seleccione etiquetas" style="width: 100%;" tabindex="-1" aria-hidden="true">
                                @forelse($tags as $tag)
                                    <option value="{{$tag->id}}">{{$tag->name}}</option>
                                    @empty
                                    Sin etiquetas
                                @endforelse
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="excerpt">Extracto de la publicacion</label>
                            <textarea class="form-control" placeholder="Ingresa aqui el extracto de la publicacion" name="excerpt"></textarea>
                        </div>
                        <div class="form-group">
                            <input type="submit" class="btn btn-primary btn-block" value="Enviar">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
@stop

@push('styles')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.7/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="/adminlte/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
@endpush

@push('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.7/js/select2.min.js"></script>
    <script src="https://cdn.ckeditor.com/4.11.4/standard/ckeditor.js"></script>
    <script src="/adminlte/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
    <script>
        //Date picker
        $('#datepicker').datepicker({
            autoclose: true
        });

        CKEDITOR.replace('editor');

        $('.select2').select2();
    </script>

@endpush