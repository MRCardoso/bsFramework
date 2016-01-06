<?php
namespace App\Repositories;

use App\Entities\Deliveryman;

class DeliverymanRepositoryEloquent extends Repository implements DeliverymanRepository
{
    protected $_with = ['company', 'user', 'corporateRegister'];
    protected $_model = Deliveryman::class;
    public $_table_name = 'deliveryman';
}