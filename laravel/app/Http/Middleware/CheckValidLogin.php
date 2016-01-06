<?php
/*
 | ---------------------------------------------------------------------------------------------------------------------
 | Verify the status
 | ---------------------------------------------------------------------------------------------------------------------
 | run the validation of the active user in the post (login and reset password)
 */
namespace App\Http\Middleware;

use App\Entities\User;
use Closure;

class CheckValidLogin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param string $param
     * @return mixed
     */
    public function handle($request, Closure $next, $param)
    {
        if( ( $email = $request->request->get('email') ) != null )
        {
            $user = User::where(['email' => $email])->get();
            if( count($user) > 0 && $user[0]->status == User::ACTIVE )
            {
                return $next($request);
            }
            else
            {
                return redirect($param)
                    ->withInput($request->only('email', 'remember'))
                    ->withErrors(['active' => 'Este usuário foi desativado.']);
            }
        }
        else
        {
            return $next($request);
        }
    }
}
