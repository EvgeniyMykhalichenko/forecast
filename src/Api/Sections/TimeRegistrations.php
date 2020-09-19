<?php


namespace Krepysh\Forecast\Api\Sections;


use Krepysh\Forecast\Api\Forecast;
use Illuminate\Support\Collection;
use GuzzleHttp\Exception\GuzzleException;

/**
 * Class TimeRegistrations
 * @package Krepysh\Forecast\Api\Sections
 */
class TimeRegistrations extends Forecast
{

    /**
     * Change api version
     *
     * @var string
     */
    protected static $apiVersion = self::API_VERSION_V3;


    /**
     * Get all time registrations
     *
     * @return Collection|null
     * @throws GuzzleException
     * @link: https://github.com/Forecast-it/API/blob/master/sections/time_registrations.md#get-time-registrations
     */
    public function all(): ?Collection
    {
        return $this->_prepareResponseData(
            $this->http->get("time_registrations")
        );
    }

    /**
     * Get all time registrations in a project
     *
     * @param int $projectID
     * @return Collection|null
     * @throws GuzzleException
     * @link: https://github.com/Forecast-it/API/blob/master/sections/time_registrations.md#get-all-time-registrations-in-a-project
     */
    public function getByProject(int $projectID): ?Collection
    {
        return $this->_prepareResponseData(
            $this->http->get("projects/{$projectID}/time_registrations")
        );
    }

}
