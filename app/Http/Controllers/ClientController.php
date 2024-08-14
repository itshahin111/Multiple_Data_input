<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    public function index()
    {
        $clients = Client::all();
        return view('clients.index', compact('clients'));
    }

    public function create()
    {
        return view('clients.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'clients.*.name' => 'required|string|max:255',
            'clients.*.email' => 'required|email|unique:clients,email',
            'clients.*.phone' => 'required|string|max:20',
            'clients.*.address' => 'required|string|max:500',
        ]);
    
        foreach ($validated['clients'] as $clientData) {
            Client::create($clientData);
        }
    
        return redirect()->route('clients.index')->with('success', 'Clients created successfully.');
    }
    

    public function edit(Client $client)
    {
        return view('clients.edit', compact('client'));
    }

    public function update(Request $request, Client $client)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:clients,email,' . $client->id,
            'phone' => 'required|string|max:20',
            'address' => 'required|string|max:500',
        ]);

        $client->update($validated);
        return redirect()->route('clients.index')->with('success', 'Client updated successfully.');
    }

    public function destroy(Client $client)
    {
        $client->delete();
        return redirect()->route('clients.index')->with('success', 'Client deleted successfully.');
    }
}
