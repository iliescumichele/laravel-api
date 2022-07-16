<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\PostRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Post;
use App\Category;
use App\Tag;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::orderBy('id', 'desc')->paginate(10);
        $categories = Category::all();
        return view( 'admin.posts.index', compact('posts', 'categories') );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        $tags = Tag::all();
        return view('admin.posts.create', compact('categories', 'tags') );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostRequest $request)
    {
        //dd($request->all);
        $data = $request->all();
        $new_post = new Post();
        $data['slug'] = Post::generateSlug($data['title']);
        $new_post->fill($data);
        $new_post->save();

        //verifica l'esistenza dell'array tags dentro $data
        if(array_key_exists('tags', $data) ){
            $new_post->tags()->attach($data['tags']);
        }

        return redirect() ->route('admin.posts.show', $new_post);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $item = Post::find($id);
        if($item){
            return view('admin.posts.show', compact('item'));
        }
        abort(404, 'Prodotto non presente');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(POST $post)
    {
        
        $categories = Category::all();
        $tags = Tag::all();
        if($post){
            return view('admin.posts.edit', compact('post', 'categories', 'tags'));
        }
        abort(404, 'Prodotto non presente');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post, Tag $tags)
    {
        //$post = Post::find($id);
        $data = $request -> all();

        if( $post->title != $data['title'] ){
            $data['slug'] = $this->generateSlug($data['title']);
        } else {
            $data['title'] = $post->slug;
        }
        
        $post -> update($data);

        if( array_key_exists('tags', $data) ){
            $post->tags()->sync( $data['tags'] );
        } else {
            $post->tags()->detach();
        }

        return redirect() -> route('admin.posts.show', $post);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        $post -> delete();

        return redirect() -> route('admin.posts.index') -> with('popUp', "Item eliminato correttamente");
    }


    private function generateSlug($string){
        $slug = Str::slug( $string , '-' );
        $control_slug = Post::where('slug', $slug) -> first();

        if($control_slug){
            $slug = $control_slug -> slug . '-';
        };

        return $slug;
    }
}
