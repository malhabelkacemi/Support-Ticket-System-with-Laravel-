<?php

namespace App\Services;

use App\Models\Ticket;

class TicketService
{
    /**
     * Récupérer le nombre total de tickets
     */
    public function getTotalTickets(): int
    {
        return Ticket::count();
    }

    /**
     * Récupérer le nombre de tickets ouverts
     */
    public function getOpenTicketsCount(): int
    {
        return Ticket::where('status', 'open')->count();
    }

    /**
     * Récupérer le nombre de tickets en cours
     */
    public function getInProgressTicketsCount(): int
    {
        return Ticket::where('status', 'in_progress')->count();
    }

    /**
     * Récupérer le nombre de tickets archivés
     */
    public function getArchivedTicketsCount(): int
    {
        return Ticket::where('status', 'archived')->count();
    }

    /**
     * Récupérer le nombre de tickets fermés
     */
    public function getClosedTicketsCount(): int
    {
        return Ticket::where('status', 'closed')->count();
    }

    /**
     * Récupérer toutes les statistiques en une fois
     */
    public function getTicketStats(): array
    {
        return [
            'total' => $this->getTotalTickets(),
            'open' => $this->getOpenTicketsCount(),
            'in_progress' => $this->getInProgressTicketsCount(),
            'archived' => $this->getArchivedTicketsCount(),
            'closed' => $this->getClosedTicketsCount(),
        ];
    }

 /*
    public function getTicketsByStatus(string $status): int
    {
        return Ticket::where('status', $status)->count();
    }
*/

}
