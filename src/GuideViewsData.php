<?php

namespace Drupal\guide;

use Drupal\Core\Entity\EntityTypeManagerInterface;
use Drupal\Core\Extension\ModuleHandlerInterface;
use Drupal\Core\StringTranslation\TranslationManager;
use Drupal\Core\Entity\EntityFieldManagerInterface;
use Drupal\views\EntityViewsData;

class GuideViewsData extends EntityViewsData {

  protected $moduleHandler;

  public function __construct(
    EntityTypeManagerInterface $entity_type_manager,
    ModuleHandlerInterface $module_handler,
    TranslationManager $translation_manager,
    EntityFieldManagerInterface $entity_field_manager
  ) {
    parent::__construct($entity_type_manager, $module_handler, $translation_manager, $entity_field_manager);
    $this->moduleHandler = $module_handler;
  }

  /**
   * {@inheritdoc}
   */
  public function getViewsData() {
    $data = parent::getViewsData();

    // Load YAML view configuration.
    $module_path = $this->moduleHandler->getModule('guide')->getPath();
    $config_path = $module_path . '/config/install/view_display_guide.yml';
    if (file_exists($config_path)) {
      $yaml_data = \Drupal\Core\Serialization\Yaml::decode(file_get_contents($config_path));
      $data = array_merge_recursive($data, $yaml_data);
    }

    return $data;
  }
}
