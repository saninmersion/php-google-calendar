<?php

namespace PhpGoogleCalendar\Controllers;

use Jenssegers\Blade\Blade;
use PhpGoogleCalendar\Services\GoogleClient;

class HomeController
{
    protected $blade;
    protected $client;

    public function __construct()
    {
        $this->blade = new Blade('views', 'cache');

        $googleClient = new GoogleClient();
        $this->client = $googleClient->getClient();
    }

    public function index()
    {
        if ( isset($_SESSION['access_token']) && $_SESSION['access_token'] ) {
            header('Location: /events');
        };

        if ( !isset($_GET['code']) ) {
            $authUrl = $this->client->createAuthUrl();

            echo $this->blade->make('home', ['url' => $authUrl])->render();

        }
        else {
            $this->client->fetchAccessTokenWithAuthCode($_GET['code']);
            $_SESSION['access_token'] = $this->client->getAccessToken();

            header('Location: /events');
        }
    }

    public function logout()
    {
        session_destroy();

        header('Location: /');
    }
}
