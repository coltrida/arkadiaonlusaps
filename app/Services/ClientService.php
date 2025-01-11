<?php

namespace App\Services;

use App\Models\AttivitaCliente;
use App\Models\Client;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;


class ClientService
{
    public function listaRagazziPaginate($testo)
    {
        return Client::where('name', 'like', '%'.$testo.'%')->latest()->paginate(5);
    }

    public function listaRagazzi()
    {
        return Client::orderBy('name')->get();
    }

    public function inserisci($request)
    {
        try {
            Client::create($request->all());
            return ['Cliente Inserito Correttamente!', 'success'];
        } catch (QueryException $e) {
            // Errore specifico legato al database
            if ($e->getCode() == 23000) { // Violazione dei vincoli (es. unique)
                if (!$request->name){
                    return ['Nome Obbligatorio - inserimento non effettuato', 'error'];
                }
                return ['Nome già presente - inserimento non effettuato', 'error'];
            }
            return [$e->getMessage(), 'error'];
        } catch (\Exception $e) {
            // Errore generico
            return [$e->getMessage(), 'error'];
        }
    }

    public function elimina($id)
    {
        $client = Client::find($id);
        $client->name = $client->name.' - cancellato';
        $client->save();
        $client->delete();
    }

    public function modifica($client, Request $request)
    {
        try {
            $client->name = $request->name;
            $client->voucher = $request->voucher;
            $client->scadenza = $request->scadenza;
            $client->save();
            return ['Cliente Modificato Correttamente!', 'success'];
        } catch (QueryException $e) {
            // Errore specifico legato al database
            if ($e->getCode() == 23000) { // Violazione dei vincoli (es. unique)
                return ['Nome già presente - modifica non effettuata', 'error'];
            }
            return [$e->getMessage(), 'error'];
        } catch (\Exception $e) {
            // Errore generico
            return [$e->getMessage(), 'error'];
        }
    }

    public function listaAttivitaClientPaginate()
    {
        return AttivitaCliente::with('activity', 'client')->latest()->paginate(10);
    }
}
