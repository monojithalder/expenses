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
 *   id = "rules_create_bank_transaction",
 *   label = @Translation("Create Bank Transaction"),
 *   category = @Translation("Expenses"),
 *   context = {
 *     "entity" = @ContextDefinition("entity",
 *       label = @Translation("Income/Expenses Node"),
 *       description = @Translation("")
 *     )
 *   }
 * )
 */
class CreateBankTransaction extends RulesActionBase {

		/**
		 * Deletes the Entity.
		 *
		 * @param \Drupal\Core\Entity\EntityInterface $entity
		 *    The entity to be deleted.
		 */
		protected function doExecute(EntityInterface $entity) {
				$a = 0;
				$user_id = \Drupal::currentUser()->id();
				$entity_array = $entity->toArray();
				$transaction_type = 'Dr';
				$amount = 0;
				$payment_method_id = $entity_array['field_payment_method'][0]['target_id'];
				$payment_method_node = Node::load($payment_method_id)->toArray();
				$payment_method_type_id = $payment_method_node['field_payment_method_type'][0]['target_id'];
				$term_name = \Drupal\taxonomy\Entity\Term::load($payment_method_type_id)->get('name')->value;
				$random_number = rand(5,10);
				$cur_date =  $entity_array['field_payment_date'][0]['value'];
				if($entity_array['type'][0]['target_id'] == 'expenses') {
						$transaction_type = 'DR';
						$amount = ($entity_array['field_amount'][0]['value'] * -1);
				}
				else {
						$transaction_type = 'CR';
						$amount = $entity_array['field_amount'][0]['value'];
				}
				switch ($term_name) {
						case 'DEBIT CARD' :
										$node = Node::create([
												'type'         => 'bank_transaction',
												'title'        => 'Bank Transaction'.$random_number,
												'field_payment_date' => $cur_date,
												'field_transaction_status' => 'Active',
												'field_amount' => $amount,
												'field_transaction_type' => $transaction_type,
												'field_user' => $user_id

										]);
										$node->save();
								break;
						case 'NEFT' :
								$node = Node::create([
										'type'         => 'bank_transaction',
										'title'        => 'Bank Transaction'.$random_number,
										'field_payment_date' => $cur_date,
										'field_transaction_status' => 'Active',
										'field_amount' => $amount,
										'field_transaction_type' => $transaction_type,
										'field_user' => $user_id

								]);
								$node->save();
								break;
				}
		}

}

