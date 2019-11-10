<?php

namespace Squareboat\Sheets\Actions;

use Google_Service_Sheets_ClearValuesRequest;

class Delete
{
    public function __construct($service)
    {
        $this->service = $service;
    }

    public function handle(string $sheetId)
    {
        $range = 'Sheet1';
        $requestBody = new Google_Service_Sheets_ClearValuesRequest();
        $this->service->spreadsheets_values->clear($sheetId, $range, $requestBody);
    }
}