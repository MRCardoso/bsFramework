<?php

namespace App\Entities;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    /**
     * The database table used by the model.
     * @var string
     */
    protected $table = 'client';
    /**
     * The attributes that are mass assignable.
     * @var array
     */
    protected $fillable = ['corporate_register_id', 'user_id', 'name','phone','birthday', 'address', 'number', 'neightborhood','city','reference','status'];
    /*
    | --------------------------------------------------------------------------------------
    | Relation with table request
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
    public function request()
    {
        return $this->hasMany('App\Entities\Request');
    }
    /*
    | --------------------------------------------------------------------------------------
    | validate fields before save in database
    | --------------------------------------------------------------------------------------
    |*/
    /**
     * @param $birthday
     */
    public function setBirthdayAttribute($birthday)
    {
        $this->attributes['birthday'] = ( $birthday == "" ? NULL : Carbon::createFromFormat('d/m/Y', $birthday)->format('Y-m-d'));
    }
}
