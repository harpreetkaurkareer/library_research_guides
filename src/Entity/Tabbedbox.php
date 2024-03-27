<?php declare(strict_types = 1);

namespace Drupal\guide\Entity;

use Drupal\Core\Entity\EntityChangedTrait;
use Drupal\Core\Entity\EntityStorageInterface;
use Drupal\Core\Entity\EntityTypeInterface;
use Drupal\Core\Entity\RevisionableContentEntityBase;
use Drupal\Core\Field\BaseFieldDefinition;
use Drupal\guide\TabbedbooxInterface;
use Drupal\user\EntityOwnerTrait;

/**
 * Defines the tabbedbox entity class.
 *
 * @ContentEntityType(
 *   id = "guide_tabbedbox",
 *   label = @Translation("Tabbedbox"),
 *   label_collection = @Translation("Tabbedboxes"),
 *   label_singular = @Translation("Tabbedbox"),
 *   label_plural = @Translation("Tabbedboxes"),
 *   label_count = @PluralTranslation(
 *     singular = "@count Tabbedboxes",
 *     plural = "@count Tabbedboxes",
 *   ),
 *   handlers = {
 *     "list_builder" = "Drupal\guide\BoxListBuilder",
 *     "views_data" = "Drupal\views\EntityViewsData",
 *     "access" = "Drupal\guide\TabbedboxAccessControlHandler",
 *     "form" = {
 *       "add" = "Drupal\guide\Form\TabbedboxForm",
 *       "edit" = "Drupal\guide\Form\TabbedboxForm",
 *       "delete" = "Drupal\Core\Entity\ContentEntityDeleteForm",
 *       "delete-multiple-confirm" = "Drupal\Core\Entity\Form\DeleteMultipleForm",
 *     },
 *     "route_provider" = {
 *       "html" = "Drupal\Core\Entity\Routing\AdminHtmlRouteProvider",
 *     },
 *   },
 *   base_table = "guide_box",
 *   data_table = "guide_box_field_data",
 *   revision_table = "guide_box_revision",
 *   revision_data_table = "guide_box_field_revision",
 *   show_revision_ui = TRUE,
 *   translatable = TRUE,
 *   admin_permission = "administer guide_tabbedbox",
 *   entity_keys = {
 *     "id" = "id",
 *     "revision" = "revision_id",
 *     "langcode" = "langcode",
 *     "label" = "name",
 *     "uuid" = "uuid",
 *     "owner" = "uid",
 *   },
 *   revision_metadata_keys = {
 *     "revision_user" = "revision_uid",
 *     "revision_created" = "revision_timestamp",
 *     "revision_log_message" = "revision_log",
 *   },
 *   links = {
 *     "collection" = "/admin/content/tabbedbox",
 *     "add-form" = "/tabbedbox/add",
 *     "canonical" = "/tabbedbox/{guide_tabbedbox}",
 *     "edit-form" = "/tabbedbox/{guidetabbed_box}/edit",
 *     "delete-form" = "/tabbedbox/{guide_tabbedbox}/delete",
 *     "delete-multiple-form" = "/admin/content/tabbedbox/delete-multiple",
 *   },
 *   field_ui_base_route = "entity.guide_tabbedbox.settings",
 * )
 */
final class Tabbedbox extends RevisionableContentEntityBase implements TabbedboxInterface {

  use EntityChangedTrait;
  use EntityOwnerTrait;

  /**
   * {@inheritdoc}
   */
  public function preSave(EntityStorageInterface $storage): void {
    parent::preSave($storage);
    if (!$this->getOwnerId()) {
      // If no owner has been set explicitly, make the anonymous user the owner.
      $this->setOwnerId(0);
    }
  }

