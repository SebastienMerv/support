<?php

namespace App\Http\Controllers;

use App\Mail\CreateConfirm;
use App\Mail\NewActuTicket;
use App\Models\Category;
use App\Models\Priority;
use App\Models\Ticket;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class TicketController extends Controller
{
    public function dashboard()
    {
        $closed_tickets = Ticket::where('status', 'closed')->count();
        $open_tickets = Ticket::where('status', 'open')->count();
        return view('dashboard', [
            'closed_tickets' => $closed_tickets,
            'open_tickets' => $open_tickets,
        ]);
    }

    public function index()
    {
        // Tickets where TicketTechnician contains the authenticated user
        if (request()->has('search')) {
            if (request()->contains == 'yes') {
                $tickets = Ticket::where('title', 'like', '%' . request('search') . '%')->get();
            } else {
                $tickets = Ticket::where('title', 'not like', '%' . request('search') . '%')->get();
            }
        } else {
            if (auth()->user()->group->name == 'Admininistrateurs') {
                $tickets = Ticket::all();
            } else {
                $tickets = Ticket::whereHas('technicians', function ($query) {
                    $query->where('user_id', auth()->id());
                })->get();
            }
        }

        // Order the ticket by the last comment and urgency
        $tickets = $tickets->sortByDesc(function ($ticket) {
            return $ticket->comments->last()->created_at;
        });

        // Retrait des tickets closed
        $tickets = $tickets->filter(function ($ticket) {
            return $ticket->status != 'closed';
        });

        // If the user is not an admin, is not technician on this ticket or is not the author of the ticket
        $tickets = $tickets->filter(function ($ticket) {
            return auth()->user()->group->name == 'Admininistrateurs' || $ticket->technicians->contains(auth()->id()) || $ticket->user_id == auth()->id();
        });

        return view('tiquets.index', [
            'tickets' => $tickets,
        ]);
    }

    public function create()
    {
        $priorities = Priority::all();
        $categories = Category::all();

        return view('tiquets.create', [
            'priorities' => $priorities,
            'categories' => $categories,
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|max:255',
            'description' => 'required',
            'urgency' => 'required|exists:priorities,id',
            'category' => 'required|exists:categories,id',
        ]);

        $ticket = new Ticket();
        $ticket->title = $validated['title'];
        $ticket->priority_id = $validated['urgency'];
        $ticket->category_id = $validated['category'];
        $ticket->user_id = auth()->id();
        $ticket->save();

        $ticket->comments()->create([
            'comment' => $validated['description'],
            'user_id' => 1,
        ]);

        Mail::to(auth()->user()->email)->queue(new CreateConfirm($ticket));

        return redirect()->route('tickets.index')->with('success', 'Ticket created successfully');
    }

    public function show($id)
    {
        $tiquet = Ticket::findOrFail($id);

        // If the user is not an admin, is not technician on this ticket or is not the author of the ticket
        if (auth()->user()->group->name != 'Admininistrateurs' && !$tiquet->technicians->contains(auth()->id()) && $tiquet->user_id != auth()->id()) {
            return redirect()->route('tickets.index')->with('error', 'You are not allowed to see this ticket');
        }

        $cateogries = Category::all();
        $priorities = Priority::all();

        return view(
            'tiquets.show',
            [
                'ticket' => $tiquet,
                'categories' => $cateogries,
                'priorities' => $priorities,
                'users' => User::all(),
            ]
        );
    }

    public function update(Request $request, $id)
    {
        if ($request->close) {
            $ticket = Ticket::findOrFail($id);
            Mail::to($ticket->user->email)->queue(new NewActuTicket($ticket));
            $ticket->status = 'closed';
            $ticket->save();

            return redirect()->route('tickets.index')->with('success', 'Ticket closed successfully');
        }

        $validated = $request->validate([
            'urgency' => 'required|exists:priorities,id',
            'category' => 'required|exists:categories,id',
        ]);
        $ticket = Ticket::findOrFail($id);
        $ticket->category_id = $validated['category'];
        $ticket->priority_id = $validated['urgency'];
        $ticket->save();

        $user = User::find(auth()->id());
        if ($user->group->name == 'Admininistrateurs') {
            if (isset($request->assignation)) {
                $ticket->technicians()->sync($request->assignation);
            }

            if (isset($validated['observer'])) {
                $ticket->observers()->sync($request->observer);
            }
        }

        if (isset($validated['description'])) {
            $ticket->comments()->create([
                'comment' => $validated['description'],
                'user_id' => auth()->id(),
            ]);
        }

        return redirect()->route('tickets.index')->with('success', 'Ticket mis à jour avec succès');
    }
}
