<?php

namespace Squareboat\Sheets;

use Google_Client;
use Google_Auth_AssertionCredentials;

class Client
{
    private $client;

    public function __construct()
    {
        $this->client = new Google_Client();
    }

    private function init()
    {
        $this->client->setApplicationName(config('sheets.application_name'));
        $this->client->setScopes(config('sheets.scopes.available.'.config('sheets.scopes.used')));
        $this->client->setAuthConfig(config('sheets.credentials_file'));
        $this->client->setAccessType(config('sheets.access_type'));
        // $this->client->setApprovalPrompt('auto');
        // $this->client->setClientId('113479759713184980206');
        // $this->client->setIncludeGrantedScopes(true);
        // $this->client->setPrompt(config('settings.prompt'));
    }

    private function getAccessToken()
    {
        $client = $this->client;
        $tokenPath = config('sheets.token_file');
        if (file_exists($tokenPath)) {
            $accessToken = json_decode(file_get_contents($tokenPath), true);
            $client->setAccessToken($accessToken);
        }

        // If there is no previous token or it's expired.
        if ($client->isAccessTokenExpired()) {
            // Refresh the token if possible, else fetch a new one.
            if ($client->getRefreshToken()) {
                $client->fetchAccessTokenWithRefreshToken($client->getRefreshToken());
            } else {
                $cred = new Google_Auth_AssertionCredentials(
                    'yts-710@youth-tech-scholarship.iam.gserviceaccount.com',
                    array('https://spreadsheets.google.com/feeds'),
                    file_get_contents('/users/vinayaksarawagi/Desktop/youth-tech-scholarship-682982dbc4e8.p12')
                );
            
                $client->setAssertionCredentials($cred);
                if ($client->getAuth()->isAccessTokenExpired()) {
                    $client->getAuth()->refreshTokenWithAssertion($cred);
                }
            
                $authCode = json_decode($client->getAccessToken());

                // // Request authorization from the user.
                // $authUrl = $client->createAuthUrl();
                // printf("Open the following link in your browser:\n%s\n", $authUrl);
                // print 'Enter verification code: ';
                // $authCode = trim(fgets(STDIN));

                // Exchange authorization code for an access token.
                $accessToken = $client->fetchAccessTokenWithAuthCode($authCode);
                $client->setAccessToken($accessToken);

                // Check to see if there was an error.
                if (array_key_exists('error', $accessToken)) {
                    throw new Exception(join(', ', $accessToken));
                }
            }
            // Save the token to a file.
            if (!file_exists(dirname($tokenPath))) {
                mkdir(dirname($tokenPath), 0700, true);
            }

            file_put_contents($tokenPath, json_encode($client->getAccessToken()));
        }

        $this->client = $client;
    }

    public function make()
    {
        $this->init();
        // $this->getAccessToken();

        return $this->client;
    }
}