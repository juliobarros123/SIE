<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AccessControllAdmin
 {
    /**
    * Handle an incoming request.
    *
    * @param  \Illuminate\Http\Request  $request
    * @param  \Closure  $next
    * @return mixed
    */

    public function handle( Request $request, Closure $next )
 {

        if ( auth()->user()->tipoUtilizador == 'Filho' ) {
            return redirect()->route( 'home' );
        } else if ( auth()->user()->tipoUtilizador == 'Professor' ) {
            return redirect()->back()->with( 'permissao', '1' );
        } else if ( auth()->user()->tipoUtilizador == 'Encarregado' ) {
            return redirect()->route( 'home' );
        } else {
            return $next( $request );
        }

    }
}
