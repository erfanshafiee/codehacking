<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Catagory extends Model
{
    protected $fillable=["name"];
    protected $table="categories";
    public $timestamps = false;
}
