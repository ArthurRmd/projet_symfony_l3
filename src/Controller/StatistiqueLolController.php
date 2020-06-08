<?php

namespace App\Controller;

use App\LeagueOfLegendApi;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class StatistiqueLolController extends AbstractController
{
    /**
     * @Route("/", name="index")
     */
    public function index()
    {

        $champions = LeagueOfLegendApi::getAllChampions();

        return $this->render('statistique/index.html.twig', [
            'champions' => $champions,
        ]);
    }

    /**
     * @Route("/champion/{id}", name="champion")
     */
    public function showChampion(int $id)
    {

        $champion = LeagueOfLegendApi::getChampion($id);

        return $this->render('statistique/champion.html.twig', [
            'champion' => $champion,
        ]);

    }


}
