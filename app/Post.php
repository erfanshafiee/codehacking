<?php

namespace App;

use Cviebrock\EloquentSluggable\Sluggable;
use Cviebrock\EloquentSluggable\SluggableScopeHelpers;
use Cviebrock\EloquentSluggable\SluggableInterface;
use Cviebrock\EloquentSluggable\SluggableTrait;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    //
//    use SluggableTrait;
//    protected $sluggable=[
//        "build_from"=>"title",
//        "save_to"=>"slug",
//        "on_update"=>true,
//    ];
    use Sluggable;
    use SluggableScopeHelpers;

    /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */
    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }

    protected $table="posts";
    public $timestamps = false;
    protected $fillable=["user_id","category_id","photo_id","title","body"];
    public function user()
    {
        return $this->belongsTo("App\User","user_id");
    }
    public function photo()
    {
        return $this->belongsTo("App\Photo","photo_id");
    }
    public function category()
    {
        return $this->hasOne("App\Catagory","id","category_id");
    }
    public function comments()
    {
        return $this->hasMany("App\Comment");
    }

}
