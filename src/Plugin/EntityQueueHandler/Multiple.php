<?php

/**
 * @file
 * Contains \Drupal\entityqueue\Plugin\EntityQueueHandler\Multiple.
 */

namespace Drupal\entityqueue\Plugin\EntityQueueHandler;

use Drupal\entityqueue\EntityQueueHandlerBase;

/**
 * Defines an entity queue handler that manages multiple subqueues.
 *
 * @EntityQueueHandler(
 *   id = "multiple",
 *   title = @Translation("Multiple")
 * )
 */
class Multiple extends EntityQueueHandlerBase {

  /**
   * {@inheritdoc}
   */
  public function supportsMultipleSubqueues() {
    return TRUE;
  }

}