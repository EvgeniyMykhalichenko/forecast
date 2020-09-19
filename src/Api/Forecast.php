<?php


namespace Krepysh\Forecast\Api;


use GuzzleHttp\Client;
use Krepysh\Forecast\Api\Sections\Projects;
use Krepysh\Forecast\Api\Sections\Tasks;
use Krepysh\Forecast\Api\Sections\TimeRegistrations;
use Krepysh\Forecast\Exceptions\ForecastException;
use Psr\Http\Message\ResponseInterface;
use Illuminate\Support\Collection;

/**
 * Class Forecast
 *
 * The Forecast API is a complete programmable interface to all Forecast functionality.
 * This is a REST-style API that uses JSON for serialization and HTTP.
 *
 * @package Krepysh\Forecast\Api
 */
class Forecast
{
    /**
     * Base api url
     */
    private const BASE_API_URL            = 'https://api.forecast.it/api';

    /**
     * Api versions
     */
    protected const DEFAULT_API_VERSION   = 'v1';
    protected const API_VERSION_V2        = 'v2';
    protected const API_VERSION_V3        = 'v3';

    /**
     * Full api url
     *
     * @var string
     */
    protected  $_apiURL                   = null;

    /**
     * Default api version
     *
     * @var string
     */
    protected static $apiVersion          = self::DEFAULT_API_VERSION;

    /**
     * Guzzle Http Client
     *
     * @var Client
     */
    protected $http                       = null;

    /**
     * Forecast constructor.
     *
     * @throws ForecastException
     */
    public function __construct()
    {
        $apiKeyFromConfig     = config('forecast.api_key');

        $this->_prepareApiURL();
        $this->_prepareHttpClient($apiKeyFromConfig);
    }

    /**
     * @return Projects
     */
    public static function projects(): Projects
    {
        return new Projects();
    }

    /**
     * @return Tasks
     */
    public static function tasks(): Tasks
    {
        return new Tasks();
    }

    /**
     * @return TimeRegistrations
     */
    public static function timeRegistration(): TimeRegistrations
    {
        return new TimeRegistrations();
    }

    /**
     * Set api url
     */
    private function _setApiURL(): void
    {
        $this->_apiURL = self::BASE_API_URL;
    }

    /**
     * Prepare Forecast api url
     */
    private function _prepareApiURL(): void
    {
        $this->_setApiURL();
        $this->_apiURL .= '/'. static::$apiVersion . '/';
    }

    /**
     * Prepare Guzzle http client width prams
     *
     * @param string $apiKey
     * @throws ForecastException
     */
    private function _prepareHttpClient(string $apiKey): void
    {
        if (empty($apiKey)) {
            throw new ForecastException(__('Forecast api key is empty'));
        }

        $this->http = new Client([
            'base_uri' => $this->_apiURL,
            'headers' => [
                'X-FORECAST-API-KEY' => $apiKey
            ]
        ]);
    }

    /**
     * Prepare Forecast response data
     *
     * @param ResponseInterface $response
     * @return Collection|null
     */
    protected function _prepareResponseData(ResponseInterface $response): ?Collection
    {
        $stream   = $response->getBody();
        $contents = $stream->getContents();

        return collect(json_decode($contents));
    }
}
