<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class post extends Model
{
    use HasFactory;

    protected $table = 'posts';
    
    protected $primarykey = 'id';

    protected $fillable = ['username', 'n_likes', 'description', 'image_path'];
}
