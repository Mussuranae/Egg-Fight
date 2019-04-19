<?php

namespace App\Controller;

use GuzzleHttp\Client;

class EggsController extends AbstractController
{
	public function eggs(){

		$client = new Client([
			// Base URI is used with relative requests.
			'base_uri' => 'http://easteregg.wildcodeschool.fr/api/',
			// You can set any number of default request options.
			'timeout'  => 2.0,
		]);

		$response=$client->request('GET', 'eggs');

		$data=$response->getBody();

		$data=\GuzzleHttp\json_decode($data);

		echo $data[0]->image;

		return $this->twig->render('suck_my_egg.html.twig', [
			'egg'=>$data[0]
		]);
	}
}
