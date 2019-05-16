<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Fahrenheit extends Model
{
    
    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'fahrenheits';

    /**
    * The database primary key value.
    *
    * @var string
    */
    protected $primaryKey = 'fahrenheit_id';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = [
                  'unique_row_id'
              ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [];
    
    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [];
    
    /**
     * Get the fahrenheit for this model.
     */
    public function fahrenheit()
    {
        return $this->belongsTo('App\Models\Fahrenheit','fahrenheit_id');
    }

    /**
     * Get the uniqueRow for this model.
     */
    public function uniqueRow()
    {
        return $this->belongsTo('App\Models\UniqueRow','unique_row_id');
    }

    /**
     * Get the chiller for this model.
     */
    public function chiller()
    {
        return $this->hasOne('App\Models\Chiller','fahrenheit_id','fahrenheit_id');
    }

    /**
     * Get the recoolingSystem for this model.
     */
    public function recoolingSystem()
    {
        return $this->hasOne('App\Models\RecoolingSystem','fahrenheit_id','fahrenheit_id');
    }



}
