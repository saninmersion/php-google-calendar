<?php

namespace PhpGoogleCalendar\Controllers;

use Google\Service\Exception;
use Jenssegers\Blade\Blade;
use PhpGoogleCalendar\Helpers\CommonHelper;
use PhpGoogleCalendar\Services\EventManagerService;

class EventController
{
    protected $blade;

    public function __construct()
    {
        $this->blade = new Blade('views/events', 'cache');
    }

    /**
     */
    public function index()
    {
        $accessToken = $_SESSION['access_token'];

        try {
            if ( isset($accessToken) && $accessToken ) {
                $eventManager = new EventManagerService($accessToken);
                $events       = $eventManager->fetchEvents();

                if ( empty($events) ) {
                    echo "No upcoming events found.";
                }
                else {
                    echo $this->blade->make('list', ['events' => $events])->render();
                }
            }
            else {
                header('Location: /');
            }
        } catch (\Exception $exception) {
            if ( $exception->getCode() === 401 ) {
                header('Location: /');
            }
        }
    }

    /**
     * @throws Exception
     */
    public function store()
    {
        $eventStartTime = convertDateTime($_POST['event_date'], $_POST['start_time']);
        $eventEndTime   = convertDateTime($_POST['event_date'], $_POST['end_time']);

        $accessToken = $_SESSION['access_token'];

        if ( isset($accessToken) && $accessToken ) {
            if ( $_SERVER['REQUEST_METHOD'] === 'POST' ) {
                $eventManager = new EventManagerService($accessToken);
                $eventManager->createEvent($_POST['title'], $eventStartTime, $eventEndTime, $_POST['timezone']);
            }
            header('Location: /events');
        }
        else {
            header('Location: /');
        }
    }

    public function delete()
    {
        $accessToken = $_SESSION['access_token'];

        try {
            if ( isset($accessToken) && $accessToken ) {
                $eventManager = new EventManagerService($accessToken);

                if ( isset($_GET['id']) ) {
                    $eventId = $_GET['id'];

                    $eventManager->deleteEvent($eventId);

                }
                header('Location: /events');
            }
            else {
                header('Location: /');
            }
        } catch (\Exception $exception) {
            if ( $exception->getCode() === 401 ) {
                header('Location: /');
            }
        }
    }
}
