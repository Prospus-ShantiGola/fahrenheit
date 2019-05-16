<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HeatingLoadProfile extends Model
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
    protected $table = 'heating_load_profiles';

    /**
    * The database primary key value.
    *
    * @var string
    */
    protected $primaryKey = 'heating_load_profiles_id';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = [
                  'unique_row_id',
                  'profile_name',
                  'profile_type',
                  'max_heat_load_power',
                  'max_heat_load_temp',
                  'base_load_power',
                  'base_load_temp',
                  'zero_load_power',
                  'zero_load_temp',
                  'hp_investment_cost',
                  'hp_discount',
                  'maintenance_cost'
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
     * Get the heatingLoadProfile for this model.
     */
    public function heatingLoadProfile()
    {
        return $this->belongsTo('App\Models\HeatingLoadProfile','heating_load_profiles_id');
    }

    /**
     * Get the uniqueRow for this model.
     */
    public function uniqueRow()
    {
        return $this->belongsTo('App\Models\UniqueRow','unique_row_id');
    }



}
