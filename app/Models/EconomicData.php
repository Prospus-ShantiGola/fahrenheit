<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EconomicData extends Model
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
    protected $table = 'economic_datas';

    /**
    * The database primary key value.
    *
    * @var string
    */
    protected $primaryKey = 'economic_datas_id';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = [
                  'unique_row_id',
                  'electric_price',
                  'heat_price',
                  'electric_price_increased',
                  'calculated_interest_rate',
                  'inflation_rate',
                  'own_usage_of_electricity',
                  'subsidy_for_electricity',
                  'gas_price',
                  'electricity_sales_price',
                  'energy_tax_refund',
                  'eeg_allocation_portion',
                  'eeg_apportion_costs',
                  'chp_basement',
                  'discount_chp_basement',
                  'chiller',
                  'chiller_discount',
                  'radiant_cooling_office',
                  'radiant_discount',
                  'ecoo',
                  'ecoo_discount',
                  'chp_basement_maintenence',
                  'chiller_maintenence',
                  'radiant_maintenence',
                  'ecoo_maintenence'
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
     * Get the economicData for this model.
     */
    public function economicData()
    {
        return $this->belongsTo('App\Models\EconomicData','economic_datas_id');
    }

    /**
     * Get the uniqueRow for this model.
     */
    public function uniqueRow()
    {
        return $this->belongsTo('App\Models\UniqueRow','unique_row_id');
    }



}
