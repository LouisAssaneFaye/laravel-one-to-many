<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::paginate(15);
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
    public function store(Request $request)
    {
        $img_path = Storage::put('uploads/posts', $request['image']);
        $data = $request->validate([
            'title'=>['required', 'unique:posts', 'min:3','max:255'],
            'image'=>['file'],
            'content'=>['required', 'min:10'],
        ]);
        $data['image']= $img_path;
        $data['slug'] = Str::of($data['title'])->slug('-');

        $newPost = Post::create($data); 
        return redirect()->route('admin.posts.index');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        return view('admin.posts.show', compact('post'));
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        return view('admin.posts.edit', compact('post'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        $data = $request->validate([
            'title'=>['required', 'min:3','max:255', Rule::unique('posts')->ignore ($posts->id)],
            'image'=>['url:https'],
            'content'=>['required', 'min:10'],
        ]);

       $data['slug'] = Str::of(" $post->id " . $data['title'])->slug('-');
       $post->update($data);
       return redirect()->route('admin.posts.show', compact('post'));
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
        return redirect()->route('admin.posts.index');
    }

    public function deletedIndex(){
        $posts= Post::onlyTrashed()->paginate(10);
        return view('admin.posts.deleted', compact('posts'));

    }

    public function restore($slug){
        $post->Post::onlyTrashed()->findOrFail($slug);
        $post->restore();
        return redirect()->route('admin.posts.show', $post);
        
    }

    public function obliterate($slug){
        $posts= Post::onlyTrashed()->findOrFail($slug);
        Storage::delete($post->image);
        $post->forceDelete();
        return redirect()->route('admin.posts.index');

    }
}
