<?php

namespace App\Controller;

use App\LeagueOfLegendApi;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class StatistiqueLolController extends AbstractController
{
    /**
     * @Route("/", name="statistique")
     */
    public function index()
    {

        $champions = LeagueOfLegendApi::getAllChampions();

       // dd($champions);
        return $this->render('statistique/index.html.twig', [
            'champions' => $champions,
        ]);
    }

    /**
     * @Route("/champion/{id}", name="champion")
     */
    public function showChampion(int $id)
    {

        $champions = LeagueOfLegendApi::getChampion($id);

        return $this->render('statistique/index.html.twig', [
            'champions' => $champions,
        ]);
    }


}
