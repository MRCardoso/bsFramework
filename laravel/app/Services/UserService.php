<?php
namespace App\Services;

use App\Entities\CorporateRegister;
use App\Entities\User;
use App\Repositories\CorporateRegisterRepository;
use App\Repositories\UserRepository;
use App\Repositories\UserRepositoryEloquent;
use App\Validators\UserValidator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Lang;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;

class UserService extends Service
{
    protected $_withUser = false;
    private static $groupAllow = ['admin','user','company', 'employee'];

    public static function groupAllow()
    {
        return self::$groupAllow;
    }
    /**
     * @var CorporateRegisterRepository
     */
    private $_corporateRegisterRepository;
    private $_corporateRegisterService;
    /**
     * @param CorporateRegisterRepository $corporateRegisterRepository
     * @param CorporateRegisterService $corporateRegisterService
     * @param UserRepository $repository
     * @param UserValidator $validator
     */
    public function __construct(CorporateRegisterRepository $corporateRegisterRepository,
                                CorporateRegisterService $corporateRegisterService,
                                UserRepository $repository,
                                UserValidator $validator)
    {
        $this->_corporateRegisterRepository = $corporateRegisterRepository;
        $this->_corporateRegisterService = $corporateRegisterService;
        $this->_repository = $repository;
        $this->_validator = $validator;
    }

    /**
     * @param array $data
     * @return \Illuminate\Http\JsonResponse|null
     */
    public function create( Array $data )
    {
        return $this->save($data);
    }

    /**
     * @param array $data
     * @param $id
     * @return \Illuminate\Http\JsonResponse|null
     */
    public function update( Array $data, $id)
    {
        return $this->save($data, $id);
    }

    /**
     * process transaction create and update
     *
     * @param array $data
     * @param null $id
     * @return \Illuminate\Http\JsonResponse|null
     */
    private function save(Array $data, $id = NULL)
    {
        DB::beginTransaction();
        try{
            if( $id != NULL )
            {
                $corporate = User::find($id)->corporateRegister;
                $this->_validator->prepareRules(true);
            }
            else
                $corporate = new CorporateRegister();
            $item = $this->validateGroup($data, $corporate);

            if( gettype($item) == "object" )
                return $item;
            $data["corporate_register_id"] = $item;
            validateField($this->_repository->attributes(), $data);
            $this->_validator->with($data)->passesOrFail( ValidatorInterface::RULE_CREATE );
            if( $id == NULL )
                $module = $this->_repository->create($data);
            else
                $module = $this->_repository->update($data, $id);

            DB::commit();

            if( isset($data["signup"]) && $data["signup"] ) Auth::login($module);

            return response()->json([
                "module" => $module,
                "message"=> $this->output_msg[( $id ==NULL?"create":"update")]
            ]);
        } catch(ValidatorException $e) {
            DB::rollback();
            return response()->json($e->getMessageBag(), 400);
        }
    }

    /**
     * verify which group belongs the current user to create
     *
     * @param $data
     * @param null $corporate
     * @return \Illuminate\Http\JsonResponse|null
     * @throws ValidatorException
     */
    public function validateGroup(&$data, $corporate = NULL)
    {
        if( isset($data["group"]) )
        {
            $corporateRegister = [];
            if( isset($data["signup"]) && $data["signup"] )
            {
                $this->_validator->setCustomRules("group", "required|validGroup:signup");
            }
            elseif( !checkGroup("admin") )
            {
                if( checkGroup("company") )
                    if( isset($data["id"]) && $data["id"] == authData("id") )
                        $data["group"] = "company";
                    else
                        $data["group"] = "employee";
                else
                    $data["group"] = authData("group");
            }
            switch($data["group"])
            {
                case "admin":
                    $corporateRegister = $this->_corporateRegisterRepository->findWhere(["code" => env("MY_CODE", "standard")]);
                    break;
                case "user":
                    $corporateRegister = $this->_corporateRegisterRepository->findWhere(["code"=> "user_test"]);
                    break;
                case "employee":
                    if( ($corporate = authData("CorporateRegister") ) != NULL && checkGroup("company") )
                        $corporateRegister[] = $corporate;
                    else
                        if( isset($data["corporate_register_id"]) && $data["corporate_register_id"] != NULL)
                            $corporateRegister = $this->_corporateRegisterRepository->findWhere(["id" => $data["corporate_register_id"]]);
                    break;
                case "company":
                    $data["corporate_register"]["return_data"] = true;
                    if( $corporate->id != NULL )
                        return $this->_corporateRegisterService->update($data["corporate_register"], $corporate->id);
                    else
                        return $this->_corporateRegisterService->create($data["corporate_register"]);
                    break;
            }
            if( count($corporateRegister) > 0 )
                return $corporateRegister[0]->id;
        }
        return NULL;
    }
    public function destroy($id)
    {
        DB::beginTransaction();
        try{
            $data = ['status' => $this->_repository->getInactive()];
            $user = $this->_repository->find($id);
            $user->update($data);

            if( $user->group == "company" )
                User::where(['group'=>'employee', 'corporate_register_id' => $user->corporate_register_id])->update($data);

            DB::commit();

            if( ($user = authData('id') ) != NULL && $user == $id )
            {
                Auth::logout();
                return response()->json([ "message" => 'logout' ]);
            }

            return response()->json([ "message" => $this->output_msg["delete"][1] ]);

        } catch(ValidatorException $e) {
            DB::rollback();
            return response()->json($e->getMessageBag(), 400);
        }
    }
}