<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Busstop extends Model
{
    //
    //Overiding default table naming convention
    protected $table = 'busstop';

    //Overriding default primary key naming convension
    protected $primaryKey = 'busstopId';

    // Overriding default primary key type
    protected $keyType = 'string';

    public function journey()
    {
        return $this->belongsTo('App\Journey', 'journeyId');
    }
}
