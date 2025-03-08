<?php

namespace App\Http\Controllers;

use App\Services\GoogleDriveService;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class StatisticheController extends Controller
{
    public function presenzeClienti()
    {
        return view('pages.statistiche.presenzeClienti', [
            'title' => 'Statistiche Presenze Clienti'
        ]);
    }

    public function presenzeOperatori()
    {
        return view('pages.statistiche.presenzeOperatori', [
            'title' => 'Statistiche Presenze Operatori'
        ]);
    }

    public function chilometriVetture()
    {
        return view('pages.statistiche.chilometriVetture', [
            'title' => 'Statistiche Chilometri Vetture'
        ]);
    }

    public function chilometriClienti()
    {
        return view('pages.statistiche.chilometriClienti', [
            'title' => 'Statistiche Chilometri Clienti'
        ]);
    }

    public function stampaPresenzeClienti(GoogleDriveService $googleDriveService, Request $request)
    {
        $ragazzoConPresenzeAttivita = json_decode($request->input('ragazzoConPresenzeAttivita'), true);
//dd($ragazzoConPresenzeAttivita);
        $anno = $request->anno;
        $mese = $request->mese;
        $saldoOriginale = $request->saldoOriginale;
        $nuovoSaldo = $request->nuovoSaldo;
        $causaleMod = $request->causaleMod;
        $importoMod = $request->importoMod;
        $dataMod = $request->dataMod;

        //$googleDriveService->writeToSheet();
        $spreadsheetId = env('SHEET_ID');
        $idRagazzo = $ragazzoConPresenzeAttivita['id'];
        $nomeRagazzo = $ragazzoConPresenzeAttivita['name'];

        // leggo i dati dalla tabella di google
        $tabellaGoogleSheet = $googleDriveService->readSheet($spreadsheetId);
//dd($tabellaGoogleSheet);
        $request->merge([
            'idRagazzo' => $idRagazzo,
            'nomeRagazzo' => $nomeRagazzo
        ]);

        $chiave = array_search($idRagazzo, array_column($tabellaGoogleSheet, 0));
        $values = [$idRagazzo, $nomeRagazzo, 0,0,0,0,0,0,0,0,0,0,0,0];

        if ($chiave !== false) {
            /*echo "L'ID $idCercato è presente nell'array alla posizione $chiave."; */
            $posizioneRiga = $chiave + 2;
            $values = $tabellaGoogleSheet[$chiave];
        } else {
            /*echo "L'ID $idCercato non è presente nell'array. quindi lo metto in fondo alla tabella";*/
            $posizioneRiga = count($tabellaGoogleSheet) + 2;

        }
        $posizioneMese = $mese + 1;
        $values[$posizioneMese] = $nuovoSaldo ?? $saldoOriginale;

        $request->merge([
            'range' => 'Sheet1!A'.$posizioneRiga.':N'.$posizioneRiga,
            'values' => $values
        ]);

        // scrivi sulla tabella
        $googleDriveService->writeToSheet($request);


        $pdf =Pdf::loadHTML(view('pages.statistiche.stampaPresenzeClienti', compact('ragazzoConPresenzeAttivita',
            'anno', 'mese', 'saldoOriginale', 'nuovoSaldo',
            'causaleMod', 'importoMod', 'dataMod')));
        return $pdf->download($ragazzoConPresenzeAttivita['name']."-".$mese."-".$anno.".pdf");

        /*return view('pages.statistiche.stampaPresenzeClienti',
            compact('ragazzoConPresenzeAttivita', 'anno', 'mese', 'saldoOriginale', 'nuovoSaldo',
                'causaleMod', 'importoMod', 'dataMod'));*/

    }
}
