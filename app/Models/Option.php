<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Option extends Model
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
    protected $table = 'options';

    /**
    * The database primary key value.
    *
    * @var string
    */
    protected $primaryKey = 'option_id';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = [
                  'unique_row_id',
                  'bus_system',
                  'free_recooling',
                  'pressure_drop',
                  'profile_amb_tem',
                  'profile_bafa',
                  'profile_calculation_method',
                  'profile_controller',
                  'profile_conventional_heat',
                  'profile_cooling_load',
                  'profile_heat_source',
                  'profile_heat_supply',
                  'profile_heating_load',
                  'profile_recooling',
                  'profile_recooling_temp',
                  'recooling'
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
     * Get the option for this model.
     */
    public function option()
    {
        return $this->belongsTo('App\Models\Option','option_id');
    }

    /**
     * Get the uniqueRow for this model.
     */
    public function uniqueRow()
    {
        return $this->belongsTo('App\Models\UniqueRow','unique_row_id');
    }



}
