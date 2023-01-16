<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class MakeCharactersConsistent
{
    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param Closure $next
     * @return mixed
     * @author M.Alipuor <meysam.alipuor@gmail.com>
     */
    public function handle($request, Closure $next)
    {
        if($request->method() == 'GET')
        {
            return $next($request);
        }

        foreach ($request->all() as $input_name => $input_value) {
            /**
             * If the input value is a string we will handle it by this if block.
             */
            if (is_string($input_value))
            {
                $request->merge([$input_name => Str::charToValidChar($input_value)]);
            }

            /**
             * If the input value is an array we will handle it by this if block.
             */
            if (is_array($input_value))
            {
                foreach($input_value as $input_name0 => $input_value0)
                {
                    $input_value[$input_name0] = Str::charToValidChar($input_value0);
                }

                /**
                 * Merge converted data into the request.
                 */
                $request->merge([$input_name => $input_value]);
            }
        }

        return $next($request);
    }
}
