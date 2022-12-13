<?php

use App\lse;

if (!function_exists('lse')) {
    function lse()
    {
        return app(LSE::class);
    }
}
