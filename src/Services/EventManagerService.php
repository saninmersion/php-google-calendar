<?php

namespace PhpGoogleCalendar\Services;

use Google\Service\Calendar\Event;
use Google\Service\Exception;
use Google_Service_Calendar;
use Google_Service_Calendar_Event;

class EventManagerService
{
    protected \Google\Client          $client;
    protected Google_Service_Calendar $service;

    public function __construct($accessToken)
    {
        $googleClient = new GoogleClient();
        $this->client = $googleClient->getClient();
        $this->client->setAccessToken($accessToken['access_token']);

        $this->service = new Google_Service_Calendar($this->client);
    }

    /**
     * @throws Exception
     */
    public function fetchEvents(): array
    {
        $params = [
            'orderBy'      => 'startTime',
            'singleEvents' => true,
            'timeMin'      => date('c'),
        ];

        $events          = $this->service->events->listEvents('primary', $params);
        $formattedEvents = [];

        foreach ($events as $event) {

            $formattedEvents[] = [
                'id'            => $event->getId(),
                'summary'       => $event->getSummary(),
                'description'   => $event->getDescription(),
                'eventDateTime' => $event->getEnd()['dateTime']
            ];
        }

        return $formattedEvents;
    }

    /**
     * @throws Exception
     */
    public function createEvent($summary, $start, $end, $timeZone): Event
    {
        $event = new Google_Service_Calendar_Event([
            'summary' => $summary,
            'start'   => [
                'dateTime' => $start,
                'timeZone' => $timeZone,
            ],
            'end'     => [
                'dateTime' => $end,
                'timeZone' => $timeZone,
            ],
        ]);

        return $this->service->events->insert('primary', $event);
    }

    /**
     * @throws Exception
     */
    public function deleteEvent($eventId)
    {
        return $this->service->events->delete('primary', $eventId);
    }
}
