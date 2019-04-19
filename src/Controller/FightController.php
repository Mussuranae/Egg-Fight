<?php

namespace App\Controller;

use GuzzleHttp\Client;

class FightController extends AbstractController
{
  /**
   *
   * @return mixed
   */
    public function show($code)
    {
        session_start();
    
        $client = new Client([
        'base_uri' => 'http://easteregg.wildcodeschool.fr/api/',
        ]);

      // Récupération des infos du 1er personnage choisi sur la page choicecharacter.html.twig
        $response = $client->request('GET', 'characters/'.$_SESSION['perso1'][0]);
        $characters = $response->getBody();
        $characters = json_decode($characters, true); //avec le 'true' ça renvoit les datas en tableau associatif

      // Récupération des infos du 2e personnage choisi sur la page choicecharacter.html.twig
        $response2 = $client->request('GET', 'characters/'.$_SESSION['perso2'][0]);
        $characters2 = $response2->getBody();
        $characters2 = json_decode($characters2, true); //avec le 'true' ça renvoit les datas en tableau associatif

      // initialisation des infos des oeuf dans un tableau à null
        $egg = [];
        $egg2 = [];

        if ($code == 1) {
            $response3 = $client->request('GET', 'eggs/random');
            $egg = $response3->getBody();
            $egg = json_decode($egg, true); //avec le 'true' ça renvoit les datas en tableau associatif

        }

        if ($code == 2) {
            $response4 = $client->request('GET', 'eggs/random');
            $egg2 = $response4->getBody();
            $egg2 = json_decode($egg2, true); //avec le 'true' ça renvoit les datas en tableau associatif

        }

        $pvPerso1 = $_SESSION['pvPerso1'];
        $pvPerso2 = $_SESSION['pvPerso2'];
		$player1="";
		$player2="";

        if ($code == 3) {
            $pvPerso2 -= rand(20, 25);
			$player2=2;
        }

        if ($code == 4) {
            $pvPerso1 -= rand(20, 25);
			$player1=1;
        }
		$imageMael="";
        if ($code == 5) {
        	$imageMael='https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQPCD_KIMv7U31ugG-18kIndGnqMxN1husZL-hAT0_AuHc3Rfii';
		}

        $_SESSION['pvPerso1'] = $pvPerso1;
        $_SESSION['pvPerso2'] = $pvPerso2;

        $navegg = $client->request('GET', 'eggs/random');
        $oeuf = $navegg->getBody();
        $oeuf = json_decode($oeuf, true);

        return $this->twig->render('Egg/fight.html.twig', ['characters'=>$characters, 'characters2'=>$characters2, 'egg'=>$egg ,'egg2'=>$egg2,'pvPerso1'=>$pvPerso1, 'pvPerso2'=>$pvPerso2, 'imageMael'=>$imageMael, 'player2'=>$player2, 'player1'=>$player1, 'oeuf'=>$oeuf]);
    }
}
