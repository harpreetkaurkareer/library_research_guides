<?php


namespace Drupal\guide\Form;

use Drupal\Core\Ajax\AjaxResponse;
use Drupal\Core\Ajax\CloseModalDialogCommand;
use Drupal\Core\Ajax\InvokeCommand;
use Drupal\Core\Entity\Element\EntityAutocomplete;
use Drupal\Core\Entity\EntityTypeManagerInterface;
use Drupal\Core\Form\FormBase;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Url;
use Drupal\user\Entity\User;

class CopyExistingPage extends FormBase {

  /**
   * The node storage.
   *
   * @var \Drupal\node\NodeStorage
   */
  protected $guideStorage;

  /**
   * {@inheritdoc}
   */
//   public function __construct(EntityTypeManagerInterface $entity_type_manager) {
//     $this->guideStorage = $entity_type_manager->getStorage('guide_page');
//   }

//   /**
//    * {@inheritdoc}
//    */
//   public static function create(ContainerInterface $container) {
//     return new static(
//       $container->get('entity_type.manager')
//     );
//   }
  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'guide_copy_existing_page';
  }
  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $form['description'] = [
      '#type' => 'label',
      '#title' => $this->t('Search by page title'),
      '#attributes' => ['class'=>['dialog-desc red-text']]
    ];

    $form['pages'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Search page'),
      '#autocomplete_route_name' => 'guides.autocomplete.pages',
      '#placeholder' => 'Search..',
    ];

    $form['actions'] = ['#type' => 'actions'];

    $form['actions']['submit'] = [
      '#type' => 'submit',
      '#weight' => 0,
      '#value' => $this->t('Copy')
    ];

    return $form;
  }

  /**
   * Ajax callback for "Submit" button.
   */
  public function cancelCallback(array &$form, FormStateInterface $form_state) {
    $response = new AjaxResponse();
    $response->addCommand(new CloseModalDialogCommand());
    return $response;
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {

  }
}
