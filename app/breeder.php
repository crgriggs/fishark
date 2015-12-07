<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Breeder extends Model
{
    protected $fillable = [
    'speciesID',
    'numFish',
    'username',
    'userID'
    ];
}
