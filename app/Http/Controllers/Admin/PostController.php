<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

// devo importare il mio request 
use App\Http\Requests\PostRequest;

use Illuminate\Http\Request;

// devo importare il model se voglio poi creare le query
use App\Post;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // creo la query e cio che ottengo lo salvo nella variabile $posts che è un array
        $posts = Post::orderBy('id', 'desc')->paginate(5);
        return view('admin.posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostRequest $request)
    {
        // mi serve per vedere quelle che sono le richieste inviate dal form
        // dd($request->all());

        // salvo in una variabile ----- $data è un array
        $data = $request->all();

        $new_post = new Post();

        // adesso l'attributo title sarà uguale a cio che ho inviato con request che a sua volta ho salvato nell' array associativo $data
        $new_post->title = $data['title'];
        $new_post->content = $data['content'];
        $new_post->slug = Post::generateSlug($new_post->title);
        $new_post->save();

        return redirect()->route('admin.posts.show', $new_post);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = Post::find($id);

        // se esiste $post allora mi restituisce la view altrimenti un 404
        if ($post) {
            return view('admin.posts.show', compact('post'));
        }
        abort(404, 'Errore nella ricerca del post');
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = Post::find($id);

        if ($post) {
            return view('admin.posts.edit', compact('post'));
        }
        abort(404, 'Post non presente nel database');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PostRequest $request, Post $post)
    {
        $form_data = $request->all();


        $post->title = $form_data['title'];
        $post->content = $form_data['content'];

        if ($form_data['title'] != $post->title) {
            $form_data['slug'] = Post::generateSlug($form_data['title']);
        }

        $post->save();

        return redirect()->route('admin.posts.show', $post);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        $post->delete();

        return redirect()->route('admin.posts.index')->with('deleted', "Il post $post->title è stato eliminato");
    }
}
