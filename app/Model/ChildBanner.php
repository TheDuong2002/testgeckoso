<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class ChildBanner extends Model
{
    protected $table = 'child_banner';
    protected $fillable = [
        'img_banner_mt',
        'img_banner_dt',
        'link',
        'parent_id',
    ];
    public $timestamps = false;
}
