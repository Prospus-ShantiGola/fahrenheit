<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RecoolingSystem extends Model
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
    protected $table = 'recooling_systems';

    /**
    * The database primary key value.
    *
    * @var string
    */
    protected $primaryKey = 'recooling_id';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = [
                  'fahrenheit_id',
                  'recooler_component',
                  'recooler_method',
                  'recooler_product',
                  'recooler_units',
                  'recooler_name',
                  'recooler_capacity',
                  'recooler_temp_diff',
                  'recooler_sec_volume',
                  'recooler_elec_consumption',
                  'recooler_available',
                  'recooler_inv_cost',
                  'recooler_discount',
                  'recooler_maint_cost'
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
     * Get the recooling for this model.
     */
    public function recooling()
    {
        return $this->belongsTo('App\Models\Recooling','recooling_id');
    }

    /**
     * Get the fahrenheit for this model.
     */
    public function fahrenheit()
    {
        return $this->belongsTo('App\Models\Fahrenheit','fahrenheit_id','fahrenheit_id');
    }



}
