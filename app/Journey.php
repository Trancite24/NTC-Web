<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Journey extends Model
{
    //

    //Overiding default table naming convention
    protected $table = 'journey';

    //Overriding default primary key naming convension
    protected $primaryKey = 'journeyId';

    // Overriding default primary key type
    protected $keyType = 'string';

    public function busstops()
    {
        return $this->hasMany('App\Busstop', 'journeyId');
    }
}
