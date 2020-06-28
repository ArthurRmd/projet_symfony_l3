<?php


namespace App;


use Exception;
use Symfony\Component\HttpClient\HttpClient;

class LeagueOfLegendApi
{

    private static $apiKey = null;


    /***********************************
     *         Private function
     **********************************/

    private static function callApi(string $url, string $method = "GET")
    {

        $client = HttpClient::create();
        $response = $client->request($method, $url);

        return $response;

    }

    private static function setUpApiKey()
    {
        if (self::$apiKey == null && !empty($_ENV['API_KEY'])) {
            self::$apiKey = $_ENV['API_KEY'];
        } else if(self::$apiKey == null && empty($_ENV['API_KEY'])) {
            throw new Exception('Error, you did not enter your Api Key in the env file');
        }
    }


    /***********************************
     *         Public function
     **********************************/

    /**
     * @param int $id
     * @return array|null
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
        self::setUpApiKey();
        $response = self::callApi('http://ddragon.leagueoflegends.com/cdn/10.10.3208608/data/en_US/champion.json');

        return $response->getStatusCode() === 200 ? $response->toArray()['data'] : null;

    }



    public static function getChampionRotation()
    {
        self::setUpApiKey();
        $freeChampionsId = self::callApi('https://euw1.api.riotgames.com/lol/platform/v3/champion-rotations?api_key=' . self::$apiKey)
            ->toArray();

        $champions = self::getAllChampions();

        $freeChampions = [];

        foreach ($champions as $champion) {
            if (in_array($champion['key'], $freeChampionsId['freeChampionIds'])) {
                array_push($freeChampions, $champion);
            }
        }

        return $freeChampions;

    }


    public static function getSummoner(string $summonerName = "")
    {
        self::setUpApiKey();
        try {
            $summoner = self::callApi('https://euw1.api.riotgames.com/lol/summoner/v4/summoners/by-name/' . $summonerName . '?api_key=' . self::$apiKey)
                ->toArray();
        } catch (Exception $e) {
            return null;
        }


        $summoner = self::callApi('https://euw1.api.riotgames.com/lol/league/v4/entries/by-summoner/' . $summoner['id'] . '?api_key=' . self::$apiKey)
            ->toArray();

        if(empty($summoner)) return null;

        return $summoner;

    }



}