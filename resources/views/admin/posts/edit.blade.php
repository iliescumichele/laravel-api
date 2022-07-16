@extends('layouts.admin')

@section('content')

<div class="container ">
    <h1 class="">Rotta EDIT della CRUD </h1>
    <a href="{{ route('admin.posts.index') }}">&#60&#60 Go back</a>

    <h2 class="mt-5 mb-3 text-center">Modifica di <strong>{{ $post->title }}</strong></h2>
    <div class="justify-content-center d-flex">

        @if ($errors -> any())
            <div class="alert alert-danger" role="alert">
                <ul>
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif


        <form action="{{ route('admin.posts.update', $post) }}" method="POST" class="my-5 w-75">
            @csrf
            @method('PUT')

            <div class="mb-3">

                <label for="title" class="form-label">
                    <strong>Titolo</strong>
                </label>

                {{-- input title + gestione errori --}}
                <input type="text" id="title" name="title" placeholder="Inserisci il titolo"
                    value="{{ old('title', $post->title) }}"
                    class="form-control @error('title') is-invalid @enderror"
                    >

                @error('title')
                    <p class="text-danger">{{ $message }}</p>
                @enderror
                    <p class="text-danger" id="error-title"></p>
                {{-- /input title + gestione errori --}}

            </div>


            <div class="mb-3">

                <label  class="form-label" for="content">
                    <strong>Testo</strong>
                </label>

                {{-- input content + gestione errori --}}
                <textarea name="content"  id="content" placeholder="Scrivi il contenuto" rows="10"
                    class="form-control @error('content') is-invalid @enderror"
                    >{{ old('content', $post->content) }} 
                </textarea>

                @error('content')
                    <p class="text-danger">{{ $message }}</p>
                @enderror
                {{-- /input content + gestione errori --}}

            </div>

            {{-- Select CATEGORIA --}}
            <div class="mb-3">
                <select class="form-select" name="category_id">
                    <option value="">Seleziona categoria</option>

                    @foreach ($categories as $category)
                    <option value="{{$category->id}}"
                        @if ($category->id == old('category_id', $post->category ? $post->category->id : ''))
                            selected
                        @endif
                        >
                            {{$category->name}}
                        </option>
                    @endforeach

                </select>
            </div>
            {{-- /Select CATEGORIA --}}


            {{-- Checkbox TAGS --}}
            <div class="mb-3">

                @foreach($tags as $tag)    
                    <input type="checkbox" name="tags[]" id="tag{{ $loop->iteration }}" value="{{ $tag->id }}"

                        @if( !$errors->any() && $post->tags->contains($tag->id) )
                            checked
                        @elseif ( $errors->any() && in_array($tag->id, old('tags, []')) )
                            checked
                        @endif
                    >
                    <label class="mr-3" for="tag{{ $loop->iteration }}">
                        {{ $tag->name }}
                    </label>
                @endforeach
            </div>
            {{-- /Checkbox TAGS --}}

            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
        

    </div>
</div>
@endsection
