<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TicketComment extends Model
{
    use HasFactory;

    protected $fillable = ['comment', 'ticket_id', 'user_id'];

    public function ticket()
    {
        return $this->belongsTo(Ticket::class);
    }
}
