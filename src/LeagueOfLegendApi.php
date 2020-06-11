<?php


namespace App;


use Symfony\Component\HttpClient\HttpClient;

class LeagueOfLegendApi
{

    private static $apiKey = 'RGAPI-81da2ccf-647a-4ac8-859f-708c50a704d1';

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

    public static function getAllChampions()
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

    public static function getChampionRotation()
    {
        $freeChampions = [];

        $freeChampionsId = self::callApi('https://euw1.api.riotgames.com/lol/platform/v3/champion-rotations' . '?api_key=' . self::$apiKey   )
            ->toArray();

        $champions = self::getAllChampions();

        foreach( $champions as $champion ) {
            if (in_array($champion['key'], $freeChampionsId['freeChampionIds'])) {
                array_push($freeChampions, $champion);
            }
        }

        return $freeChampions;
    }

    public static function getSummoner(String $summonerName)
    {
        $summoner = self::callApi( 'https://euw1.api.riotgames.com/lol/summoner/v4/summoners/by-name/'. $summonerName . '?api_key=' . self::$apiKey  )
            ->toArray();


        $summoner = self::callApi( 'https://euw1.api.riotgames.com/lol/league/v4/entries/by-summoner/' . $summoner['id'] . '?api_key=' . self::$apiKey  )
            ->toArray();

        return $summoner;

    }

}