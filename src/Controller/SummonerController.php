<?php

namespace App\Controller;

use App\LeagueOfLegendApi;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SummonerController extends AbstractController
{
    /**
     * @Route("/summoner/{name?}", name="summoner")
     * @param null $name
     * @return Response
     */
    public function summoner($name = null)
    {
        return $this->render('summoner/search_summoner.html.twig', compact('name'));
    }

    /**
     * @Route("/summoner-data/{name}", name="summoner-data")
     * @param string $name
     * @return Response
     */
    public function summonerData($name = "")
    {
        $summoner = LeagueOfLegendApi::getSummoner($name);

        return $this->json([
            'view' => $this->render('summoner/summoner.html.twig', compact('summoner'))->getContent()
        ]);
    }

}
