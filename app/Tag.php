<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    protected $fillable = ['name'];

    /**
     * タグに紐づく投稿を取得
     *
     * @return void
     */
    public function posts()
    {
        return $this->belongsToMany(Post::class);
    }
}
