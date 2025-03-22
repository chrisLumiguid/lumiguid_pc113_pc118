<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class AdminController extends Controller
{
    public function dashboard()
    {
        return response()->json([
            'message' => 'Welcome to the Admin Dashboard!',
            'data' => [
                'total_users' => 100, 
                'total_orders' => 50,
            ]
        ]);
    }
}
