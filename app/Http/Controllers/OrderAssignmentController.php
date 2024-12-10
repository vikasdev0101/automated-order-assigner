<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Artisan;

class OrderAssignmentController extends Controller
{
    public function triggerOrderAssignment()
    {
        Artisan::call('assign:order');

        return response()->json(['message' => 'Order assignment process triggered successfully.']);
    }
}
