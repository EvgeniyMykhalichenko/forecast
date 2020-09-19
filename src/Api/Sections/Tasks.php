<?php


namespace Krepysh\Forecast\Api\Sections;


use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Support\Collection;
use Krepysh\Forecast\Api\Forecast;

/**
 * Class Tasks
 *
 * @package Krepysh\Forecast\Api\Sections
 */
class Tasks extends Forecast
{
    /**
     * Change api version
     *
     * @var string
     */
    protected static $apiVersion = self::API_VERSION_V2;

    /**
     * Returns all tasks of the project.
     *
     * @param int $projectID
     * @return Collection|null
     * @throws GuzzleException
     * @link https://github.com/Forecast-it/API/blob/master/sections/tasks.md#get-tasks-in-project
     */
    public function getByProject(int $projectID): ?Collection
    {
        return $this->_prepareResponseData(
            $this->http->get("projects/{$projectID}/tasks")
        );
    }
}
