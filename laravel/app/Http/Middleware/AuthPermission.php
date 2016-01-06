<?php
/*
 | -------------------------------------------------------------------------------------------
 | Verify permission Auth User
 | -------------------------------------------------------------------------------------------
 | check if the user authenticated has permission to see the route access
 |
 */
namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Lang;

class AuthPermission
{
    private $_routeAllow = ['user','client','company','product','deliveryman','request'];
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
        if( !in_array($param, $this->_routeAllow) )
            return response()->json(Lang::get('app.interface_not_found'), 404);

        if( ( $id = $request->route()->{$param} ) != NULL )
        {
            $model = "App\\Entities\\".ucfirst($param);
            $user = ( intval($request->route()->{$param}) ? $model::find($request->route()->{$param}): NULL );

            if( permission($user,'interface') )
            {
                if( $request->route()->{$param} != "create")
                    return $next($request);
            }
            else
                return response()->json(Lang::get('app.the_user_don\'t_has_permission_to_access_this_interface'), 403);
        }
        else
        {
            return $next($request);
        }
    }
}
