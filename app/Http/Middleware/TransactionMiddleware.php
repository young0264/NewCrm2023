<?php

use Closure;
use Illuminate\Support\Facades\DB;

class TransactionMiddleware
{
    public function handle($request, Closure $next)
    {
        DB::beginTransaction();
        $response = $next($request);
        if ($response->getStatusCode() >= 400) {
            DB::rollBack();
        } else {
            DB::commit();
        }
        return $response;
    }
}


