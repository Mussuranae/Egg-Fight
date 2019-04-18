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
  	$characters=[];
		$i=0;
		$x=0;
  	// pick 10 characters and stock into array $data
  	while (count($characters) < 10) {
  		
  		$response = $client->request('GET', 'characters/random');
  		$temporary_characters=$response->getBody();
  		$temporary_characters=json_decode($temporary_characters);
  		if(!in_array($temporary_characters, $characters)) {
		    $characters[]=$temporary_characters;
  		}
  		
  	}

    
    return $this->twig->render('Egg/choicecharacter.html.twig', ['characters'=>$characters]);

  }
}

?>
