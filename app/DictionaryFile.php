<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DictionaryFile extends Model
{
    public $timestamps = false;

    public function file()
    {
        return $this->morphOne('App\File', 'fileable');
    }

    public function rows()
    {
        return $this->hasMany('App\DictionaryFileContent');
    }
}
