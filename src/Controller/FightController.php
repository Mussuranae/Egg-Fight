<?php

namespace App\Controller;

use GuzzleHttp\Client;

class FightController extends AbstractController
{
  public function show($code)
  {
  	session_start();
  	
  	$client = new Client([
  		'base_uri' => 'http://easteregg.wildcodeschool.fr/api/',
  	]);

  	// Récupération des infos des 2 personnages choisis sur la page choicecharacter.html.twig
  	$response=$client->request('GET', 'characters/'.$_SESSION['perso1'][0]);
  	$characters=$response->getBody();
  	$characters=json_decode($characters);

  	$response2=$client->request('GET', 'characters/'.$_SESSION['perso2'][0]);
  	$characters2=$response2->getBody();
  	$characters2=json_decode($characters2);

  		$egg=[];
  		$egg2=[];
	if($code==1) {
		$response3 = $client->request('GET', 'eggs/random');
		$egg = $response3->getBody();
		$egg = json_decode($egg);
	}
	  if($code==2) {
		  $response4 = $client->request('GET', 'eggs/random');
		  $egg2 = $response4->getBody();
		  $egg2 = json_decode($egg2);
	  }

	  var_dump($egg);

    return $this->twig->render('Egg/fight.html.twig', ['characters'=>$characters, 'characters2'=>$characters2, 'egg'=>$egg ,'egg2'=>$egg2]);
  }



}
