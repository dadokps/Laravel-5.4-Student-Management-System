<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Level extends Model
{
    protected $table = 'levels';
    protected $fillable = ['level', 'description', 'program_id'];
    protected $primaryKey = 'level_id';
    public $timestamps = false;
}
