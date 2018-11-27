<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CoolingLoadProfile extends Model
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
    protected $table = 'cooling_load_profiles';

    /**
    * The database primary key value.
    *
    * @var string
    */
    protected $primaryKey = 'cooling_load_profiles_id';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = [
                  'unique_row_id',
                  'cooling_radiant_cooling_office',
                  'cooling_profile_type',
                  'cooling_cooling_other',
                  'cooling_max_cooling_load',
                  'cooling_max_cooling_load_at',
                  'cooling_base_load_to',
                  'cooling_base_load_from',
                  'cooling_zero_load_from',
                  'cooling_zero_load_to',
                  'cooling_cooling_hours',
                  'cooling_investment_cost',
                  'cooling_investment_discount',
                  'cooling_maintenance_cost'
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
     * Get the coolingLoadProfile for this model.
     */
    public function coolingLoadProfile()
    {
        return $this->belongsTo('App\Models\CoolingLoadProfile','cooling_load_profiles_id');
    }

    /**
     * Get the uniqueRow for this model.
     */
    public function uniqueRow()
    {
        return $this->belongsTo('App\Models\UniqueRow','unique_row_id');
    }



}
