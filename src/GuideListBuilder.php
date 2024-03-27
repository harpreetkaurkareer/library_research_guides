<?php declare(strict_types = 1);

namespace Drupal\guide;

use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Entity\EntityListBuilder;
use Drupal\taxonomy\Entity\Term;
/**
 * Provides a list controller for the guide entity type.
 */
final class GuideListBuilder extends EntityListBuilder {

  /**
   * {@inheritdoc}
   */
  public function buildHeader(): array {
    $header['id'] = $this->t('ID');
    $header['label'] = $this->t('Label');
    $header['status'] = $this->t('Status');
    $header['guideType'] = $this->t('Guide Type');
    $header['subject'] = $this->t("Subject");
    $header['guideGroup'] = $this->t("Guide Group");
    $header['uid'] = $this->t('Author');
    $header['created'] = $this->t('Created');
    $header['changed'] = $this->t('Updated');
    return $header + parent::buildHeader();
  }

  /**
   * {@inheritdoc}
   */
  public function buildRow(EntityInterface $entity): array {
    /** @var \Drupal\guide\GuideInterface $entity */
    $row['id'] = $entity->id();
    $row['label'] = $entity->toLink();
    $row['status'] = $entity->get('status')->value ? $this->t('Enabled') : $this->t('Disabled');

    /*Each of the below grab the taxonomy terms and set the guides based on those */
    $taxonomy_term = Term::load($entity->get('guide_type_id')->target_id);
    $guide_type = $taxonomy_term ? $taxonomy_term->label() : '';
    $row['guideType'] = $guide_type;

    $taxonomy_term = Term::load($entity->get('subject_id')->target_id);
    $subject = $taxonomy_term ? $taxonomy_term->label() : '';
    $row['subject'] = $subject;

    $taxonomy_term = Term::load($entity->get('guide_group_id')->target_id);
    $group =  $taxonomy_term ? $taxonomy_term->label() : '';
    $row['guideGroup'] = $group;

      $username_options = [
      'label' => 'hidden',
      'settings' => ['link' => $entity->get('uid')->entity->isAuthenticated()],
    ];
    $row['uid']['data'] = $entity->get('uid')->view($username_options);
    $row['created']['data'] = $entity->get('created')->view(['label' => 'hidden']);
    $row['changed']['data'] = $entity->get('changed')->view(['label' => 'hidden']);
    return $row + parent::buildRow($entity);
  }
}
