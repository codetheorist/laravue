<?php

namespace App\Http\Controllers;

use App\Users;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StatisticsController extends Controller
{
    public function index($sortby = NULL) {
        $logs = \LoginActivity::getLogs()->get();

        return response($logs);

    }

    private function usersByDay() {

    }
}
