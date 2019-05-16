<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EconomicDataAdditionalInfo extends Model
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
    protected $table = 'economic_data_additional_infos';

    /**
    * The database primary key value.
    *
    * @var string
    */
    protected $primaryKey = 'economic_data_additional_infos_id';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = [
                  'economic_data_id',
                  'tab_name',
                  'additional_field_name',
                  'additional_field_value',
                  'additional_field_discount'
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
     * Get the economicDataAdditionalInfo for this model.
     */
    public function economicDataAdditionalInfo()
    {
        return $this->belongsTo('App\Models\EconomicDataAdditionalInfo','economic_data_additional_infos_id');
    }

    /**
     * Get the economicDatum for this model.
     */
    public function economicDatum()
    {
        return $this->belongsTo('App\Models\EconomicDatum','economic_data_id');
    }



}
