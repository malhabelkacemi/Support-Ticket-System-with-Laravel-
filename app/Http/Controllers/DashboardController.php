<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
public function index()
{

        $totalTickets = Ticket::count();
        $openTickets = Ticket::where('status', 'open')->count();
        $closedTickets = Ticket::where('status', 'closed')->count();

        return match (auth()->user()->role) {
            'admin' => view('dashboard.admin', compact(
                            'totalTickets',
                            'openTickets',
                            'closedTickets'
                        )),
            'agent' => view('dashboard.agent'),
            'user' => view('dashboard.user'),
    };


       /* 1

        return view('dashboard.admin', compact(
            'totalTickets',
            'openTickets',
            'closedTickets'
        ));*/
}
}
