<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AdkaCalculation extends Model
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
    protected $table = 'adka_calculations';

    /**
    * The database primary key value.
    *
    * @var string
    */
    protected $primaryKey = 'adka_calculations_id';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
      protected $fillable = [
                   'unique_row_id',
                  'tn_htIn',
                  'tn_mtIn',
                  'tn_ltIn',
                  'cal_constants_id',
                  'qth_lt',
                  'qth_ht',
                  'qth_mt',
                  'cop_th',
                  'tn_htout',
                  'tn_mtout',
                  'tn_ltout',
                  'vf_ht',
                  'vf_mt',
                  'vf_lt'
                  
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
    // public function recooling()
    // {
    //     return $this->belongsTo('App\Models\Recooling','recooling_id');
    // }

    /**
     * Get the fahrenheit for this model.
     */
    // public function fahrenheit()
    // {
    //     return $this->belongsTo('App\Models\Fahrenheit','fahrenheit_id','fahrenheit_id');
    // }



}
