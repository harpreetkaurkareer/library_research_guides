<?php declare(strict_types = 1);

namespace Drupal\guide;

use Drupal\Core\Entity\ContentEntityInterface;
use Drupal\Core\Entity\EntityChangedInterface;
use Drupal\user\EntityOwnerInterface;

/**
 * Provides an interface defining a page entity type.
 */
interface PageInterface extends ContentEntityInterface, EntityOwnerInterface, EntityChangedInterface {

}
