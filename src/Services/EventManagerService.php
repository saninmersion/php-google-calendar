<?php

namespace PhpGoogleCalendar\Services;

use Google\Client;
use Google\Service\Calendar\Event;
use Google\Service\Exception;
use Google_Service_Calendar;
use Google_Service_Calendar_Event;

class EventManagerService
{
    protected Client                  $client;
    protected Google_Service_Calendar $service;

    /**
     * EventManagerService constructor.
     *
     * @param array $accessToken
     */
    public function __construct(array $accessToken)
    {
        $googleClient = new GoogleClientService();
        $this->client = $googleClient->getClient();
        $this->client->setAccessToken($accessToken['access_token']);

        $this->service = new Google_Service_Calendar($this->client);
    }

    /**
     * Fetch events from Google Calendar.
     *
     * @return array
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
                'eventDateTime' => $event->getEnd()['dateTime'],
            ];
        }

        return $formattedEvents;
    }

    /**
     * Create an event in Google Calendar.
     *
     * @param string $summary
     * @param string $start
     * @param string $end
     * @param string $timeZone
     *
     * @return Event
     * @throws Exception
     */
    public function createEvent(string $summary, string $start, string $end, string $timeZone): Event
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
     * Delete an event from Google Calendar.
     *
     * @param string $eventId
     *
     * @return void
     * @throws Exception
     */
    public function deleteEvent(string $eventId): void
    {
        $this->service->events->delete('primary', $eventId);
    }
}
