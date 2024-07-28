<?php

namespace PhpGoogleCalendar\Services;

use Google\Client;
use Google\Exception;
use Google_Service_Calendar;

class GoogleClientService
{
    private Client $client;

    /**
     * GoogleClientService constructor.
     * @throws Exception
     */
    public function __construct() {
        $this->client = new Client();

        $this->client->setAuthConfig(__DIR__ . '/../../config/credentials.json');
        $this->client->setScopes(Google_Service_Calendar::CALENDAR);
        $this->client->setAccessType('offline');
        $this->client->setPrompt('select_account consent');
    }

    /**
     * Get the Google client instance.
     *
     * @return Client
     */
    public function getClient(): Client
    {
        return $this->client;
    }
}
