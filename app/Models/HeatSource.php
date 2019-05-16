<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HeatSource extends Model
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
    protected $table = 'heat_sources';

    /**
    * The database primary key value.
    *
    * @var string
    */
    protected $primaryKey = 'heat_sources_id';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = [
                  'unique_row_id',
                  'heat_name',
                  'heat_type',
                  'drive_temp',
                  'heat_capacity',
                  'electricity_capacity',
                  'thermal_efficienty',
                  'electricity_efficienty',
                  'new_installation',
                  'heat_investment_cost',
                  'heat_investment_discount',
                  'heat_maintenance_cost'
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
     * Get the heatSource for this model.
     */
    public function heatSource()
    {
        return $this->belongsTo('App\Models\HeatSource','heat_sources_id');
    }

    /**
     * Get the uniqueRow for this model.
     */
    public function uniqueRow()
    {
        return $this->belongsTo('App\Models\UniqueRow','unique_row_id');
    }



}
