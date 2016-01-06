<?php
namespace App\Repositories;

use App\Entities\User;

class UserRepositoryEloquent extends Repository implements UserRepository
{
    protected $_withCorporate = false;
    protected $_with = ['corporateRegister'];
    protected $_model = User::class;
    public $_table_name = 'user';

    public static function employeeByCompany($active = true)
    {
        $where = [
            'group'=>'employee',
            'corporate_register_id' => authData()
        ];
        if( $active )
            $where['status'] = 1;

        $users = User::where($where)->get();
        $data = [];
        foreach($users as $user)
            $data[] = $user->id;

        return $data;
    }
}