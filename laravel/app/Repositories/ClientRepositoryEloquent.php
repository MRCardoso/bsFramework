<?php
namespace App\Repositories;

use App\Entities\Client;

class ClientRepositoryEloquent extends Repository implements ClientRepository
{
    protected $_model = Client::class;
    public $_table_name = 'client';
    protected $_with = ['user', 'corporateRegister'];
}