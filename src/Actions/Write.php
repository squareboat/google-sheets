<?php

namespace Squareboat\Sheets\Actions;

use Google_Service_Sheets_ValueRange;

class Write
{
    public function __construct($service)
    {
        $this->service = $service;
    }

    public function handle($sheetId, array $values)
    {
        $range = 'Sheet1!A1';
        $body = new Google_Service_Sheets_ValueRange(array(
            'values' => $values
        ));

        $params = array(
            'valueInputOption' => 'RAW'
        );

        $this->service->spreadsheets_values->append($sheetId, $range, $body, $params);
    }
}