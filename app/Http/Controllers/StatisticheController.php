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

        $anno = $request->anno;
        $mese = $request->mese;
        $saldoOriginale = $request->saldoOriginale;
        $nuovoSaldo = $request->nuovoSaldo;
        $causaleMod = $request->causaleMod;
        $importoMod = $request->importoMod;
        $dataMod = $request->dataMod;

        $spreadsheetId = '1Kl489MrligUBKteaEDDtscSQqaMfFNs_g1VfFeZ7XGQ';
        //dd($spreadsheetId);
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
            if (count($tabellaGoogleSheet) == 0){
                $posizioneRiga = count($tabellaGoogleSheet) + 2;
            } else {
                $posizioneRiga = array_search(0, array_column($tabellaGoogleSheet, 0)) + 2;
            }
        }
        $posizioneMese = $mese + 1;
        $values[$posizioneMese] = $nuovoSaldo ?? $saldoOriginale;

        $request->merge([
            'range' => 'Sheet1!A'.$posizioneRiga.':N'.$posizioneRiga,
            'values' => $values
        ]);
//dd($request);
        // scrivi sulla tabella
        $googleDriveService->writeToSheet($request);

        // scrivi il totale dei mesi
        // leggo di nuovo i dati dalla tabella di google
        $tabellaGoogleSheetAggiornata = $googleDriveService->readSheet($spreadsheetId);

        // vedo se c'è la riga totale
        $posizioneTotale = array_search(0, array_column($tabellaGoogleSheetAggiornata, 0));
        if ($posizioneTotale !== false) {
            // la riga totale c'è
            $posizioneRigaFinale = $posizioneTotale + 2;
        } else {
            // la riga totale non c'è
            $posizioneRigaFinale = count($tabellaGoogleSheetAggiornata) + 2;
        }

        $totali = [0, 'TOTALE', 0,0,0,0,0,0,0,0,0,0,0,0];

     //   $sums = array_fill(2, 12, 0); // Inizializza un array con 0 per gli indici da 2 a 13

        foreach ($tabellaGoogleSheetAggiornata as $row) {
            for ($i = 2; $i <= 13; $i++) {
                $totali[$i] += (int) $row[$i]; // Converte in intero e somma
            }
        }

       // dd($totali);

        $request->merge([
            'range' => 'Sheet1!A'.$posizioneRigaFinale.':N'.$posizioneRigaFinale,
            'values' => $totali
        ]);
//dd($request);
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
