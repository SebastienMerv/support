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
        $tickets = Ticket::all();

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

    public function update(Request $request, $id) {
        $validated = $request->validate([
            'description' => 'required',
            'urgency' => 'required|exists:priorities,id',
            'category' => 'required|exists:categories,id',
            'assignation' => 'array|nullable',
            'observer' => 'array|nullable',
            'requester' => 'array|nullable',
        ]);

        $ticket = Ticket::findOrFail($id);
        $ticket->priority_id = $validated['urgency'];
        $ticket->category_id = $validated['category'];
        $ticket->save();

        if (isset($validated['description'])) {
            $ticket->comments()->create([
                'comment' => $validated['description'],
                'user_id' => auth()->id(),
            ]);
        }

        if (isset($validated['assignation'])) {
            $ticket->technicians()->sync($validated['assignation']);
        }

        return redirect()->route('tickets.index')->with('success', 'Ticket updated successfully');
    }
}
