<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class PageFooter extends Model
{
    protected $table = 'page_footer';
    protected $fillable = [
        'tile',
        'href',
        'body',
        'status',
    ];
    public $timestamps = false;
}
