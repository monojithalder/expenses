<?php
namespace Drupal\expenses_general\Plugin\RulesAction;
use Drupal\rules\Core\RulesActionBase;
use Drupal\Core\Entity\EntityInterface;
use \Drupal\node\Entity\Node;
use Drupal\Core\Entity;
/**
 * Provides a 'Create Bank Transaction' action.
 *
 * @RulesAction(
 *   id = "rules_set_user_field",
 *   label = @Translation("Set User Field"),
 *   category = @Translation("Expenses"),
 *   context = {
 *     "entity" = @ContextDefinition("entity",
 *       label = @Translation("Node"),
 *       description = @Translation("")
 *     )
 *   }
 * )
 */
class SetUserField extends RulesActionBase {

		/**
		 * Deletes the Entity.
		 *
		 * @param \Drupal\Core\Entity\EntityInterface $entity
		 *    The entity to be deleted.
		 */
		protected function doExecute(EntityInterface $entity) {
				//$a = 0;
				$user_id = \Drupal::currentUser()->id();
				
		}

}

