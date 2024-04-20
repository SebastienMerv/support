<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'priority_id', 'category_id'];

    public function comments()
    {
        return $this->hasMany(TicketComment::class);
    }

    public function priority()
    {
        return $this->belongsTo(Priority::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function technicians()
    {
        // Tous les utilisateurs qui sont techniciens sur ce ticket et qui ont le rôle id 1 ou 2
        $users = $this->belongsToMany(User::class, 'tickets_technicians');

        // On retire tous les utilisateurs qui n'ont pas un id de rôle 1 ou 2
        $users = $users->whereHas('group', function ($query) {
            $query->whereIn('group_id', [1, 2]);
        });

        return $users;
    }
}
