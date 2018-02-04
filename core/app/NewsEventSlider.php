<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class NewsEventSlider extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'news_event_sliders';

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
    protected $fillable = ['id_news_event', 'image', 'order_no'];
    
}
