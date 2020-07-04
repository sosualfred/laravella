<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    //table name
    protected $table = 'posts';

    //Protected primary keys
    public $primaryKey = 'id';

    //Time stamps for records
    public $timestamps = true;

    //
    public function user(){
        return $this->belongsTo('App\User');
    }

}
