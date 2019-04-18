<?php

namespace App\Model;

class CharacterManager extends AbstractManager {

	const (charLife) = 100;
	const TABLE = 'characters';

	public function__construct() {
		parent::__construct(self::TABLE);
	}



}



?>