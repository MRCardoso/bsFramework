<?php
namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

class CorporateRegister extends Model
{
    /**
     * The database table used by the model.
     * @var string
     */
    protected $table = 'corporate_register';
    /**
     * The attributes that are mass assignable.
     * @var array
     */
    protected $fillable = ['name', 'code', 'status'];
}