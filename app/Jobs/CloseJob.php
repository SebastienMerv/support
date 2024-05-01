<?php

namespace App\Jobs;

use App\Models\Setting;
use App\Models\Ticket;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class CloseJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $param = Setting::where('name', 'days_to_resolve')->first();
        $tickets = Ticket::where('status', 'open')->where('created_at', '<', now()->subDays($param->value))->get();
        foreach($tickets as $ticket) {
            $ticket->update(['status' => 'closed']);
        }
    }
}
