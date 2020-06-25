<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Kalnoy\Nestedset\NodeTrait;

class Folder extends Model
{
    use NodeTrait;

    protected $fillable = ['name'];

    public function files()
    {
        return $this->hasMany('App\File');
    }

    public function delete()
    {
        foreach ($this->files as $file) {
            $file->fileable()->delete();
        }

        $result = parent::delete();
        return $result;
    }
}
