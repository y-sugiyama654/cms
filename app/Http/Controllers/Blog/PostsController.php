<?php

namespace App\Http\Controllers\Blog;

use App\Category;
use App\Http\Controllers\Controller;
use App\Post;
use App\Tag;
use Illuminate\Http\Request;

class PostsController extends Controller
{
    /**
     * 記事詳細ページの表示
     *
     * @param Post $post
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(Post $post)
    {
        return view('blog.show')->with('post', $post);
    }

    /**
     * 選択されたカテゴリーの表示
     *
     * @param Category $category
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function category(Category $category)
    {
        $search = request()->query('search');

        if ($search) {
            $posts = $category->posts()->where('title', 'LIKE', "%{$search}%")->simplePaginate(1);
        } else {
          $posts = $category->posts()->simplePaginate(1);
        }

        return view('blog.category')
            ->with('category', $category)
            ->with('posts', $posts)
            ->with('categories', Category::all())
            ->with('tags', Tag::all());
    }

    /**
     * 選択されたタグの表示
     *
     * @param Tag $tag
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function tag(Tag $tag)
    {
        return view('blog.tag')
            ->with('tag', $tag)
            ->with('categories', Category::all())
            ->with('tags', Tag::all())
            ->with('posts', $tag->posts()->simplePaginate(1));
    }
}
