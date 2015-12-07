<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use AlgoliaSearch\Laravel\AlgoliaEloquentTrait;

class Species extends Model
{
	use AlgoliaEloquentTrait;
	
	public static $objectIdKey = 'id';

    protected $fillable = [
    'id',
    'description'
    ];
}
