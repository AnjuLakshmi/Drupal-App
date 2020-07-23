<?php

namespace Drupal\demographics\Controller;

use Drupal\Core\Controller\ControllerBase;

/**
 * Demographics controller.
 */
class DemographicsController extends ControllerBase {

  /**
   * Saves user demographics to db 
   */
  public function saveDemographics() {
	
	$user_data = [
      [
        'age' => (empty($_POST['age']) ? 0 : strip_tags($_POST['age'])),
        'age_declined' => $_POST['age_declined'],
        'gender' => $_POST['gender'],
		'gender_declined' => $_POST['gender_declined'],
		'zipcode' => (empty($_POST['zipcode']) ? 0 : strip_tags($_POST['zipcode'])),
		'zipcode_declined' => $_POST['zipcode_declined'],
		'decline_all' => $_POST['decline_all'],
		'timestamp' => date('Y-m-d h:i:s'),
      ], 
    ];
	
	$connection = \Drupal::database();
    foreach ($user_data as $data) {
      $connection->insert('user_demographics')->fields($data)->execute();
	}
    return array('success');
  }

}