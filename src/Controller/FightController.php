<?php

namespace App\Controller;

class FightController extends AbstractController
{

    public function show()
    {
        return $this->twig->render("Egg/fight.html.twig");
    }
}