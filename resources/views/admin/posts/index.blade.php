@extends('layouts.admin')

@section('content')
<div class="container">

    @if ( session( 'popUp' ) )    
        <div class="alert alert-success" role="alert">
            {{ session( 'popUp' ) }}
        </div>
    @endif

    <h1>Rotta INDEX della CRUD </h1>
    
    <a class="btn btn-outline-dark  mb-4 mt-3" href="{{ route('admin.posts.create') }}">Crea nuovo post</a>

    <table class="table table-hover">
        <thead>
          <tr>
            <th scope="col">#ID</th>
            <th scope="col">Titolo</th>
            <th scope="col">Categoria</th>
            <th scope="col">Tags</th>
            <th scope="col">Azioni</th>
          </tr>
        </thead>
        <tbody>

            @foreach ($posts as $item)
                <tr>
                    {{-- ID --}}
                    <th scope="row">{{ $item->id}}</th>

                    {{-- NOME --}}
                    <td>{{ $item->title}}</td>

                    {{-- CATEGORIA --}}
                    {{-- ternario, controllo della relazione--}}
                    <td>{{ $item->category ? $item->category->name : 'NULL' }}</td>
                    {{-- <td>{{ !empty($item->category) ? $item->category->name : 'NULL' }}</td> --}}

                    {{-- TAGS --}}
                    <td>
                        @forelse ($item->tags as $tag)
                            <span class="badge badge-dark">{{ $tag->name }}</span>
                        @empty
                            NO-TAG
                        @endforelse
                    </td>

                    {{-- bottoni --}}
                    <td>
                        <a class="btn btn-info" href="{{ route('admin.posts.show', $item) }}">SHOW</a>
                        <a class="btn btn-warning" href="{{ route('admin.posts.edit', $item) }}">EDIT</a>
                        <form class=" d-inline" 
                            action="{{ route('admin.posts.destroy', $item) }}"
                            method="POST"
                            onsubmit="return confirm('Confermi l\eliminazione di: {{ $item->title }}')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">DESTROY</button>
                        </form>
                    </td>
                    {{-- /bottoni --}}

                </tr>
            @endforeach

        </tbody>
    </table>

    {{ $posts->links() }}


    <div class="elenco-posts">
        <h2 class="mt-5">Elenco POST divisi per categorie</h2>
        <div class="row row-cols-6 my-3">

            @foreach ($categories as $category)
                <div class="col my-2">
                    <h3 class="py-3">{{ $category->name }}</h3>
                    <ul>

                        @foreach ($category->posts as $post)
                            <li><a href="{{ route('admin.posts.show', $post) }}">{{ $post->title }}</a></li>
                        @endforeach

                        @forelse ($category->posts as $post)
                            <li><a href="{{ route('admin.posts.show', $post) }}">{{ $post->title }}</a></li>
                        @empty
                            <li>Non ci sono posto per questa categoria</li>
                        @endforelse

                    </ul>
                </div>
            @endforeach
        </div>
    </div>
      
</div>
@endsection
