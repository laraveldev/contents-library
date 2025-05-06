<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Content extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'description', 'url', 'category_id'];

    protected $with = ['category', 'authors', 'generes'];


    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    // public function authors()
    // {
    //     return $this->belongsToMany(
    //         Author::class,
    //         'author_content',
    //         'content_id',
    //         'author_id'
    //     );
    // }

    // public function generes()
    // {
    //     return $this->belongsToMany(Genere::class);
    // }
    public function authors()
{
    return $this->belongsToMany(Author::class, 'author_content');
}

public function generes()
{
    return $this->belongsToMany(Genere::class, 'content_genere');
}
public function incrementLike()
{
    $this->increment('like_count');
}

public function incrementDislike()
{
    $this->increment('dislike_count');
}

}
