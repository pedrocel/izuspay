<?php

namespace App\Http\Controllers\Cliente;

use App\Http\Controllers\Controller;
use App\Models\DomainModel;
use App\Models\PageModel;
use App\Models\PlanModel;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
      
        return view('cliente.news.index');
    }

}
