<?php

namespace Drupal\example_2_routing\Controller;

use Drupal\Core\Session\AccountProxy;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Drupal\Core\Entity\EntityTypeManager;

/**
 * @file
 * Provides advanced hello world message functionality.
 */

use Drupal\Core\Controller\ControllerBase;

/**
 * Class HelloWorldController.
 *
 * @package Drupal\example_2_routing\Controller
 */
class HelloWorldController extends ControllerBase {

  /**
   * Drupal\Core\Session\AccountProxy definition.
   *
   * @var \Drupal\Core\Session\AccountProxy
   */
  protected $currentUser;

  /**
   * {@inheritdoc}
   */
  public function __construct(AccountProxy $current_user, EntityTypeManager $entity_type_manager) {
    $this->currentUser = $current_user;
    $this->entityTypeManager = $entity_type_manager;
  }

  /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container) {

    return new static(
      $container->get('current_user'),
      $container->get('entity_type.manager')
    );
  }

  /**
   * Say Hello.
   *
   * @return array
   *   Markup.
   */
  public function hello() {
    $user = $this->entityTypeManager()->getStorage('user');
    $my = $user->load($this->currentUser->id());
    if ($my->uid->value > 0) {
      return ['#markup' => "Hello " . $my->name->value];
    }
    else {
      return ['#markup' => "Hello Anonymous"];
    }

  }

}
