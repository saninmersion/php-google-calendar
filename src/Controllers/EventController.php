<?php

namespace PhpGoogleCalendar\Controllers;

use Google\Service\Exception;
use Jenssegers\Blade\Blade;
use PhpGoogleCalendar\Services\EventManagerService;

class EventController
{
    protected Blade $blade;

    public function __construct()
    {
        $this->blade = new Blade('views/events', 'cache');
    }

    public function index(): void
    {
        $accessToken = $_SESSION['access_token'] ?? null;

        if (!$accessToken) {
            $this->redirectTo('/');
            return;
        }

        try {
            $eventManager = new EventManagerService($accessToken);
            $events = $eventManager->fetchEvents();

            if (empty($events)) {
                echo "No upcoming events found.";
            } else {
                echo $this->blade->make('list', ['events' => $events])->render();
            }
        } catch (\Exception $exception) {
            if ($exception->getCode() === 401) {
                $this->redirectTo('/');
            }
        }
    }

    /**
     * @throws Exception
     * @throws \Exception
     */
    public function store(): void
    {
        $accessToken = $_SESSION['access_token'] ?? null;

        if (!$accessToken) {
            $this->redirectTo('/');
            return;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $eventStartTime = convertDateTime($_POST['event_date'], $_POST['start_time']);
            $eventEndTime = convertDateTime($_POST['event_date'], $_POST['end_time']);

            $eventManager = new EventManagerService($accessToken);
            $eventManager->createEvent($_POST['title'], $eventStartTime, $eventEndTime, $_POST['timezone']);
        }

        $this->redirectTo('/events');
    }

    public function delete(): void
    {
        $accessToken = $_SESSION['access_token'] ?? null;

        if (!$accessToken) {
            $this->redirectTo('/');
            return;
        }

        try {
            $eventManager = new EventManagerService($accessToken);

            if (isset($_GET['id'])) {
                $eventId = $_GET['id'];
                $eventManager->deleteEvent($eventId);
            }

            $this->redirectTo('/events');
        } catch (\Exception $exception) {
            if ($exception->getCode() === 401) {
                $this->redirectTo('/');
            }
        }
    }

    private function redirectTo(string $url): void
    {
        header('Location: ' . $url);
        exit();
    }
}
