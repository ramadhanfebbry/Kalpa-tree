<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class NewsEvent extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'news_events';

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
    protected $fillable = ['title', 'subtitle', 'image', 'descriptions', 'order_no'];
    
}
