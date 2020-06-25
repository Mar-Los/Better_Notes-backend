<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DictionaryFileContent extends Model
{
    public $timestamps = false;
    protected $fillable = ['dictionary_file_id', 'column_key', 'column_value'];
}
