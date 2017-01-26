<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
	use SoftDeletes;

    protected $fillable = ['name', 'project_id'];

    public function project()
    {
    	return $this->belongsTo('App\Project');
    }
}
