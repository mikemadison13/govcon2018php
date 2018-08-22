<?php

namespace Drupal\example_4_plugin\Plugin\Block;

use Drupal\Core\Block\BlockBase;
use Drupal\Core\Block\BlockPluginInterface;
use Drupal\Core\Form\FormStateInterface;

/**
 * Provides a Hello Advanced block.
 *
 * @Block(
 *   id = "hello_advanced_block",
 *   admin_label = @Translation("Hello Advanced Block"),
 *   category = @Translation("GovCon")
 * )
 */
class HelloAdvancedBlock extends BlockBase implements BlockPluginInterface {

  /**
   * {@inheritdoc}
   */
  public function blockForm($form, FormStateInterface $form_state) {
    $form = parent::blockForm($form, $form_state);
    $config = $this->getConfiguration();
    $form['session'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Session Name'),
      '#default_value' => isset($config['session']) ? $config['session'] : '',
    ];
    $form['person'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Person Name'),
      '#default_value' => isset($config['person']) ? $config['person'] : '',
    ];
    $form['text'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Greeting'),
      '#default_value' => isset($config['text']) ? $config['text'] : '',
    ];
    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function blockSubmit($form, FormStateInterface $form_state) {
    parent::blockSubmit($form, $form_state);
    $values = $form_state->getValues();
    $fields = [
      'person',
      'session',
      'text',
    ];
    foreach ($fields as $field) {
      $this->configuration[$field] = $values[$field];
    }
  }

  /**
   * Builds and returns the renderable array for this block plugin.
   *
   * If a block should not be rendered because it has no content, then this
   * method must also ensure to return no content: it must then only return an
   * empty array, or an empty array with #cache set (with cacheability metadata
   * indicating the circumstances for it being empty).
   *
   * @return array
   *   A renderable array representing the content of the block.
   *
   * @see \Drupal\block\BlockViewBuilder
   */
  public function build() {
    $config = $this->getConfiguration();
    return [
      '#theme' => 'helloadvanced',
      '#text' => isset($config['text']) ? $config['text'] : NULL,
      '#person' => isset($config['person']) ? $config['person'] : NULL,
      '#session' => isset($config['session']) ? $config['session'] : NULL,
    ];
  }

}
