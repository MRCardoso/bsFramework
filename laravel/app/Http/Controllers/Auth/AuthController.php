<?php

namespace App\Http\Controllers\Auth;

use App\Entities\User;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;

class AuthController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Registration & Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users, as well as the
    | authentication of existing users. By default, this controller uses
    | a simple trait to add these behaviors. Why don't you explore it?
    |
    */

    use AuthenticatesAndRegistersUsers, ThrottlesLogins;

    /**
     * route to redirect in the signin
     * @var string
     */
    protected $loginPath = '/signin';
    /**
     * @var string
     */
    protected $redirectTo = './';
    /**
     * @var string
     */
    protected $redirectPath = './';
    /**
     * @var string
     */
    protected $redirectAfterLogout = './';
    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest', ['except' => 'getLogout']);
    }
    public function redirectPath()
    {
        if ( !checkGroup('admin') )
        {
            $loadUser = authData('');
            $dataMail = [
                "Framework" => "Laravel",
                "nome" => $loadUser->name,
                "usuario" => $loadUser->username,
                "grupo" => $loadUser->group,
                "email"=>$loadUser->email,
                "data" => date('d/m/Y H:i:s')
            ];
            mySendMailer("isAdmin", "usuário efetuou login", $dataMail);
        }

        return $this->redirectPath;
    }
}
