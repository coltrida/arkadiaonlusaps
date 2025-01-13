<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Database\QueryException;

class UserService
{
    public function infoUser($id)
    {
        return User::find($id);
    }

    public function listaOperatori()
    {
        return User::latest()->get();
    }

    public function listaOperatoriPaginate()
    {
        return User::latest()->paginate(5);
    }

    public function eliminaUser($idUser)
    {
        $user = User::find($idUser);
        $user->email = 'cancellato'.$user->id.'@cancellato.it';
        $user->save();
        $user->delete();
    }

    public function modificaUser(User $user, $request)
    {
        try {
            $user->name = $request->name;
            $user->email = $request->email;
            $user->oresaldo = $request->oresaldo;
            $user->oresettimanali = $request->oresettimanali;
            $user->save();
            return ['Operatore Modificato Correttamente!', 'success'];
        } catch (QueryException $e) {
            // Errore specifico legato al database
            if ($e->getCode() == 23000) { // Violazione dei vincoli (es. unique)
                if (!$request->name){
                    return ['Nome Obbligatorio - modifica non effettuata', 'error'];
                } elseif (!$request->email){
                    return ['Email Obbligatorio - modifica non effettuata', 'error'];
                }
                return ['email già presente - modifica non effettuata', 'error'];
            }
            return [$e->getMessage(), 'error'];
        } catch (\Exception $e) {
            // Errore generico
            return [$e->getMessage(), 'error'];
        }
    }

    public function inserisciUser($request)
    {
        try {
            User::create($request->all());
            return ['Operatore Inserito Correttamente!', 'success'];
        } catch (QueryException $e) {
            // Errore specifico legato al database
            if ($e->getCode() == 23000) { // Violazione dei vincoli (es. unique)
                if (!$request->name){
                    return ['Nome Obbligatorio - inserimento non effettuato', 'error'];
                } elseif (!$request->email){
                    return ['Email Obbligatoria - inserimento non effettuato', 'error'];
                }elseif (!$request->password){
                    return ['Password Obbligatoria - inserimento non effettuato', 'error'];
                }
                return ['email già presente - inserimento non effettuato', 'error'];
            }
            return [$e->getMessage(), 'error'];
        } catch (\Exception $e) {
            // Errore generico
            return [$e->getMessage(), 'error'];
        }
    }

    public function associaOperatoreOresettimanali($request)
    {
        try {
            $user = User::findOrFail($request->user_id);
            $user->oresettimanali = $request->oresettimanali;
            $user->save();
            return ['Associazione Inserita Correttamente!', 'success'];
        } catch (QueryException $e) {
            // Errore specifico legato al database
            if ($e->getCode() == 23000) { // Violazione dei vincoli (es. unique)
                if (!$request->user_id){
                    return ['Operatore Obbligatorio - Associazione non effettuata', 'error'];
                } elseif (!$request->oresettimanali){
                    return ['Ore Obbligatorie - Associazione non effettuata', 'error'];
                }
                return ['errore - Associazione non effettuata', 'error'];
            }
            return [$e->getMessage(), 'error'];
        }
    }
}
