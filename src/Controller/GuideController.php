<?php declare(strict_types = 1);

namespace Drupal\guide\Controller;

use Drupal\Core\Controller\ControllerBase;

/**
 * Returns responses for Guide routes.
 */
final class GuideController extends ControllerBase {

  /**
   * Builds the response.
   */
  public function __invoke(): array {
    // Get the block manager service.
    $blockManager = \Drupal::service('plugin.manager.block');

    // Get the view and display ID of the Views block you want to place.
//    $view_id = 'guide_pages';
//    $display_id = 'block_1';
//    $plugin_id = 'views_block:' . $view_id . '-' . $display_id;
//    $theme = \Drupal::config('system.theme')->get('default');
//    $entityTypeManager = \Drupal::service('entity_type.manager');
//
//    $entity = $entityTypeManager->getStorage('block')->create(['id' => "{$theme}_views_block__guide_pages_block_1", 'plugin' => $plugin_id, 'theme' => $theme, 'region' => 'sidebar']);
//    $visibility = $entity->getVisibility();
//    $visibility['request_path']['pages'] = '/guide/*';
//    $entity->setVisibilityConfig('request_path', $visibility['request_path']);
//
//    $entity->save();
//    ddl($entity);

///
///

    $build['content'] = [
      '#type' => 'item',
      '#markup' => $this->t('It works!'),
    ];

    return $build;
  }

}
