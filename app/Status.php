<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    protected $table = 'statuses';
    protected $fillable = ['status_id', 'class_id'];
    protected $primaryKey = 'status_id';
    public $timestamps = false;
}
