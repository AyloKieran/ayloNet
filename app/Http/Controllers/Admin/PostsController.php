<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Posts;

class PostsController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:admin');
    }

    public function index() {
        $search = request()->input('search');

        $posts = Posts::where('title', 'like', '%' . $search . '%')
            ->orWhere('excerpt', 'like', '%' . $search . '%')
            ->orWhere('tags', 'like', '%' . $search . '%')
            ->orderByDesc('created_at')
            ->paginate(25)
            ->withQueryString();

        return view('admin.posts.index')->with('posts', $posts);
    }

    public function create()
    {
        return view('admin.posts.create');
    }

    public function store()
    {
        $attributes = request()->validate([
            'title' => ['required', 'min:5'],
            'route' => ['required', 'unique:posts,route'],
            'excerpt' => ['min:10'],
            'tags' => ['nullable'],
            'content' => ['required'],
        ]);
        $attributes['user_id'] = request()->user()->id;

        $post = Posts::create($attributes);
        $post->save();
        return redirect($post->route);
    }

    public function edit(Posts $post)
    {
        return view('admin.posts.edit')->with('post', $post);
    }

    public function update(Posts $post)
    {
        $attributes = request()->validate([
            'title' => ['required', 'min:5'],
            'excerpt' => ['min:10'],
            'content' => ['required'],
        ]);

        $post->title = request()->get('title');
        $post->excerpt = request()->get('excerpt');
        $post->tags = request()->get('tags');
        $post->content = request()->get('content');

        $post->save();

        return redirect($post->route);
    }

    public function destroy(Posts $post)
    {
        $post->delete();

        return redirect(route('admin.posts'));
    }
}
