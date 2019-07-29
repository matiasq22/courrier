@extends('layout')

@section('content')
    <section class="posts container">
        @forelse($posts as $post)
        <article class="post no-image">
            <div class="content-post">
                <header class="container-flex space-between">
                    <div class="date">
                        <span class="c-gray-1">{{ $post->published_at->diffForHumans() }}</span>
                    </div>
                    <div class="post-category">
                        <span class="category text-capitalize">{{$post->category->name}}</span>
                    </div>
                </header>
                <h1>{{ $post->title }}</h1>
                <div class="divider"></div>
                <p>{{ $post->execrpt }}</p>

                <footer class="container-flex space-between">
                    <div class="read-more">
                        <a href="{{route('posts.show',['url'=>$post->url])}}" class="text-uppercase c-green">Leer mas</a>
                    </div>
                    <div class="tags container-flex">
                        @forelse($post->tags as $tag)
                        <span class="tag c-gris text-capitalize">#{{ $tag->name }}</span>
                        @empty
                        <span class="tag c-gris text-capitalize">Sin Etiquetas</span>
                        @endforelse
                    </div>
                </footer>
            </div>
        </article>
            @empty
            No Hay Registros Disponibles, Por favor vuelva mas Tarde
        @endforelse

    </section><!-- fin del div.posts.container -->

    <div class="pagination">
        <ul class="list-unstyled container-flex space-center">
            <li><a href="#" class="pagination-active">1</a></li>
            <li><a href="#">2</a></li>
            <li><a href="#">3</a></li>
        </ul>
    </div>

@endsection