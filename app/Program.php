<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Program extends Model
{
    protected $table = 'programs';
    protected $fillable = ['program', 'description'];
    protected $primaryKey = 'program_id';
    public $timestamps = false;
}
