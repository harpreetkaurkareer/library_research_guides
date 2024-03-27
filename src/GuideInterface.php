<?php declare(strict_types = 1);

namespace Drupal\guide;

use Drupal\Core\Entity\ContentEntityInterface;
use Drupal\Core\Entity\EntityChangedInterface;
use Drupal\user\EntityOwnerInterface;

/**
 * Provides an interface defining a guide entity type.
 */
interface GuideInterface extends ContentEntityInterface, EntityOwnerInterface, EntityChangedInterface {

}
