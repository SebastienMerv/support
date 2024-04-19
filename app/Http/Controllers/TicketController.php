<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TicketController extends Controller
{
    public function dashboard() {
        return view('dashboard');
    }

    public function index() {
        return view('tiquets.index');
    }

    public function create() {
        return view('tiquets.create');
    }

    public function show($id) {
        return view('tiquets.show', ['id' => $id]);
    }
}
