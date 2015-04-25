<?php namespace LaraCms\Lara\Middleware;

use Closure;
use Illuminate\Contracts\Auth\Guard;

class LaraCmsLara {

	/**
	 * The Guard implementation.
	 *
	 * @var Guard
	 */
	protected $auth;

	/**
	 * Create a new filter instance.
	 *
	 * @param  Guard  $auth
	 * @return void
	 */
	public function __construct(Guard $auth)
	{
		$this->auth = $auth;
	}

	/**
	 * Handle an incoming request.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \Closure  $next
	 * @return mixed
	 */
	public function handle($request, Closure $next)
	{
            return true;
            
                $auth = Config('lara-cms.lara.master.auth',[]);
            
		if ($this->auth->guest())
		{
			if ($request->ajax())
			{
				return response('Unauthorized.', 401);
			}
			else
			{
				return redirect()->guest('auth/login');
			}
		}
                if ( in_array($this->auth->user()->email, $auth) and $this->auth->user()->active)
                {
                    return $next($request);
                }
                else
                {
                    return redirect()->guest('auth/login');
                }
	}

}
