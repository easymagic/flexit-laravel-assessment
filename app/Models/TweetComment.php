<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TweetComment extends Model
{
    // $table->integer('tweet_id')->nullable();
    // $table->integer('user_id')->nullable();
    // $table->text('comment')->nullable();

    use HasFactory;
    protected $fillable = ['tweet_id','user_id','comment'];

}
