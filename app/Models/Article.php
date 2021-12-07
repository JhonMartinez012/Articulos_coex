<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use HasFactory;
    protected $fillable =[
        'serial',
        'title',
        'description',
        'img_article'
    ];
    // Relacion 1 a muchos inversa: con users
    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

     //relacion de 1 a muchos: con la tabla Comments
     public function comments()
     {
         return $this->hasMany('App\Models\Comment');
     }
}
