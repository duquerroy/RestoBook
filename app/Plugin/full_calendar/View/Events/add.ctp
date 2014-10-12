<div class="reserv panel panel-default">
	<div class="panel-heading">

		<div id="dialogModal">
		     <div class="contentWrap">
		     </div>
		</div>

		<div id='modal' class="modal fade">
		</div>

		<div id="page-container" class="fade in">
			<div class="row">
				<div class="events form col-md-4 ui-sortable">
					<div class="input-group">
						<div class="panel-heading">
						<legend>Nouvelle réservation</legend>
						</div>
						<?php echo $this->Form->create('Event');?>
						<?php
						$this->Form->inputDefaults(array('class' => 'form-control')); ?>
						<?php
						echo $this->Form->input('id');
						echo $this->Form->input('start',
					        array(
					           'id'=>'datetimepicker',
					           'type'=>'text',
					           'label' => array('text' => 'Début : ')
					        ));
						echo $this->Form->input('end',
					        array(
					           'id'=>'datetimepicker1',
					           'type'=>'text',
					           'label' => array('text' => 'Fin : ')
					        ));
						?>
						<br/>
						<?php
						echo $this->Html->link(__('Nouveau client', true), array("plugin"=>"", "controller" => "customers", "action" => "addover"), array("class"=>"overlay btn btn-primary", "title"=>"Add customers"));

						$idCustomer = $this->Session->read('idCustomer');
						unset($_SESSION['idCustomer']);

						echo $this->Form->input('customer_id', array(
							'options' => $customers,
							'default' => $idCustomer,
							'label' => array(
								'text' => 'Clients : '
				   	 			)
							));
						?>
						<div id="client" class="bg-info text-info col-md-12">
						</div>
					</div>
				</div>
				<div class="events form col-md-4 ui-sortable">
				<div id="placeHaut" class="bg-info text-info"></div>
					<div id="place" class="bg-info text-info">
						<?php
						 echo $this->Form->input('event_type_id', array(
						'label' => array('text' => 'Salle : ')));
						?>
					</div>
					<?php
					echo $this->Form->input('size_adulte', array('label' => array('text' => 'Nbre d\'adultes : ')));
					echo $this->Form->input('size_enfant', array('label' => array('text' => 'Nbre d\'enfants : ')));
					echo $this->Form->input('size_3ans', array('label' => array('text' => 'Nbre de -3ans : ')));
					echo $this->Form->input('special_clause', array('label' => 'Clause spéciale : ', 'type' => 'textarea', 'rows' => 2));
					echo $this->Form->input('notes', array('label' => 'Notes : ', 'type' => 'textarea', 'rows' => 2));
					 ?>

				</div>
				<div class="events form col-md-4 ui-sortable">
					<?php
					echo $this->Form->input('block_resto', array('label' => 'Bloquer le resto'));
					echo $this->Form->input('block_room', array('label' => 'Bloquer la salle'));
					echo $this->Form->input('all_day', array('label' => 'Toute la journée'));
					// echo $this->Form->input('block_until');
					echo $this->Form->input('nb_tables', array('label' => 'Nb de table : '));

					echo $this->Form->radio('status', array(
								'Prévu' => 'Prévu',
								'Confirmé' => 'Confirmé'
								),
								array('legend' => 'Status')
						);

					echo $this->Form->input('user_id', array('label' => 'User : ')); ?>


					<?php echo $this->Form->end(array(
						'label' => 'Envoyer',
						'class' => 'btn btn-default'
						));?>
					<?php echo $this->Js->writeBuffer(); ?>
					<div class="suppr">
					<?php
					if (isset($this->data['Event']['id'])) {
					$id = $this->data['Event']['id'];
					// debug($this->data['Event']['id']);
					//if (isset($id)) {
						?>
						<?php echo $this->Form->postLink(__('Supprimer'), array('action' => 'delete', $this->data['Event']['id']), array ("class"=>"btn btn-danger", "role"=>"button"), __('Êtes-vous sûr de vouloir supprimer cette réservation ?', $this->data['Event']['id'])); ?>

					<?php } ?>
					</div>

				</div>
			</div>
		</div>
	</div>
</div>


<?php

$this->Js->get('#EventCustomerId')->event('change',
	$this->Js->request(array(
		'plugin' => '',
		'controller'=>'Customers',
		'action'=>'getCustomers'
		), array(
		'update'=>'#client',
		'async' => true,
		'method' => 'post',
		'dataExpression'=>true,
		'data'=> $this->Js->serializeForm(array(
			'isForm' => true,
			'inline' => true
			))
		))
	);

$this->Js->get('#datetimepicker')->event('change',
	$this->Js->request(array(
		'controller'=>'EventTypes',
		'action'=>'calcPlaceFree'
		), array(
		'update'=>'#EventEventTypeId',
		'async' => true,
		'method' => 'post',
		'dataExpression'=>true,
		'data'=> $this->Js->get('#EventAddForm')->serializeForm(array(
			'isForm' => true,
			'inline' => true
		))
	))
);

$this->Js->get('#datetimepicker1')->event('change',
	$this->Js->request(array(
		'controller'=>'EventTypes',
		'action'=>'AffichRoom'
		), array(
		'update'=>'#placeHaut',
		'async' => true,
		'method' => 'post',
		'dataExpression'=>true,
		'data'=> $this->Js->get('#EventAddForm')->serializeForm(array(
			'isForm' => true,
			'inline' => true
		))
	))
);
if (isset($this->data['Event']['event_type_id'])) $_SESSION['idroom'] = $this->data['Event']['event_type_id'];


$this->Html->scriptStart( array('inline' => false));
?>
$("#EventCustomerId").chosen();


//Appel ajax fonction calcPlaceFree pour remplir le select de salle dés le chargement
//prends le datetime dans le datetimepicker
$(document).ready(function() {
    var currentDate = $( "#datetimepicker" ).datetimepicker( "getDate" );
        if (currentDate != null) {
			$.ajax({
				async:true, data:
				$("#EventAddForm").serialize(), dataType:"html", success:
				function (data, textStatus) {
				$("#EventEventTypeId").html(data);
				},
				type:"post", url:"\/resto\/full_calendar\/EventTypes\/calcPlaceFree"
			});
			return false;
		}


});
<?php
echo $this->Html->scriptEnd(array('inline' => false));


$this->Js->get('#EventEventTypeId')->event('change',
	$this->Js->request(array(
		'controller'=>'EventTypes',
		'action'=>'roomChoice'
		), array(
		'update'=>'#modal',
		'async' => true,
		'method' => 'post',
		'dataExpression'=>true,
		'data'=> $this->Js->serializeForm(array(
			'isForm' => true,
			'inline' => true
			))
		))
	);

?>

