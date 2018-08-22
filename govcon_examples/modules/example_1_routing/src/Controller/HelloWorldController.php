<?php

namespace Drupal\example_1_routing\Controller;

/**
 * @file
 * Provides basic hello world message functionality.
 */

use Drupal\Core\Controller\ControllerBase;

/**
 * Class HelloWorldController.
 *
 * @package Drupal\example_1_routing\Controller
 */
class HelloWorldController extends ControllerBase {

  /**
   * Say Hello.
   *
   * @return array
   *   Markup.
   */
  public function hello() {
    return ['#markup' => "Hello World!"];
  }

}
