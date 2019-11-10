<?php

return [
    'application_name' => '',
    'access_type' => 'offline',
    'credentials_file' => storage_path(''),
    
    'scopes' => [
        'available' => [
            'sheets_write' => Google_Service_Sheets::SPREADSHEETS,
            'sheets_read' => Google_Service_Sheets::SPREADSHEETS_READONLY,
        ],

        'used' => 'sheets_write'    
    ]
];