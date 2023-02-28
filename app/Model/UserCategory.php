<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class UserCategory extends Model
{
    protected $table = 'user_category';
    protected $fillable = [
        'title',
        'slug',
        'deleted',
        'parent_id',
    ];
    public $timestamps = false;

    public function getUserSubCategories(){
        $select = UserCategory::where('deleted', '=', 0)
            ->where('parent_id', $this->id);
        return $select->get();
    }

    public function children()
    {
        return $this->hasMany(UserCategory::class, 'parent_id', 'id');
    }
}
