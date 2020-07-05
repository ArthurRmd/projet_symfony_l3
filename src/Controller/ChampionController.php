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
     *  Affiche tous les champions
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
     * Affiche un champion par son id
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
     *  Affiche les champions gratuit
     */
    public function showFreeChampions()
    {
        try {
            $champions = LeagueOfLegendApi::getChampionRotation();
        } catch (Exception $e){
            $message = $e->getMessage();
            return $this->render('layout/error.html.twig', compact('message'));
        }

        return $this->render('champion/index.html.twig', compact('champions'));
    }


}
