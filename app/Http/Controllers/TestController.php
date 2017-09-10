<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Charts;
// use App\User;
use App\User;
class TestController extends Controller
{
    public function index()
    {
        $height = '500px';
        $chart = Charts::database(User::all(), 'line', 'chartjs')->dimensions(0,$height)->title('Latest Users')->groupByDay('08', null, true)->elementLabel('New Users');

        return view('test', ['chart' => $chart]);
    }
}
