<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;

class CategoriesController extends Controller
{
    /**
     * カテゴリーの一覧表示
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return view('categories.index')->with('categories', Category::all());
    }

    /**
     * カテゴリー作成ページの表示
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('categories.create');
    }

    /**
     * カテゴリーの保存
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $this->validate(request(), [
           'name' => 'required'
        ]);

        $category = new Category();

        $category->name = $request['name'];

        $category->save();

        return redirect('/categories');
    }

    /**
     * カテゴリー編集ページの表示
     *
     * @param  Category $category
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(Category $category)
    {
        return view('categories.edit')->with('category', $category);
    }

    /**
     * カテゴリーの編集
     *
     * @param Category $category
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     * @throws \Illuminate\Validation\ValidationException
     */
    public function update(Category $category)
    {
        $this->validate(request(), [
            'name' => 'required'
        ]);

        $data = request()->all();

        $category->name = $data['name'];

        $category->save();

        return redirect('/categories');
    }

    /**
     * カテゴリーの削除
     *
     * @param Category $category
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy(Category $category)
    {
        $category->delete();

        return redirect('/categories');
    }
}
