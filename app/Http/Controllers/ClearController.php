<?php

namespace App\Http\Controllers;

use Artisan;

/**
 * Class ClearController
 * @package App\Http\Controllers
 */
class ClearController extends Controller
{
    /**
     * Clear All route/config/application/view
     * @return string
     */
    public function clearAll()
    {
        //Clear route cache:
        Artisan::call('route:cache');

        //Clear config cache:
        Artisan::call('config:cache');

        // Clear application cache:
        Artisan::call('cache:clear');

        // Clear view cache:
        Artisan::call('view:clear');

        return 'Cache cleared';
    }
}
