<?php

namespace App\Entities;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    /**
     * The database table used by the model.
     * @var string
     */
    protected $table = 'company';
    /**
     * The attributes that are mass assignable.
     * @var array
     */
    protected $fillable = ['corporate_register_id','user_id','name','cnpj','address','phone','email','start_date','end_date', 'status'];
    /*
    | --------------------------------------------------------------------------------------
    | Relations
    | --------------------------------------------------------------------------------------
    |*/
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function corporateRegister()
    {
        return $this->belongsTo('App\Entities\CorporateRegister');
    }
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo('App\Entities\User');
    }
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function deliveryman()
    {
        return $this->hasMany('App\Entities\Deliveryman');
    }
    /*
    | --------------------------------------------------------------------------------------
    | validate fields before save in database
    | --------------------------------------------------------------------------------------
    |*/
    /**
     * @param $date
     */
    public function setStartDateAttribute($date)
    {
        $this->attributes['start_date'] = ( $date == "" ? NULL : Carbon::createFromFormat('d/m/Y', $date)->format('Y-m-d'));
    }
    /**
     * @param $date
     */
    public function setEndDateAttribute($date)
    {
        $this->attributes['end_date'] = ( $date == "" ? NULL : Carbon::createFromFormat('d/m/Y', $date)->format('Y-m-d'));
    }
}