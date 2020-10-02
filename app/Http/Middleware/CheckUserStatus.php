<?php

namespace App\Http\Middleware;
use App\Status;
use Auth;
use Closure;
use DB;
class CheckUserStatus
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (Auth::user()) {
            # code...
        
            $status=Db::table('statuses')
                        ->join('users_statuses','users_statuses.status_id','=','statuses.id')
                        ->join('users','users_statuses.user_id','=','users.id')
                        ->where('users.id','=',Auth::user()->id)
                        ->select('statuses.status_slug')->first();

            // dd($status->slug);

            if (!$status->status_slug) {
            
                return redirect('/change_password')->with('message','Your account is currently inactive please change password to activate it');
                
            }

            // if (Auth::user()->userStatus) {
            //         return $next($request);
            //     } else {
            //         return redirect('/login')->with('message','Your account is currently inactive.');
            //     }
            return $next($request);
              
        }
        else{
            return redirect('/login');
        }
    
    }
}
