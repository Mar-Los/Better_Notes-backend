<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    protected $fillable = ['folder_id', 'name'];

    protected $with = ['fileable'];

    public function fileable()
    {
        return $this->morphTo('fileable');
    }

    public function delete()
    {
        $this->fileable()->delete();
        $result = parent::delete();
        return $result;
    }
}
