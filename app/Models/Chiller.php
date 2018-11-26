<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Chiller extends Model
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
    protected $table = 'chillers';

    /**
    * The database primary key value.
    *
    * @var string
    */
    protected $primaryKey = 'chiller_id';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = [
                  'fahrenheit_id',
                  'chiller_chiller_type',
                  'chiller_adsorbent',
                  'chiller_product',
                  'chiller_no_chiller',
                  'chiller_product_inter',
                  'chiller_group_inter',
                  'addchiller_investment_cost',
                  'addchiller_discount',
                  'addchiller_maintenence'
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
     * Get the chiller for this model.
     */
    public function chiller()
    {
        return $this->belongsTo('App\Models\Chiller','chiller_id');
    }

    /**
     * Get the fahrenheit for this model.
     */
    public function fahrenheit()
    {
        return $this->belongsTo('App\Models\Fahrenheit','fahrenheit_id','fahrenheit_id');
    }



}
