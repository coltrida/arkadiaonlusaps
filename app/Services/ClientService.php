<?php

namespace App\Services;

use App\Models\Associa;
use App\Models\AttivitaCliente;
use App\Models\Client;


class ClientService
{
    public function listaRagazziPaginate()
    {
        return Client::orderBy('name')->paginate(5);
    }

    public function listaRagazzi()
    {
        return Client::orderBy('name')->get();
    }

    public function inserisci($request)
    {
        Client::insert([
            'name' => $request->name,
            'voucher' => $request->voucher,
            'scadenza' => $request->scadenza,
        ]);
    }

    public function modifica($client, $request)
    {
        $client->name = $request->name;
        $client->voucher = $request->voucher;
        $client->scadenza = $request->scadenza;
        $client->save();
    }

    public function listaAssociazioniAttivitaClientPaginate()
    {
        return Associa::with('client', 'activity')->orderBy('activity_id')->paginate(5);
    }

    public function listaAttivitaClientPaginate()
    {
        return AttivitaCliente::with('activity', 'client')->latest()->paginate(10);
    }
}
