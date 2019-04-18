<?php

namespace App\Controller;

class ChoiceController extends AbstractController
{

    public function show()
    {
        return $this->twig->render("Egg/choicecharacter.html.twig");
    }
}