  /**
   * {@inheritdoc}
   */
  public static function baseFieldDefinitions(EntityTypeInterface $entity_type): array {

    $fields = parent::baseFieldDefinitions($entity_type);

    $fields['name'] = BaseFieldDefinition::create('string')
      ->setRevisionable(TRUE)
      ->setTranslatable(TRUE)
      ->setLabel(t('Name'))
      ->setRequired(TRUE)
      ->setSetting('max_length', 255)
      ->setDisplayOptions('form', [
        'type' => 'string_textfield',
        'weight' => -5,
      ])
      ->setDisplayConfigurable('form', TRUE)
      ->setDisplayOptions('view', [
        'label' => 'hidden',
        'type' => 'string',
        'weight' => -5,
      ])
      ->setDisplayConfigurable('view', TRUE);

    // $fields['field_page'] = BaseFieldDefinition::create('entity_reference')
    //   ->setLabel(t('Page'))
    //   ->setSetting('target_type', 'guide_page')
    //   ->setSetting('handler', 'default')
    //   ->setRequired(FALSE)
    //   ->setDisplayOptions('form', [
    //     'type' => 'options_select',
    //     'weight' => 2,
    //   ])
    //   ->setDisplayConfigurable('form', TRUE)
    //   ->setDisplayOptions('form', [
    //     'type' => 'entity_reference_autocomplete',
    //     'settings' => [
    //       'match_operator' => 'CONTAINS',
    //       'size' => 60,
    //       'placeholder' => '',
    //     ],
    //     'weight' => 5,
    //   ])
    //   ->setDisplayConfigurable('view', TRUE);

  $fields['field_content'] = BaseFieldDefinition::create('text_long')
    ->setRevisionable(TRUE)
    ->setTranslatable(TRUE)
    ->setLabel(t('Content'))
    ->setDisplayOptions('form', [
      'type' => 'text_textarea',
      'weight' => 10,
    ])
    ->setDisplayConfigurable('form', TRUE)
    ->setDisplayOptions('view', [
      'type' => 'text_default',
      'label' => 'above',
      'weight' => 10,
    ])
    ->setDisplayConfigurable('view', TRUE);

    $fields['position'] = BaseFieldDefinition::create('string')
      ->setRevisionable(TRUE)
      ->setTranslatable(TRUE)
      ->setLabel(t('Position'))
      ->setRequired(TRUE)
      ->setSetting('max_length', 255)
      ->setDisplayOptions('form', [
        'type' => 'string_textfield',
        'weight' => -5,
      ])
      ->setDisplayConfigurable('form', TRUE)
      ->setDisplayOptions('view', [
        'label' => 'hidden',
        'type' => 'string',
        'weight' => -5,
      ])
      ->setDisplayConfigurable('view', TRUE);

    $fields['status'] = BaseFieldDefinition::create('boolean')
      ->setRevisionable(TRUE)
      ->setLabel(t('Status'))
      ->setDefaultValue(TRUE)
      ->setSetting('on_label', 'Enabled')
      ->setDisplayOptions('form', [
        'type' => 'boolean_checkbox',
        'settings' => [
          'display_label' => FALSE,
        ],
        'weight' => 0,
      ])
      ->setDisplayConfigurable('form', TRUE)
      ->setDisplayOptions('view', [
        'type' => 'boolean',
        'label' => 'above',
        'weight' => 0,
        'settings' => [
          'format' => 'enabled-disabled',
        ],
      ])
      ->setDisplayConfigurable('view', TRUE);

    $fields['uid'] = BaseFieldDefinition::create('entity_reference')
      ->setRevisionable(TRUE)
      ->setTranslatable(TRUE)
      ->setLabel(t('Author'))
      ->setSetting('target_type', 'user')
      ->setDefaultValueCallback(self::class . '::getDefaultEntityOwner')
      ->setDisplayOptions('form', [
        'type' => 'entity_reference_autocomplete',
        'settings' => [
          'match_operator' => 'CONTAINS',
          'size' => 60,
          'placeholder' => '',
        ],
        'weight' => 15,
      ])
      ->setDisplayConfigurable('form', TRUE)
      ->setDisplayOptions('view', [
        'label' => 'above',
        'type' => 'author',
        'weight' => 15,
      ])
      ->setDisplayConfigurable('view', TRUE);

    $fields['created'] = BaseFieldDefinition::create('created')
      ->setLabel(t('Authored on'))
      ->setTranslatable(TRUE)
      ->setDescription(t('The time that the box was created.'))
      ->setDisplayOptions('view', [
        'label' => 'above',
        'type' => 'timestamp',
        'weight' => 20,
      ])
      ->setDisplayConfigurable('form', TRUE)
      ->setDisplayOptions('form', [
        'type' => 'datetime_timestamp',
        'weight' => 20,
      ])
      ->setDisplayConfigurable('view', TRUE);

    $fields['changed'] = BaseFieldDefinition::create('changed')
      ->setLabel(t('Changed'))
      ->setTranslatable(TRUE)
      ->setDescription(t('The time that the box was last edited.'));

    return $fields;
  }

}
