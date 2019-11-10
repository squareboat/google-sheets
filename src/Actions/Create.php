<?php

namespace Squareboat\Sheets\Actions;

use Squareboat\Sheets\Service;
use Google_Service_Sheets_Spreadsheet;

class Create
{
    public function __construct($service)
    {
        $this->service = $service;
    }

    public function handle(string $title)
    {
        $spreadsheet = new Google_Service_Sheets_Spreadsheet([
            'properties' => [
                'title' => $title,
            ]
        ]);

        $sheet = $this->service->spreadsheets->create($spreadsheet, [
            'fields' => 'spreadsheetId'
        ]);

        return $sheet->spreadsheetId;
    }
}