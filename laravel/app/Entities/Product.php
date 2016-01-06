<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    /**
     * The database table used by the model.
     * @var string
     */
    protected $table = 'product';
    /**
     * The attributes that are mass assignable.
     * @var array
     */
    protected $fillable = ['corporate_register_id', 'user_id','name','description','size','cost','status'];
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
    public function request()
    {
        return $this->hasMany('App\Entities\Request');
    }
}