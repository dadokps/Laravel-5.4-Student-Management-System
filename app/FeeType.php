<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FeeType extends Model
{
    protected $table = 'feetypes';
    protected $fillable = ['fee_type'];
    protected $primaryKey = 'fee_type_id';
    public $timestamps = false;
}
