<?php

namespace App\Controller;

use GuzzleHttp\Client;

class FightController extends AbstractController
{
  public function show()
  {
  	$client = new Client([
  		'base_uri' => 'http://easteregg.wildcodeschool.fr/api/',
  	]);

  	while (count($characters) < 2) {
		
		$response = $client->request('GET', 'characters/random');
		$temporary_characters=$response->getBody();
		$temporary_characters=json_decode($temporary_characters);

		if(!in_array($temporary_characters, $characters)) {
	    $characters[]=$temporary_characters;
		}
	}

    return $this->twig->render('Egg/fight.html.twig', ['characters'=>$characters]);
  }
}
