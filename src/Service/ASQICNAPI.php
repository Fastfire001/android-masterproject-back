<?php

namespace App\Service;

use Exception;
use Symfony\Component\HttpClient\HttpClient;
use Symfony\Contracts\HttpClient\Exception\ClientExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\RedirectionExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\ServerExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface;

class ASQICNAPI {

    private const API_KEY = '79c79e7f80b7fecaf745d71a69aa145b9d790043';

    private const API_ENDPOINT = 'https://api.waqi.info';

    /**
     * @param string $route
     * @param array $params
     * format url with $route, API_ENDPOINT and API_KEY
     * @return string
     */
    private function createUrl(string $route, array $params = [])
    {
        $url = self::API_ENDPOINT . $route . '/?token=' . self::API_KEY;
        foreach ($params as $key => $value) {
            $url .= "&$key=$value";
        }
        return $url;
    }

    /**
     * @param float $lat1
     * @param float $lng1
     * @param float $lat2
     * @param float $lng2
     * @return mixed
     * @throws ClientExceptionInterface
     * @throws RedirectionExceptionInterface
     * @throws ServerExceptionInterface
     * Make a request to /map/bounds
     */
    public function mapBound(float $lat1, float $lng1, float $lat2, float $lng2)
    {
        $httpClient = HttpClient::create();
        try {
            $response = $httpClient->request('GET', $this->createUrl('/map/bounds', ['latlng' => "$lat1,$lng1,$lat2,$lng2"]));
            try {
                return json_decode($response->getContent(), true);
            } catch (Exception $e) {
                var_dump($e);
            }
        } catch (TransportExceptionInterface $e) {
            var_dump($e);
        }
    }

    /**
     * @param string $keyword
     * @return mixed
     * @throws ClientExceptionInterface
     * @throws RedirectionExceptionInterface
     * @throws ServerExceptionInterface
     * Make a request to /search
     */
    public function search(string $keyword)
    {
        $httpClient = HttpClient::create();
        try {
            $response = $httpClient->request('GET', $this->createUrl('/search', ['keyword' => $keyword]));
            try {
                return json_decode($response->getContent(), true);
            } catch (Exception $e) {
                var_dump($e);
            }
        } catch (TransportExceptionInterface $e) {
            var_dump($e);
        }
    }

    /**
     * @param string $id
     * @return mixed
     * @throws ClientExceptionInterface
     * @throws RedirectionExceptionInterface
     * @throws ServerExceptionInterface
     * Make a request to /feed/:id
     */
    public function getStationFeed(string $id)
    {
        $httpClient = HttpClient::create();
        try {
            $response = $httpClient->request('GET', $this->createUrl("/feed/@$id"));
            try {
                return json_decode($response->getContent(), true);
            } catch (Exception $e) {
                var_dump($e);
            }
        } catch (TransportExceptionInterface $e) {
            var_dump($e);
        }
    }
}
