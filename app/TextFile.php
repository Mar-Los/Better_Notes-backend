<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TextFile extends Model
{
    public $timestamps = false;
    protected $fillable = ['content'];

    public function file()
    {
        return $this->morphOne('App\File', 'fileable');
    }
}
