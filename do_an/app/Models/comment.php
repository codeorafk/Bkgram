<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class comment extends Model
{
    use HasFactory;
    protected $table = 'comments';
    
    protected $primarykey = 'id';

    protected $fillable = ['comment','user_id','post_id'];

}
