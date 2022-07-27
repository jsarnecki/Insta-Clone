<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $guarded = []; // Saying to not guard anything regarding validation in the PostController, as it's already done manually there

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
