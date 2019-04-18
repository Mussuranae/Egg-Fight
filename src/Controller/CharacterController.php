<?php

namespace App\Controller;

use 

/**
*  Initializes this class.
*/
class CharacterController extends AbstractController() {

  public function __construct()
  {
      $loader = new FilesystemLoader(APP_VIEW_PATH);
      $this->twig = new Environment(
          $loader,
          [
              'cache' => !APP_DEV,
              'debug' => APP_DEV,
          ]
      );
      $this->twig->addExtension(new DebugExtension());
  }
}
?>