<?php

namespace App\Http\Controllers;

use App\Models\Log;
use Illuminate\Http\Request;

class LogController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function index(Request $request)
    {
        $query = Log::query();

        // Filtre par date
        if ($request->filled('filtre_Date')) {
            $period = $request->filtre_Date;

            if ($period !== 'all') {
                $today = now()->startOfDay();

                match ($period) {
                    'today' => $query->whereDate('created_at', $today),
                    'yesterday' => $query->whereDate('created_at', $today->copy()->subDay()),
                    'week' => $query->whereBetween('created_at', [
                        now()->startOfWeek(),
                        now()->endOfWeek(),
                    ]),
                    'month' => $query->whereMonth('created_at', now()->month)
                                     ->whereYear('created_at', now()->year),
                    'lastmonth' => $query->whereMonth('created_at', now()->subMonth()->month)
                                    ->whereYear('created_at', now()->year),
                    default => null,
                };
            }
        }

        if ($request->filled('filter_search')) {
        $search = $request->filter_search;
        $query->where(function ($q) use ($search) {
        $q->where('log_name', 'like', '%' . $search . '%')
          //->orWhere('message', 'like', '%' . $search . '%')
          ->orWhere('description', 'like', '%' . $search . '%')
          ->orWhereHas('user', function ($qa) use ($search) {
              $qa->where('name', 'like', '%' . $search . '%');
          })
          ->orWhereHas('ticket', function ($qc) use ($search) {
              $qc->where('title', 'like', '%' . $search . '%');
          })
         ;
    });}


        $logs = $query->latest()->distinct()->paginate(10);

        return view('logs.index', compact('logs'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
