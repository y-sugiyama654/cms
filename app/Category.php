<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    /**
     * カテゴリーの投稿を取得
     *
     * @return void
     */
    public function posts()
    {
        return $this->hasMany(Post::class);
    }
}
