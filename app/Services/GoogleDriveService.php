<?php

namespace App\Services;

use Google\Client;
use Google\Service\Drive;
use Google\Service\Drive\DriveFile;
use Google\Service\Sheets;
use Google\Service\Sheets\ValueRange;
use Google\Service\Sheets\Request;
use Google\Service\Sheets\TextFormat;
use Google\Service\Sheets\Color;
use Google\Service\Sheets\BatchUpdateSpreadsheetRequest;


class GoogleDriveService
{
    protected $client;
    protected $driveService;
    protected $sheetsService;

    public function __construct()
    {
        $this->client = new Client();
        $this->client->setAuthConfig(storage_path('app/google/credentials.json'));
        $this->client->addScope([Drive::DRIVE, Drive::DRIVE_FILE, Sheets::SPREADSHEETS]);

        $this->driveService = new Drive($this->client);
        $this->sheetsService = new Sheets($this->client);
    }

    public function createSheet($title = 'New Google Sheet')
    {
        $folderId = '1qEOLPHK6M-MMx0JEbGcZk5sgD2cBt0-y'; // Sostituisci con l'ID della cartella nel tuo Drive

        $fileMetadata = new DriveFile([
            'name' => $title,
            'mimeType' => 'application/vnd.google-apps.spreadsheet',
            'parents' => [$folderId]
        ]);

        $file = $this->driveService->files->create($fileMetadata, [
            'fields' => 'id'
        ]);

        $spreadsheetId = $file->id;

        // Scrittura dell'intestazione
        $range = 'Sheet1!A1:N1';
        $values = [
            ['id','Ragazzo', 'Gennaio', 'Febbraio', 'Marzo', 'Aprile', 'Maggio', 'Giugno', 'Luglio', 'Agosto', 'Settembre', 'Ottobre', 'Novembre', 'Dicembre'], // Intestazioni
        ];

        $body = new ValueRange([
            'values' => $values
        ]);

        $params = [
            'valueInputOption' => 'RAW'
        ];

        $this->sheetsService->spreadsheets_values->update(
            $spreadsheetId,
            $range,
            $body,
            $params
        );

        // Applicare formattazione (sfondo celeste + grassetto)
        $requests = [
            new Request([
                'repeatCell' => [
                    'range' => [
                        'sheetId' => 0, //  ID del primo foglio (di solito  0)
                        'startRowIndex' => 0, // Prima riga (A1:M1)
                        'endRowIndex' => 1, // Solo la prima riga
                        'startColumnIndex' => 0,
                        'endColumnIndex' => 14 // Colonne A-N (0-13)
                    ],
                    'cell' => [
                        'userEnteredFormat' => [
                            'backgroundColor' => new Color([
                                'red' => 173 / 255, // Light blue
                                'green' => 216 / 255,
                                'blue' => 230 / 255
                            ]),
                            'textFormat' => new TextFormat([
                                'bold' => true
                            ])
                        ]
                    ],
                    'fields' => 'userEnteredFormat(backgroundColor,textFormat)'
                ]
            ])
        ];

        $batchUpdateRequest = new BatchUpdateSpreadsheetRequest([
            'requests' => $requests
        ]);

        $this->sheetsService->spreadsheets->batchUpdate($spreadsheetId, $batchUpdateRequest);


        return $file->id; // Restituisce l'ID del file creato
    }

    public function writeToSheet($request)
    {
        //dd($request);
        $spreadsheetId = env('SHEET_ID');
        $range = $request->range; // Cambia il range in base alle esigenze
        $values = [
            $request->values,
        ];

        $body = new ValueRange([
            'values' => $values
        ]);

        $params = [
            'valueInputOption' => 'RAW'
        ];

        $this->sheetsService->spreadsheets_values->update(
            $spreadsheetId,
            $range,
            $body,
            $params
        );

        // Aggiungi la formattazione per centrare i valori
        $this->centerAlignCells($spreadsheetId, $range);
    }

    private function centerAlignCells($spreadsheetId, $range)
    {
        // Imposta la formattazione delle celle per centrare il contenuto
        $requests = [
            new \Google_Service_Sheets_Request([
                'repeatCell' => [
                    'range' => [
                        'sheetId' => 0, // ID del foglio (Sheet1 è normalmente 0, altrimenti devi usare l'ID corretto)
                        'startRowIndex' => 0,
                        'endRowIndex' => 20, // Puoi modificare questo valore in base alla quantità di righe che desideri formattare
                        'startColumnIndex' => 0,
                        'endColumnIndex' => 14, // Modifica anche questo per adattarlo alle colonne del tuo range
                    ],
                    'cell' => [
                        'userEnteredFormat' => [
                            'horizontalAlignment' => 'CENTER', // Allineamento orizzontale
                            'verticalAlignment' => 'MIDDLE'   // Allineamento verticale
                        ]
                    ],
                    'fields' => 'userEnteredFormat(horizontalAlignment,verticalAlignment)'
                ]
            ])
        ];

        $batchUpdateRequest = new \Google_Service_Sheets_BatchUpdateSpreadsheetRequest([
            'requests' => $requests
        ]);

        $this->sheetsService->spreadsheets->batchUpdate($spreadsheetId, $batchUpdateRequest);
    }

    public function readSheet($spreadsheetId, $range = 'Sheet1!A:N')
    {
        try {
            $response = $this->sheetsService->spreadsheets_values->get($spreadsheetId, $range);
            $values = $response->getValues();

            if (empty($values)) {
                return ['message' => 'Nessun dato trovato nel foglio.'];
            }

            // Converti i dati in un array associativo (id => nome)
            $data = [];
            foreach (array_slice($values, 1) as $row) {
                    $data[] = [
                        $row[0],
                        $row[1],
                        $row[2],
                        $row[3],
                        $row[4],
                        $row[5],
                        $row[6],
                        $row[7],
                        $row[8],
                        $row[9],
                        $row[10],
                        $row[11],
                        $row[12],
                        $row[13],
                    ];
            }

            return $data;
        } catch (\Exception $e) {
            return ['error' => $e->getMessage()];
        }
    }
}
