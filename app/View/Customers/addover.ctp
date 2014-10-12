<div class="customers form">
<div class="input-group">
<?php echo $this->Form->create('Customer'); ?>

	<?php
		$this->Form->inputDefaults(array(
        'class' => 'form-control'
    		)
		);
		echo $this->Form->input('lastName');
		echo $this->Form->input('firstName');
		echo $this->Form->input('groupName');
		echo $this->Form->input('phone');
		echo $this->Form->input('work');
		echo $this->Form->input('fax');
		echo $this->Form->input('email');
		echo $this->Form->input('note');

		//echo $this->Js->submit('Submit', array(
			// 'controller'=>'customers',
			// 'action'=>'add',
			// //'before'=>$this->Js->get('#sending')->effect('fadeIn'),
		 // //    'update' => '.events form',  //id of DOM element to update with selector
			// // 'success'=>$this->Js->get('#dialogModal')->effect('explode')
   //  	));


echo $this->Form->end('submit');
// echo $this->Js->writeBuffer(array('inline' => 'true'));
// echo $this->Html->script('jquery');
?>
</div>
</div>



