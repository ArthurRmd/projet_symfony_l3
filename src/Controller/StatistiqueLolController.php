<?php

namespace App\Controller;

use App\LeagueOfLegendApi;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\User\UserInterface;

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

        $freeChampions = LeagueOfLegendApi::getChampionRotation();
        return $this->render('statistique/index.html.twig', [
            'champions' => $freeChampions,
        ]);

    }


    /**
     * @Route("/summoner/{name?}", name="summoner")
     * @return Response
     */
    public function summoner($name = null)
    {

        if (!$name) return $this->render('statistique/search_summoner.html.twig');

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
