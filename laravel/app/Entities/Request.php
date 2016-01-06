<?php

namespace App\Entities;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Request extends Model
{
    /**
     * @var string
     */
    protected $table = 'request';
    /**
     * The attributes that are mass assignable.
     * @var array
     */
    protected $fillable = ['corporate_register_id','user_id','deliveryman_id','client_id','product_id','description','request_date','quantity','price','freight','change','discount','situation'];
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
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function deliveryman()
    {
        return $this->belongsTo('App\Entities\Deliveryman');
    }
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function product()
    {
        return $this->belongsTo('App\Entities\Product');
    }
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function client()
    {
        return $this->belongsTo('App\Entities\Client');
    }
    /*
    | --------------------------------------------------------------------------------------
    | Validations before save
    | --------------------------------------------------------------------------------------
    |*/
    /**
     * @param $request_date
     */
    public function setRequestDateAttribute($request_date)
    {
        $this->attributes['request_date'] = ( $request_date == "" ? NULL : Carbon::createFromFormat('d/m/Y', $request_date)->format('Y-m-d'));
    }
}
