<?php


namespace App;


use Exception;
use Symfony\Component\HttpClient\HttpClient;

class LeagueOfLegendApi
{

    private static $apiKey = null;

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

    private static function callApi(string $url, string $method = "GET")
    {

        self::setUpApiKey();
        $client = HttpClient::create();
        $response = $client->request($method, $url);

        return $response;

    }

    public static function getChampionRotation()
    {
        $freeChampions = [];

        $freeChampionsId = self::callApi('https://euw1.api.riotgames.com/lol/platform/v3/champion-rotations' . '?api_key=' . self::$apiKey)
            ->toArray();

        $champions = self::getAllChampions();

        foreach ($champions as $champion) {
            if (in_array($champion['key'], $freeChampionsId['freeChampionIds'])) {
                array_push($freeChampions, $champion);
            }
        }

        return $freeChampions;
    }

    public static function getSummoner(string $summonerName)
    {
        try {
            $summoner = self::callApi('https://euw1.api.riotgames.com/lol/summoner/v4/summoners/by-name/' . $summonerName . '?api_key=' . self::$apiKey)
                ->toArray();
        } catch (Exception $e) {
            return null;
        }


        $summoner = self::callApi('https://euw1.api.riotgames.com/lol/league/v4/entries/by-summoner/' . $summoner['id'] . '?api_key=' . self::$apiKey)
            ->toArray();

        return $summoner;

    }

    private static function setUpApiKey()
    {
        if (self::$apiKey == null && !empty($_ENV['API_KEY'])) {
            self::$apiKey = $_ENV['API_KEY'];
        } else {
            throw new Exception('Error, you did not enter your Api Key in the env file');
        }
    }

}