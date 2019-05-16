<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CompressionChiller extends Model
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
    protected $table = 'compression_chillers';

    /**
    * The database primary key value.
    *
    * @var string
    */
    protected $primaryKey = 'compression_chillers_id';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = [
                  'unique_row_id',
                  'chillername',
                  'refrigerant',
                  'manufacturer',
                  'compressor',
                  'temperature',
                  'investment_cost',
                  'discount',
                  'maintenence_costs'
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
     * Get the compressionChiller for this model.
     */
    public function compressionChiller()
    {
        return $this->belongsTo('App\Models\CompressionChiller','compression_chillers_id');
    }

    /**
     * Get the uniqueRow for this model.
     */
    public function uniqueRow()
    {
        return $this->belongsTo('App\Models\UniqueRow','unique_row_id');
    }



}
