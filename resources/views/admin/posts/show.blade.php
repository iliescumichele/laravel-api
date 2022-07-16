@extends('layouts.admin')

@section('content')

<div class="container ">
    <h1 class="">Rotta SHOW della CRUD </h1>

    {{-- Link per tornare alla index --}}
    <a href="{{ route('admin.posts.index') }}">&#60&#60 Go back</a>

    {{-- Bottone EDIT --}}
        <div class="div">
            <a class="btn btn-warning mt-3 mb-5" href="{{ route('admin.posts.edit', $item) }}">EDIT</a>
        </div>
    {{-- Bottone EDIT --}}


    {{-- Stampa CATEGORIA --}}
        <div>
            @if ( $item->category)

                <div class="category-title">
                    <h3>Categoria: <strong>{{ $item->category->name}}</strong></h3>
                </div>

                @else

                <div class="category-title">
                    <h3>Categoria: <strong>nessuna</strong></h3>
                </div>

            @endif
        </div>
    {{-- /Stampa CATEGORIA --}}


    {{-- Stampa TAGS --}}
        <div class="">
            @if ($item->tags)
                <h3 class="d-inline">Tags: </h3>

                @foreach ($item->tags as $tag)    
                    <span class="badge badge-dark">{{ $tag->name }}</span>
                @endforeach

            @endif
        </div>
    {{-- /Stampa TAGS --}}


    {{-- Stampa contenuto del ID selezionato (titolo e content) --}}
        <div class="d-flex justify-content-center my-5">
            <div class="text-center p-3" style="background-color: rgb(170, 214, 252); width:60%;">
                <h3 class="mb-5" style="text-decoration: underline">{{ $item->title}}</h3>
                <p>{{ $item->content }}</p>
            </div>
        </div>
    {{-- /Stampa contenuto del ID selezionato (titolo e content) --}}

    

    {{-- Bottone SUBMIT + gestione errori --}}
        <form class=" d-inline d-flex justify-content-center" 
                action="{{ route('admin.posts.destroy', $item) }}"
                method="POST"
                onsubmit="return confirm('Confermi l\eliminazione di: {{ $item->title }}')"
            >

            @csrf
            @method('DELETE')

            <button type="submit" class="btn btn-danger">DESTROY</button>

        </form>
    {{-- Bottone SUBMIT + gestione errori --}}
</div>
@endsection
