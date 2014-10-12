<?php
$nbrClientDej0 = 0;$nbrClientDin0 = 0;$nbrClientSou0 = 0;$nbrClientJou0 = 0;
$nbrClientDej1 = 0;$nbrClientDin1 = 0;$nbrClientSou1 = 0;$nbrClientJou1 = 0;
$nbrClientDej2 = 0;$nbrClientDin2 = 0;$nbrClientSou2 = 0;$nbrClientJou2 = 0;
$nbrClientDej3 = 0;$nbrClientDin3 = 0;$nbrClientSou3 = 0;$nbrClientJou3 = 0;

for ($i=0; $i < 3; $i++) {

	foreach (${'eventsDej'.$i} as $event):
		$nbrClient =  $event['Event']['size_adulte'] + $event['Event']['size_enfant'] + $event['Event']['size_3ans'];
		${'nbrClientDej'.$i} += $nbrClient;
	endforeach;

	foreach (${'eventsDin'.$i} as $event):
		$nbrClient =  $event['Event']['size_adulte'] + $event['Event']['size_enfant'] + $event['Event']['size_3ans'];
		${'nbrClientDin'.$i} += $nbrClient;
	endforeach;

	foreach (${'eventsSou'.$i} as $event):
		$nbrClient =  $event['Event']['size_adulte'] + $event['Event']['size_enfant'] + $event['Event']['size_3ans'];
		${'nbrClientSou'.$i} += $nbrClient;
	endforeach;

	foreach (${'eventsJou'.$i} as $event):
		$nbrClient =  $event['Event']['size_adulte'] + $event['Event']['size_enfant'] + $event['Event']['size_3ans'];
		${'nbrClientJou'.$i} += $nbrClient;
	endforeach;
}
		?>

<div id='modall' class='col-sm-12 alert  navbar-left' style="display:none">
  <a href="#" class="close" onclick="$(this).parent().slideUp()">X</a>
  <p></p>
</div>

<div class="dashboard col-sm-4">
	<div class="panel panel-success">
		<div class="panel-heading">
				<h3 class="panel-title"><?php echo __('Réservations'); ?></h3>
		</div>
		<div class="panel-body">
			<table class="table">
				<tr>
					<th></th>
					<th><?= $this->Html->link('Ce jour', array('plugin'=>'full_calendar', 'controller' => 'events', 'action' => 'today')); ?></th>
					<th><?= $this->Html->link('Demain', array('plugin'=>'full_calendar', 'controller' => 'events', 'action' => 'today', 1)); ?></th>
					<th><?= $this->Html->link('+7 jours', array('plugin'=>'full_calendar', 'controller' => 'events', 'action' => 'today', 7)); ?></th>
				</tr>
				<tr>
					<td><span class="toc1">Déjeuner</span></td>
					<td><?= $nbrClientDej0; ?></td>
					<td><?= $nbrClientDej1; ?></td>
					<td><?= $nbrClientDej2; ?></td>
				</tr>
				<tr>
					<td><span class="toc2">Diner</span></td>
					<td><?= $nbrClientDin0; ?></td>
					<td><?= $nbrClientDin1; ?></td>
					<td><?= $nbrClientDin2; ?></td>
				</tr>
				<tr>
					<td><span class="toc3">Souper</span></td>
					<td><?= $nbrClientSou0; ?></td>
					<td><?= $nbrClientSou1; ?></td>
					<td><?= $nbrClientSou2; ?></td>
				</tr>
					<tr>
					<td><span class="toc4">Journée</span></td>
					<td><?= $nbrClientJou0; ?></td>
					<td><?= $nbrClientJou1; ?></td>
					<td><?= $nbrClientJou2; ?></td>
				</tr>

			</table>
		</div>
	</div>
</div>

<div class="dashboard col-sm-4">
	<div class="panel panel-default">
		<div class="panel-heading">
				<h3 class="panel-title"><?php echo __('Clients'); ?> &nbsp; <?php echo $this->Html->link(__('Nouveau client', true), array("plugin"=>"", "controller" => "customers", "action" => "add"), array("class"=>"btn btn-primary", "title"=>"Add customers")); ?></h3>

		</div>
		<div class="panel-body">
			<?php
			$this->Form->inputDefaults(array('class' => 'form-control'));
			echo $this->Form->create('Event');
			echo $this->Form->input('customer_id', array(
				'options' => $customers,
				'default' => $this->get('id'),
				'label' => false
				));
			echo $this->Form->end();
			?>
			<div id="client" class="">
			</div>
		</div>
	</div>
</div>

<div class="dashboard col-sm-4">
	<div class="panel panel-warning">
		<div class="panel-heading">
				<h3 class="panel-title"><?php echo __('Stats'); ?></h3>
		</div>
		<div class="panel-body">
			<table class="table">
			<tr>
				<th></th>
				<th></th>
			</tr>
			<tr>
				<td><span class="toc1">Nombre de clients : </span></td>
				<td><?php echo $nbrClientBase; ?></td>
			</tr>
			<tr>
				<td><span class="toc2">Nombre de salles : </span></td>
				<td><?php echo $nbrSalles; ?></td>
			</tr>
			</table>
		</div>
	</div>
</div>

<div class="clearfix"></div>


<div class="dashboard col-sm-12">
	<div class="panel panel-warning">
		<div class="panel-heading">
			<h3 class="panel-title"><?php echo __('Taux d\'occupation'); ?></h3>
		</div>
		<div class="panel-body">

		<?php //debug($tab); ?>

		<?php $this->Html->script('flot/jquery.flot', array('inline' => false)); ?>
		<?php $this->Html->script('flot/jquery.flot.time', array('inline' => false)); ?>

    	<div class="demo-container">
			<div id="placeholder" class="demo-placeholder" style="float:left; width:675px;"></div>
			<p id="choices" style="float:right; width:135px;"></p>
		</div>
		</div>
	</div>
</div>


<?php
$this->Html->scriptStart( array('inline' => false));
?>

		$(document).ready(function() {

		var datasets = {
			"Clients": {
				label: "Nbre Clients",
				data: <?php echo $tab; ?>
			}
		};

		// hard-code color indices to prevent them from shifting as
		// countries are turned on/off

		var i = 2;
		$.each(datasets, function(key, val) {
			val.color = i;
			++i;
		});

		// insert checkboxes
		var choiceContainer = $("#choices");
		$.each(datasets, function(key, val) {
			choiceContainer.append("<br/><input type='checkbox' name='" + key +
				"' checked='checked' id='id" + key + "'></input>" +
				"<label for='id" + key + "'>"
				+ val.label + "</label>");
		});

		choiceContainer.find("input").click(plotAccordingToChoices);

		function plotAccordingToChoices() {

			var data = [];

			choiceContainer.find("input:checked").each(function () {
				var key = $(this).attr("name");
				if (key && datasets[key]) {
					data.push(datasets[key]);
				}
			});

			if (data.length > 0) {
				$.plot("#placeholder", data, {
					yaxis: {
						min: 0
					},
					xaxis: {
					    mode: "time",
					    timeformat: "%b"
					}
				});
			}
		}

		plotAccordingToChoices();
	});





$("#EventCustomerId").chosen();



<?php
echo $this->Html->scriptEnd(array('inline' => false));



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
?>
