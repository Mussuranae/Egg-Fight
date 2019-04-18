<?php

namespace App\Controller;

/**
* Initializes this class.
*/
class CharacterController extends AbstractController() {

  public function randomCharacter()
    {
      $client = new Client([
      	// Base URI is used with relative requests
        'base_uri' => 'http://easteregg.wildcodeschool.fr/api/',
        // You can set any number of default request options
        'timeout'  => 2.0,
      ]);
      $response = $client->request('GET', 'characters/random');
      // DANS URI --> METTRE REQUETE GET que vous voulez utiliser. Liste des requêtes ci dessous :
      /**
      * GET /api/eggs
      * GET /api/eggs/:id
      * GET /api/eggs/random
      * GET /api/characters
      * GET /api/characters/:id
      * GET /api/characters/random
      * http://easteregg.wildcodeschool.fr/api-docs/
			*/

      $data=$response->getBody();
      $data=json_decode($data);
      // Ici, ça va ressortir le resultat de la réquete de la ligne plus haut $client->request. Si random ou si :id, ça ressortira UN SEUL char
			// DONC UN SEUL TABLEAU. SI la formule est simplement eggs/ ou characters/, ça va ressortir TOUS les oeufs/ ou char. Donc UN TABLEAU DANS UN TABLEAU.
			// Et là, c'est plus galère du coup.
			//$data=array_slice(match.random_int(0,99), );
      return $this->twig->render('suck_my_char.html.twig', [
      'character'=>$data,
      ]);
    }
    

}
?>