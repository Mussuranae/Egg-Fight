<?php

namespace App\Controller;

use GuzzleHttp\Client;

class ChoiceController extends AbstractController
{


    public function show()
    {


        $client = new Client([
        // Base URI is used with relative requests
        'base_uri' => 'http://easteregg.wildcodeschool.fr/api/',
        // You can set any number of default request options
        ]);

        // Initialize Characters array
      // pick 10 characters and stock into array $data
		$characters=[];

        while (count($characters) < 10) {
            $response = $client->request('GET', 'characters/random');
            $temporary_characters=$response->getBody();
            $temporary_characters=json_decode($temporary_characters);
            if (!in_array($temporary_characters, $characters)) {
                $characters[]=$temporary_characters;
            }
        }

        if ($_SERVER['REQUEST_METHOD']=='POST') {
            session_start();
            if (empty($_SESSION['perso1'])) {
                $_SESSION['perso1']=array_keys($_POST);
            } else {
                $_SESSION['perso2']=array_keys($_POST);

            }
        }
        $response1= $client->request('GET', 'characters/'.$_SESSION['perso1'][0]);
        $namePerso1=$response1->getBody();
		$namePerso1=json_decode($namePerso1);

		$response2= $client->request('GET', 'characters/'.$_SESSION['perso2'][0]);
		$namePerso2=$response2->getBody();
		$namePerso2=json_decode($namePerso2);

    
        return $this->twig->render('Egg/choicecharacter.html.twig', ['characters'=>$characters, 'perso1'=>$namePerso1, 'perso2'=>$namePerso2]);
    }
}
