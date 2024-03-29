<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $dates = ['published_at'];

    protected $fillable = ["title","url","excerpt","body","category_id"];

    public function getRouteKeyName()
    {
        return 'url';
    }

    public function category()
    {
    	return $this->BelongsTo(Category::class);
    }
    public function tags()
    {
    	return $this->belongsToMany(Tag::class);
    }

    public function scopePublished($query)
    {
        $query->whereNotNull('published_at')
            ->where('published_at', '<=',Carbon::now())
            ->latest('published_at');
    }
}
