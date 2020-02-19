<?php

namespace App\Http\Controllers;

use App\Http\Requests\Tags\CreateTagRequest;
use App\Http\Requests\Tags\UpdateTagsRequest;
use App\Tag;
use Illuminate\Http\Request;

class TagsController extends Controller
{
    /**
     * タグの一覧表示
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return view('tags.index')->with('tags', Tag::all());
    }

    /**
     * タグ作成ページの表示
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('tags.create');
    }

    /**
     * タグの保存
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(CreateTagRequest $request)
    {
        $this->validate(request(), [
            'name' => 'required'
        ]);

        $tag = new Tag();

        $tag->name = $request['name'];

        $tag->save();

        return redirect('/tags');
    }

    /**
     * タグ編集ページの表示
     *
     * @param  Tag $tag
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(Tag $tag)
    {
        return view('tag.edit')->with('tag', $tag);
    }

    /**
     * タグの編集
     *
     * @param Tag $tag
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     * @throws \Illuminate\Validation\ValidationException
     */
    public function update(UpdateTagsRequestTag $tag)
    {
        $this->validate(request(), [
            'name' => 'required'
        ]);

        $data = request()->all();

        $tag->name = $data['name'];

        $tag->save();

        return redirect('/tags');
    }

    /**
     * タグの削除
     *
     * @param Tag $tag
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy(Tag $tag)
    {
        if ($tag->posts->count() > 0) {

            session()->flash('error', 'Tag can not be deleted, because it is associated to some posts.');

            return redirect()->back();
        }

        $tag->delete();

        session()->flash('success', 'Tag deleted Successfully');

        return redirect(route('tags.index'));
    }
}
