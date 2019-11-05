<?php


namespace App\Service;


use Exception;
use Symfony\Component\HttpClient\HttpClient;
use Symfony\Contracts\HttpClient\Exception\ClientExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\RedirectionExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\ServerExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface;

class Waki
{

    /**
     * @return array
     * @throws ClientExceptionInterface
     * @throws RedirectionExceptionInterface
     * @throws ServerExceptionInterface
     */
    private function getAllIndexPollution()
    {
        $url = 'https://waqi.info/rtdata/ranking/index.json';
        $httpClient = HttpClient::create();
        try {
            $response = $httpClient->request('GET', $url);
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
     * @param string $country
     * @return string|null
     * @throws ClientExceptionInterface
     * @throws RedirectionExceptionInterface
     * @throws ServerExceptionInterface
     */
    public function getIndexPollutionByCountry(string $country)
    {
        $allIndex = $this->getAllIndexPollution();
        foreach ($allIndex['cities'] as $city) {
            if (strtolower($city['country']) === strtolower($country)) {
                return $city['station']['a'];
            }
        }
        return null;
    }

}