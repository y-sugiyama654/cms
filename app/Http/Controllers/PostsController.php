<?php

namespace App\Http\Controllers;

use App\Http\Requests\Posts\CreatePostsRequest;
use App\Http\Requests\Posts\UpdatePostRequest;
use App\Post;
use App\Category;
use App\Tag;
use Illuminate\Http\Request;

class PostsController extends Controller
{
    public function __construct()
    {
        $this->middleware('verifyCategoriesCount')->only(['create', 'store']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('posts.index')->with('posts', Post::all());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('posts.create')->with('categories', Category::all())->with('tags', Tag::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreatePostsRequest $request)
    {
        // ストレージに画像を保存
        $image = $request->image->store('posts');

        $content = $request['content'];

        // postをDBに保存
        $post = Post::create([
            'title' => $request->title,
            'description' => $request->description,
            'content' => $content,
            'image' => $image,
            'published_at' => $request->published_at,
            'category_id' => $request->category,
        ]);

        if ($request->tags) {
            $post->tags()->attach($request->tags);
        }

        session()->flash('success', 'Post created successfully');

        return redirect(route('posts.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * 投稿の編集ページの表示
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        return view('posts.create')->with('post', $post)->with('categories', Category::all())->with('tags', Tag::all());
    }

    /**
     * 投稿の編集
     *
     * @param UpdatePostRequest $request
     * @param Post $post
     * @return void
     */
    public function update(UpdatePostRequest $request, Post $post)
    {
        $data = $request->only(['title', 'description', 'published_at', 'content', 'category']);

        // 画像が更新されているか確認
        if ($request->hasFile('image')) {
            // ストレージに画像を保存
            $image = $request->image->store('posts');

            $post->deleteImage();

            $data['image'] = $image;
        }

        if ($request->tags) {
            $post->tags()->sync($request->tags);
        }

        $post->category_id = $data['category'];

        $post->update($data);

        session()->flash('success', 'Post Updated Successfully.');

        return redirect(route('posts.index'));
    }

    /**
     * 投稿の削除
     *
     * @param int $id 投稿記事ID
     * @return void
     */
    public function destroy($id)
    {
        // forceDelete時にモデルバインディングが使用できないので、DBからidに該当する投稿を取得する
        $post = Post::withTrashed()->where('id', $id)->firstOrFail();

        if ($post->trashed())
        {
            $post->deleteImage();

            $post->forceDelete();
        } else {
            $post->delete();
        }

        session()->flash('success', 'Post deleted successfully');

        return redirect(route('posts.index'));
    }

    /**
     * 削除した投稿の一覧
     *
     * @return void
     */
    public function trashed()
    {
        $trashed = Post::onlyTrashed()->get();

        return view('posts.index')->with('posts', $trashed);
    }

    /**
     * 削除した投稿の復元
     *
     * @param int $id 投稿記事ID
     * @return void
     */
    public function restore($id)
    {
        // restore時にモデルバインディングが使用できないので、DBからidに該当する投稿を取得する
        $post = Post::withTrashed()->where('id', $id)->firstOrFail();
        $post->restore();

        session()->flash('success', 'Post restored successfully');

        return redirect()->back();
    }
}

