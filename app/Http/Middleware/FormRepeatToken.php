<?php

namespace App\Http\Middleware;

use Closure;

class FormRepeatToken
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
        if($request->input('_rtoken') != $request->session()->get('rtoken')){
            return redirect()->back()->with('msg',["type"=>"success","content"=>"表单已经过期!"]);
        }
        return $next($request);
    }
}
