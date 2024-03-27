<?php

namespace Drupal\guide\TwigExtension;

use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;
use Twig\TwigFunction;
use Drupal\Core\Url;

/**
 * Custom twig functions.
 */
class CustomFunctions extends AbstractExtension {

  /**
   * Declare your custom twig function here.
   *
   * @return \Twig\TwigFunction[]
   *   TwigFunction array.
   */
  public function getFunctions() {
    return [
      'checkaccess' => new TwigFunction('checkaccess', ['Drupal\guide\TwigExtension\CustomFunctions', 'checkAccess']),
    ];
  }

  /**
   * Checks whether a path is accessible to current user.
   *
   * @param string $path
   *   String path.
   *
   * @return string
   *   "true" or "false".
   */
  public static function checkAccess($permission) {

    $account = \Drupal::currentUser();
    return $account->hasPermission($permission);
  }
}