<?php

namespace PhpGoogleCalendar\Controllers;

use Google\Client;
use Jenssegers\Blade\Blade;
use PhpGoogleCalendar\Services\GoogleClientService;

class HomeController
{
    protected Blade  $blade;
    protected Client $client;

    public function __construct()
    {
        $this->blade = new Blade('views', 'cache');

        $googleClient = new GoogleClientService();
        $this->client = $googleClient->getClient();
    }

    public function index()
    {
        if ( isset($_SESSION['access_token']) && $_SESSION['access_token'] ) {
            redirectTo('/events');
        };

        if ( !isset($_GET['code']) ) {
            $authUrl = $this->client->createAuthUrl();

            echo $this->blade->make('home', ['url' => $authUrl])->render();

        }
        else {
            $this->client->fetchAccessTokenWithAuthCode($_GET['code']);
            $_SESSION['access_token'] = $this->client->getAccessToken();

            redirectTo('/events');
        }
    }

    public function logout()
    {
        session_destroy();

        redirectTo('/');
    }
}
