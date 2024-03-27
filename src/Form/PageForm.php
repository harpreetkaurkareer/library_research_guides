<?php declare(strict_types = 1);

namespace Drupal\guide\Form;

use Drupal\Core\Entity\ContentEntityForm;
use Drupal\Core\Form\FormStateInterface;
use Drupal\guide\Entity\Guide;

/**
 * Form controller for the page entity edit forms.
 */
final class PageForm extends ContentEntityForm {

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $form = parent::buildForm($form, $form_state);
    if($guide_id = \Drupal::request()->query->get('guide_id', NULL)) {
      $guide = Guide::load($guide_id);
      $form['field_guide']['widget'][0]['target_id']['#default_value'] = $guide;
    }
    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function save(array $form, FormStateInterface $form_state): int {
    $result = parent::save($form, $form_state);

    $message_args = ['%label' => $this->entity->toLink()->toString()];
    $logger_args = [
      '%label' => $this->entity->label(),
      'link' => $this->entity->toLink($this->t('View'))->toString(),
    ];

    switch ($result) {
      case SAVED_NEW:
        $this->messenger()->addStatus($this->t('New page %label has been created.', $message_args));
        $this->logger('guide')->notice('New page %label has been created.', $logger_args);
        break;

      case SAVED_UPDATED:
        $this->messenger()->addStatus($this->t('The page %label has been updated.', $message_args));
        $this->logger('guide')->notice('The page %label has been updated.', $logger_args);
        break;

      default:
        throw new \LogicException('Could not save the entity.');
    }

    $form_state->setRedirectUrl($this->entity->toUrl());

    return $result;
  }

}
