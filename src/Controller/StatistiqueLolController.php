<?php

namespace App\Controller;

use App\LeagueOfLegendApi;
use Exception;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class StatistiqueLolController extends AbstractController
{
    /**
     * @Route("/", name="index")
     */
    public function index()
    {
        $champions = LeagueOfLegendApi::getAllChampions();
        return $this->render('statistique/index.html.twig', compact('champions'));
    }

    /**
     * @Route("/champion/{id}", name="champion")
     */
    public function showChampion(int $id)
    {

        $champion = LeagueOfLegendApi::getChampion($id);

        if (!$champion) return $this->render('statistique/champion_not_found.html.twig');

        return $this->render('statistique/champion.html.twig', compact('champion'));

    }


    /**
     * @Route("/free-champions", name="free_champion")
     */
    public function showFreeChampions()
    {
        try {
            $freeChampions = LeagueOfLegendApi::getChampionRotation();
        } catch (Exception $e){
            return $this->render('layout/error.html.twig', [
                'message' =>$e->getMessage(),
            ]);
        }

        return $this->render('statistique/index.html.twig', [
            'champions' => $freeChampions,
        ]);

    }


    /**
     * @Route("/summoner/{name?}", name="summoner")
     * @param null $name
     * @return Response
     */
    public function summoner($name = null)
    {
        return $this->render('statistique/search_summoner.html.twig', compact('name'));
    }

    /**
     * @Route("/summoner-data/{name}", name="summoner-data")
     * @param null $name
     * @return Response
     */
    public function summonerData($name = null)
    {
        $summoner = LeagueOfLegendApi::getSummoner($name);

        return $this->json([
            'view' => $this->render('statistique/summoner.html.twig', compact('summoner'))->getContent()
        ]);
    }


    /**
     * @Route("/user", name="user")
     * @return Response
     */
    public function user()
    {
        return $this->render('statistique/user.html.twig');
    }


}
