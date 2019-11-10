<?php

namespace Squareboat\Sheets;

use Google_Service_Sheets;

class Service
{
    private $client;
    private $service;

    public function make()
    {
        $this->initializeClient();
        $this->initializeService();

        return $this->service;
    }

    private function initializeClient()
    {
        $this->client = (new Client())->make();
    }

    private function initializeService()
    {
        $this->service = new Google_Service_Sheets($this->client);
    }
}