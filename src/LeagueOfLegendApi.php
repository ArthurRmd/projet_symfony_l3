<?php


namespace App;


use Symfony\Component\HttpClient\HttpClient;

class LeagueOfLegendApi
{


    /**
     *
     */
    public static function getChampion(int $id)
    {


        $champions = self::getAllChampions();

        foreach ($champions as $key => $champion) {
            if ($champions[$key]['key'] == $id) {
                return $champion;
            }
        }

        return null;

    }

    public function getAllChampions()
    {
        $response = self::callApi('http://ddragon.leagueoflegends.com/cdn/10.10.3208608/data/en_US/champion.json');

        return $response->getStatusCode() === 200 ? $response->toArray()['data'] : null;

    }

    private static function callApi(String $url, String $method = "GET")
    {

        $client = HttpClient::create();
        $response = $client->request($method, $url);

        return $response;

    }

}