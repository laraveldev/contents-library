<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Genere extends Model
{
    use HasFactory;
    protected $fillable=['name'];
    
    // app/Models/Genere.php

public function contents()
{
    return $this->belongsToMany(Content::class, 'content_genere');
}


    
}
