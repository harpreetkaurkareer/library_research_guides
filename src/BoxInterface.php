<?php declare(strict_types = 1);

namespace Drupal\guide;

use Drupal\Core\Entity\ContentEntityInterface;
use Drupal\Core\Entity\EntityChangedInterface;
use Drupal\user\EntityOwnerInterface;

/**
 * Provides an interface defining a box entity type.
 */
interface BoxInterface extends ContentEntityInterface, EntityOwnerInterface, EntityChangedInterface {

}
