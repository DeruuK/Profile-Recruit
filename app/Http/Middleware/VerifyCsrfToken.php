<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as BaseVerifier;
//use Illuminate\Http\Request;

class VerifyCsrfToken extends BaseVerifier
{
    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array
     */
    protected $except = [
        //
    ];
    
    //public function handle($request, Closure $next){
    //    return parent::handle($request, $next);
    //}
    
    protected function tokensMatch($request)
    {
        $token = $request->ajax() ? $request-> header('X-CSRF-Token') : $request->input('_token');
        return $request->session()->token() == $token;
    }
}
