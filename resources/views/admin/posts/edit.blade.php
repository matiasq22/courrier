@extends('admin.layout' )
@section('header')
    <h1>
        Posts
        <small>Crear Post</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{route('admin.home')}}"><i class="glyphicon glyphicon-home"></i> Inicio</a></li>
        <li><a href="{{route('admin.posts.index')}}"><i class="glyphicon glyphicon-pencil"></i> Posts</a></li>
        <li class="active">Editar</li>
    </ol>

@stop
@section('content')
    <form action="{{route('admin.posts.update',['post' => $post])}}" method="POST">
        @csrf {{method_field('PUT')}}
        <div class="row">
            <div class="col-md-8">
                <div class="box box-primary">
                    <div class="box-body">
                        <div class="form-group  {{$errors->has('title') ? 'has-error' : ''}}">
                            <label for="title">Titulo de la Publicacion</label>
                            <input class="form-control" type="text"
                                   name="title" placeholder="Ingresa aqui el titulo de la publicacion"
                                    value="{{old('title', $post->title)}}"/>
                            {!! $errors->first('title','<span class="help-block">:message</span>') !!}
                        </div>
                        <div class="form-group {{$errors->has('body') ? 'has-error' : ''}}">
                            <label for="body">Contenido de la publicacion</label>
                            <textarea class="form-control" id="editor" placeholder="Ingresa el contenido de la publicacion"
                                      name="body"  rows="10">{{ old('body',$post->body) }}</textarea>
                            {!! $errors->first('body','<span class="help-block">:message</span>') !!}
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="box box-primary">
                    <div class="box-body">
                        <div class="form-group {{$errors->has('published_at') ? 'has-error' : ''}}">
                            <label>Fecha de publicacion:</label>
                            <div class="input-group date">
                                <div class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                </div>
                                <input type="text" value="{{old('published_at',$post->published_at ? $post->published_at->format('m/d/Y') : null)}}" name="published_at" class="form-control pull-right" id="datepicker">
                                {!! $errors->first('published_at','<span class="help-block">:message</span>') !!}
                            </div>
                            <!-- /.input group -->
                        </div>
                        <label>Categorias</label>
                        <div class="form-group {{$errors->has('category_id') ? 'has-error' : ''}}">
                            <select name="category_id" class="form-control">
                                <option>Seleccione una categoria</option>
                                @forelse($categories as $category)
                                    <option  value="{{$category->id}}"
                                             {{old('category_id',$post->category_id) == $category->id ? 'selected' : ''}}
                                    >{{$category->name}}</option>
                                @empty
                                    <option value="">Sin categorias</option>
                                @endforelse
                            </select>
                            {!! $errors->first('category_id','<span class="help-block">:message</span>') !!}
                        </div>
                        <label>Etiquetas</label>
                        <div class="form-group {{$errors->has('tags') ? 'has-error' : ''}}">
                            <select name="tags[]" class="form-control select2"
                                    multiple="multiple"
                                    data-placeholder="seleccione etiquetas" style="width: 100%;" tabindex="-1" aria-hidden="true">
                                @forelse($tags as $tag)
                                    <option {{collect(old('tags', $post->tags->pluck('id')))->contains($tag->id) ? 'selected' : ''}}
                                            value="{{$tag->id}}">{{$tag->name}}</option>
                                @empty
                                    Sin etiquetas
                                @endforelse
                            </select>
                            {!! $errors->first('tags','<span class="help-block">:message</span>') !!}
                        </div>
                        <div class="form-group {{$errors->has('excerpt') ? 'has-error' : ''}}">
                            <label for="excerpt">Extracto de la publicacion</label>
                            <textarea class="form-control" placeholder="Ingresa aqui el extracto de la publicacion"
                                      name="excerpt">{{old('excerpt',$post->excerpt)}}</textarea>
                            {!! $errors->first('excerpt','<span class="help-block">:message</span>') !!}
                        </div>
                        <div class="form-group">
                            <div class="dropzone">

                            </div>
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
    <link rel="stylesheet" href="{{asset('plugins/dropzone/dropzone.css')}}">
    <link href="{{asset('plugins/select2/select2.min.css')}}" rel="stylesheet" />
    <link rel="stylesheet" href="/adminlte/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
@endpush

@push('scripts')
    <script src="{{asset('plugins/dropzone/dropzone.min.js')}}"></script>
    <script src="{{asset('plugins/select2/select2.min.js')}}"></script>
    <script src="https://cdn.ckeditor.com/4.12.1/standard/ckeditor.js"></script>
    <script src="/adminlte/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
    <script>
        //Date picker
        $('#datepicker').datepicker({
            autoclose: true
        });

        CKEDITOR.replace('editor');

        $('.select2').select2();

        var myDropzone = new Dropzone('.dropzone',{
            url: '/admin/posts/{{$post->url}}/photos',
            // acceptedFiles: 'image/*',
            // maxFilesize: 2,
            paramName: 'photo',
            headers: {
                'X-CSRF-TOKEN': '{{csrf_token()}}',
            },
            dictDefaultMessage: 'Arrastra las fotos aqui para subirlas'
        });

        Dropzone.autoDiscover = false;

        myDropzone.on('error', (file, res)=>{
            console.log(res);
            var msg = res.photo[0];

            $('.dz-error-message:last > span').text(msg);
        });
    </script>
@endpush