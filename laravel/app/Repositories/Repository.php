<?php
/*
 | -----------------------------------------------------------
 | Repository layer
 | -----------------------------------------------------------
 | Class to manage the data manipulation of the modules
 |
 |
 */
namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;

class Repository extends BaseRepository
{
    private $active = 1;
    private $inactive = 0;

    public function getActive()
    {
        return $this->active;
    }

    public function getInactive()
    {
        return $this->inactive;
    }
    /**
     * name of the table
     * @var
     */
    public $_table_name;
    /**
     * Current class model
     * @var
     */
    protected $_model;
    /**
     * verify if is required put a filter by corporate_register in the queries
     * @var bool
     */
    protected $_withCorporate = true;
    /**
     * relations that module nee
     * @var array
     */
    protected $_with = [];
    /**
     * get the name of the current class
     * @return mixed
     */
    public function model()
    {
        return $this->_model;
    }
    /**
     * get the field allow in the class
     * @return array
     */
    public function attributes()
    {
        return $this->model->getFillable();
    }
    /**
     * make a query appropriate for
     * filter by corporate authenticate,
     * by id of the record,
     * set the relation required
     *
     * @param null $id
     * @param array $_where
     * @param array $_fields
     * @param bool $_active
     * @param array $_sort
     * @return mixed
     */
    public function findRule($id = NULL,
                             Array $_where = [],
                             Array $_fields = ['*'],
                             $_active = false,
                             Array $_sort = ['id', 'DESC'])
    {
        $where = [];
        if( ( $user = authData('') ) != NULL )
        {
            if( $this->_table_name != 'user' || !checkGroup("admin") )
                $where["corporate_register_id"] = $user->corporate_register_id;
            if( $this->_table_name != 'user' && checkGroup("user") )
                $where["user_id"] = $user->id;
        }

        if( $id != NULL )
            $where["id"] = $id;

        if( $_active )
            $where["status"] = $this->getActive();

        if( $this->_with !== array() )
            $this->with($this->_with);

        if( $_where != array() )
            $where = array_merge($where, $_where);

        return $this->scopeQuery(
            function($query) use($_sort)
            {
                return $query->orderBy( $_sort[0], $_sort[1]);
            }
        )->findWhere($where, $_fields);
    }
}