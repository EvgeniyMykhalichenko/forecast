<?php


namespace Krepysh\Forecast\Api\Sections;


use GuzzleHttp\Exception\GuzzleException;
use Krepysh\Forecast\Api\Forecast;
use Illuminate\Support\Collection;

/**
 * Class Projects
 *
 * @package Krepysh\Forecast\Api\Sections
 */
class Projects extends Forecast
{
    /**
     * Get all projects
     *
     * @return Collection|null
     * @throws GuzzleException
     * @link https://github.com/Forecast-it/API/blob/master/sections/projects.md#get-projects
     */
    public function getAll(): ?Collection
    {
        return $this->_prepareResponseData(
            $this->http->get('projects')
        );
    }

    public function get(int $projectID)
    {

    }
}
