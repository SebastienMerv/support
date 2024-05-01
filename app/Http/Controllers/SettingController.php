<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function index()
    {
        if(auth()->user()->group->name != 'Administrateurs') {
            return redirect()->route('tickets.create')->with('error', 'Vous n\'avez pas les droits pour accéder à cette page.');
        }
        $settings = Setting::all();
        return view('settings.index', compact('settings'));
    }

    public function update(Request $request)
    {
        if(auth()->user()->group->name != 'Administrateurs') {
            return redirect()->route('tickets.create')->with('error', 'Vous n\'avez pas les droits pour accéder à cette page.');
        }
        foreach($request->all() as $key => $value) {
            Setting::where('name', $key)->update(['value' => $value]);
        }
        return redirect()->route('settings.index')->with('success', 'Paramètres de l\'application mis à jour avec succès.');
    }
}
