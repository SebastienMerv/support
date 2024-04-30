<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Priority;
use App\Models\Ticket;
use App\Models\User;
use Illuminate\Http\Request;

class TicketController extends Controller
{
    public function dashboard()
    {
        return view('dashboard');
    }

    public function index()
    {
        // Tickets where TicketTechnician contains the authenticated user
        if (auth()->user()->group->name == 'Administrateurs') {
            $tickets = Ticket::all();
        } else {
            $tickets = Ticket::whereHas('technicians', function ($query) {
                $query->where('user_id', auth()->id());
            })->get();
        }

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

        return redirect()->route('tickets.index')->with('success', 'Ticket created successfully');
    }

    public function show($id)
    {
        $tiquet = Ticket::findOrFail($id);
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



        return redirect()->route('tickets.index')->with('success', 'Ticket updated successfully');
    }
}
