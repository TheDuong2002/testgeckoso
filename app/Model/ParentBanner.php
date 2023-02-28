<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class ParentBanner extends Model
{
    protected $table = 'parent_banner';
    protected $fillable = [
        'date_add',
        'rs_off',
        'status',
    ];
    public $timestamps = false;
}
