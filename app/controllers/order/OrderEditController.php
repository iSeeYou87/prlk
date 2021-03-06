<?php

Util::inc('controllers', 'order/BaseOrderController.php');

class OrderEditController extends BaseOrderController {
	
	public $form;
	
	public function beforeRender() {
		$this->loadOrder();
		if (is_null($this->order)) return;
		
		if (!$this->order->canEdit()) {
			$this->addAlert(sprintf(View::str('error_order_expired'), $this->order->status), 'danger');
			return;
		}
		
		$this->form = $this->createForm('OrderEdit');
		$this->form->loadFields(Route::ORDER_ADD);
		
		if ($this->edit()) {
			$this->addAlert(View::str('success_save'), 'success');
		}
		
		$this->form->setSession(objectToArray($this->order));
		
		$this->include_datetimepicker();
		
		$this->view = 'order/edit';
	}
	
	private function edit() {
		if ($this->formValidate($this->form->fieldsMandatory())) {
			$fields = $this->form->fieldsAll();
			$values = $this->formValues($fields);
			
			return $this->order->edit($fields, $values) && $this->save();
		}
		
		return false;
	}
	
}

?>