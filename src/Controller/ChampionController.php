<?php

namespace App\Controller;

use App\LeagueOfLegendApi;
use Exception;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ChampionController extends AbstractController
{

    /**
     * @Route("/", name="index")
     */
    public function index()
    {
        $champions = LeagueOfLegendApi::getAllChampions();
        return $this->render('champion/index.html.twig', compact('champions'));
    }

    /**
     * @Route("/champion/{id}", name="champion")
     * @param int $id
     * @return Response
     */
    public function showChampion(int $id)
    {
        $champion = LeagueOfLegendApi::getChampion($id);

        return (!$champion)
            ? $this->render('champion/champion_not_found.html.twig')
            : $this->render('champion/champion.html.twig', compact('champion'));
    }

    /**
     * @Route("/free-champions", name="free-champion")
     */
    public function showFreeChampions()
    {
        try {
            $champions = LeagueOfLegendApi::getChampionRotation();
        } catch (Exception $e){
            return $this->errorPage($e->getMessage());
        }

        return $this->render('champion/index.html.twig', compact('champions'));
    }


    private function errorPage($message = ""){
        return $this->render('layout/error.html.twig', [
            'message' => $message,
        ]);
    }
}
