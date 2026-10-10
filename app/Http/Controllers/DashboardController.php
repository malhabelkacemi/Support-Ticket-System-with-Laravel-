<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use App\Services\TicketService;
use Illuminate\Http\Request;

class DashboardController extends Controller
{

    protected TicketService $ticketService;

    public function __construct(TicketService $ticketService)
    {
        $this->ticketService = $ticketService;
    }

    public function index()
    {

        $stats = $this->ticketService->getTicketStats();

        return match (auth()->user()->role) {
            'admin' => view('dashboard.admin', compact("stats")),
            'agent' => view('dashboard.agent'),
            'user' => view('dashboard.user'),
    };

       /* $totalTickets = Ticket::count();
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
    };*/


       /* 1

        return view('dashboard.admin', compact(
            'totalTickets',
            'openTickets',
            'closedTickets'
        ));*/
}
}
