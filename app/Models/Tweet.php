<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tweet extends Model
{
    // $table->integer('user_id')->nullable();
    // $table->text('tweet')->nullable();

    use HasFactory;
    protected $fillable = ['user_id','tweet'];
}
