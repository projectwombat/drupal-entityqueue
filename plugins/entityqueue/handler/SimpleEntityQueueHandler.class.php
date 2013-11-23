<?php

/**
 * A simple queue implementation.
 */
class SimpleEntityQueueHandler extends EntityQueueHandlerBase {

  /**
   * Overrides EntityQueueHandlerBase::settingsForm().
   */
  public function settingsForm() {
    return array();
  }

  /**
   * Overrides EntityQueueHandlerBase::subqueueForm().
   */
  public function subqueueForm(EntitySubqueue $subqueue, &$form_state) {
    return array();
  }

  /**
   * Overrides EntityQueueHandlerBase::getSubqueueLabel().
   */
  public function getSubqueueLabel(EntitySubqueue $subqueue) {
    return $this->queue->label;
  }

  /**
   * Overrides EntityQueueHandlerBase::loadFromCode().
   */
  public function loadFromCode() {
    $this->ensureSubqueue();
  }

  /**
   * Overrides EntityQueueHandlerBase::insert().
   */
  public function insert() {
    $this->ensureSubqueue();
  }

  /**
   * Makes sure that every simple queue has a subqueue.
   */
  protected function ensureSubqueue() {
    global $user;

    $query = new EntityFieldQuery();
    $query
      ->entityCondition('entity_type', 'entityqueue_subqueue')
      ->entityCondition('bundle', $this->queue->name);
    $result = $query->execute();

    // If we don't have a subqueue already, create one now.
    if (empty($result['entityqueue_subqueue'])) {
      $subqueue = entityqueue_subqueue_create();
      $subqueue->queue = $this->queue->name;
      $subqueue->name = $this->queue->name;
      $subqueue->label = $this->getSubqueueLabel($subqueue);
      $subqueue->module = 'entityqueue';
      $subqueue->uid = $user->uid;

      entityqueue_subqueue_save($subqueue);
    }
  }
}