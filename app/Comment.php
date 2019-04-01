<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $table="comments";
    public $timestamps = false;
    protected $fillable=[
        "is_active",
        "post_id",
        "author",
        "photo",
        "email",
        "body"
    ];
    public function replies()
    {
        return $this->hasMany("App\CommentReply");
    }
    public function post()
    {
        return $this->belongsTo("App\Post","post_id");
    }


}
