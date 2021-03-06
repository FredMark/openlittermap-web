<?php

namespace App\Models\Litter\Categories;

use Illuminate\Database\Eloquent\Model;

class Pathway extends Model
{
    protected $table = 'pathways';

    public function photo() {
    	return $this->hasOne('App\Models\Photo');
    }

    protected $fillable = [
    	'id',
    	'photo_id',
    	'gutter',
    	'gutter_long',
    	'kerb_hole_small',
    	'kerb_hole_large',
    	'pathwayOther'
    ];
}
