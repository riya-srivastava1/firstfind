<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use App\Models\State;
use Illuminate\Http\Request;
use Modules\Hotel\App\Models\Hotel;
use Modules\Transport\App\Models\Transport;
use Modules\Sighseeing\App\Models\Sighseeing;

class DashboardController extends Controller
{
    public function dashboard()
    {

        return view('dashboard');
    }
}
