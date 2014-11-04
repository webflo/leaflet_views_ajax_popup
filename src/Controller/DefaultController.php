<?php /**
 * @file
 * Contains \Drupal\leaflet_views_ajax_popup\Controller\DefaultController.
 */

namespace Drupal\leaflet_views_ajax_popup\Controller;

use Drupal\Core\Controller\ControllerBase;
use Symfony\Component\HttpFoundation\Response;
use Drupal\Core\Access\AccessCheckInterface;
use Drupal\Core\Access\AccessResult;
use Drupal\Core\Session\AccountInterface;
use Symfony\Component\Routing\Route;
use Symfony\Component\HttpFoundation\Request;

/**
 * Default controller for the leaflet_views_ajax_popup module.
 */
class DefaultController extends ControllerBase {


  public function accessCheck($entity_type, $entity_id, AccountInterface $account) {
    $entity = entity_load($entity_type, $entity_id);
    return AccessResult::allowedIf($entity->access('view'));
  }

  public function callback($entity_type, $entity_id, $view_mode) {
    $entity = entity_load($entity_type, $entity_id);
    if (!$entity) return;
    $build = entity_view($entity, $view_mode);
    return new Response(drupal_render($build));
  }
}
