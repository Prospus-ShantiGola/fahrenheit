<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GeneralInformation extends Model
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
    protected $table = 'general_informations';

    /**
    * The database primary key value.
    *
    * @var string
    */
    protected $primaryKey = 'general_informations_id';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = [
                  'unique_row_id',
                  'project_number',
                  'project_name',
                  'location',
                  'customer',
                  'contact',
                  'phone_number',
                  'email_address',
                  'editor',
                  'company',
                  'address',
                  'personal_phone_number',
                  'mobile_number',
                  'personal_email_address'
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
     * Get the generalInformation for this model.
     */
    public function generalInformation()
    {
        return $this->belongsTo('App\Models\GeneralInformation','general_informations_id');
    }

    /**
     * Get the uniqueRow for this model.
     */
    public function uniqueRow()
    {
        return $this->belongsTo('App\Models\UniqueRow','unique_row_id');
    }



}
