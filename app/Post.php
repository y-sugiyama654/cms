<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;

class Post extends Model
{
    use SoftDeletes;

    protected $dates = [
        'published_at'
    ];

    protected $fillable = [
        'title', 'description', 'content', 'image', 'published_at', 'category_id', 'user_id',
    ];

    /**
     * ストレージから投稿画像の削除
     *
     * return void
     */
    public function deleteImage()
    {
        Storage::delete($this->image);
    }

    /**
     * 投稿に紐づくカテゴリーを取得
     *
     * @return void
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * 投稿に紐づくタグを取得
     *
     * @return void
     */
    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }

    /**
     * 投稿に紐づくタグが含まれているか確認
     *
     * @param int $tagId タグID
     * @return bool
     */
    public function hasTag($tagId)
    {
        return in_array($tagId, $this->tags->pluck('id')->toArray());
    }

    /**
     * 投稿に紐づくユーザーを取得
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * 現在の日時と比較して過去の投稿を返す
     *
     * @param $query
     * @return mixed
     */
    public function scopePublished($query)
    {
        return $query->where('published_at', '<=', now());
    }

    /**
     * 検索条件が含まれている場合に検索結果を返す
     *
     * @param $query
     * @return mixed
     */
    public function scopeSearched($query)
    {
        $search = request()->query('search');

        if (!$search) {
            return $query->published();
        }

        return $query->published()->where('title', 'LIKE', "%{$search}%");
    }
}
