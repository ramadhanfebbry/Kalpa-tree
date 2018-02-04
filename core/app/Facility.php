<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Facility extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'facilities';

    /**
    * The database primary key value.
    *
    * @var string
    */
    protected $primaryKey = 'id';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['title', 'image', 'order_no'];

    
}
