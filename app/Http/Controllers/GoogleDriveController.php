<?php

namespace App\Http\Controllers;

use App\Services\GoogleDriveService;
use Illuminate\Http\Request;

class GoogleDriveController extends Controller
{
    protected $googleDriveService;

    public function __construct(GoogleDriveService $googleDriveService)
    {
        $this->googleDriveService = $googleDriveService;
    }

    public function createSheet()
    {
        $sheetId = $this->googleDriveService->createSheet('My Laravel Sheet');
        return response()->json(['message' => 'Google Sheet created!', 'sheet_id' => $sheetId]);
    }

    public function writeToSheet()
    {
        $result = $this->googleDriveService->writeToSheet();
        return response()->json(['message' => $result]);
    }
}
