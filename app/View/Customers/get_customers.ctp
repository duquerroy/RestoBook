<div class="popupeventClient">
	<ul class='clearfix back'>
		<li class="tit"><?php echo __('Nom'); ?></li>

		<li class="val">

		<a href='#' id='lastName'
			data-type="text"
			data-pk="<?php echo h($customer['Customer']['id']); ?>"
			data-url="/resto/customers/editAjax/<?php echo h($customer['Customer']['id']); ?>"
			data-title="Nom"><?php echo h($customer['Customer']['lastName']); ?>
		</a>

		</li>
	</ul><ul class='clearfix'>
		<li class="tit"><?php echo __('Prénom'); ?></li>

		<li class="val">

		<a href='#' id='firstName'
			data-type="text"
			data-pk="<?php echo h($customer['Customer']['id']); ?>"
			data-url="/resto/customers/editAjax/<?php echo h($customer['Customer']['id']); ?>"
			data-title="Prénom"><?php echo h($customer['Customer']['firstName']); ?>
		</a>

		</li>
	</ul><ul class='clearfix back'>
		<li class="tit"><?php echo __('Groupe'); ?></li>
		<li class="val">

		<a href='#' id='groupName'
			data-type="text"
			data-pk="<?php echo h($customer['Customer']['id']); ?>"
			data-url="/resto/customers/editAjax/<?php echo h($customer['Customer']['id']); ?>"
			data-title="Groupe"><?php echo h($customer['Customer']['groupName']); ?>
		</a>

		</li>
	</ul><ul class='clearfix'>
		<li class="tit"><?php echo __('Téléphone'); ?></li>
		<li class="val">

		<a href='#' id='phone'
			data-type="text"
			data-pk="<?php echo h($customer['Customer']['id']); ?>"
			data-url="/resto/customers/editAjax/<?php echo h($customer['Customer']['id']); ?>"
			data-title="Téléphone"><?php echo h($customer['Customer']['phone']); ?>
		</a>

		</li>
	</ul><ul class='clearfix back'>
		<li class="tit"><?php echo __('Travail'); ?></li>
		<li class="val">

		<a href='#' id='work'
			data-type="text"
			data-pk="<?php echo h($customer['Customer']['id']); ?>"
			data-url="/resto/customers/editAjax/<?php echo h($customer['Customer']['id']); ?>"
			data-title="Travail"><?php echo h($customer['Customer']['work']); ?>
		</a>

		</li>
	</ul><ul class='clearfix'>
		<li class="tit"><?php echo __('Fax'); ?></li>
		<li class="val">

		<a href='#' id='fax'
			data-type="text"
			data-pk="<?php echo h($customer['Customer']['id']); ?>"
			data-url="/resto/customers/editAjax/<?php echo h($customer['Customer']['id']); ?>"
			data-title="Fax"><?php echo h($customer['Customer']['fax']); ?>
		</a>

		</li>
	</ul><ul class='clearfix back'>
		<li class="tit"><?php echo __('Courriel'); ?></li>
		<li class="val">

		<a href='#' id='email'
			data-type="text"
			data-pk="<?php echo h($customer['Customer']['id']); ?>"
			data-url="/resto/customers/editAjax/<?php echo h($customer['Customer']['id']); ?>"
			data-title="Courriel"><?php echo h($customer['Customer']['email']); ?>
		</a>

		</li>
	</ul><ul class='clearfix'>
		<li class="tit"><?php echo __('Notes'); ?></li>
		<?php ($customer['Customer']['note'] != null) ? $red='red' : $red=''; ?>
		<li class="val">

		<a href='#' id='note'
			data-type="text"
			data-pk="<?php echo h($customer['Customer']['id']); ?>"
			data-url="/resto/customers/editAjax/<?php echo h($customer['Customer']['id']); ?>"
			data-title="Notes"><?php echo h($customer['Customer']['note']); ?>
		</a>

		</li>
	</ul>
	<?php if ($reserv != array()) { ?>
		<ul class='clearfix'>
			<li><b>Réservations en cours :</b></li>
			<li></li>
		</ul>
			<ul class='clearfix res'>
			<?php foreach ($reserv as $key => $value) { ?>
			<li><?php echo $this->Html->link($value['Event']['start'], array('plugin'=>'full_calendar', 'controller' => 'events', 'action' => 'add', $value['Event']['id']), array ("class"=>"btn btn-sm btn-primary", "role"=>"button")); ?></li>
			<?php } ?>
		</ul>
	<?php } ?>
	<ul class='clearfix'>
			<?php $_SESSION['idCustomer'] = $customer['Customer']['id']; ?>
			<li><?php echo $this->Html->link('Réserver', array('plugin'=>'full_calendar', 'controller' => 'events', 'action' => 'add'), array ("class"=>"btn btn-sm btn-warning", "role"=>"button")); ?></li>
		</ul>
</div>


<?php
$this->Html->scriptStart( array('inline' => true));
?>


$(document).ready(function() {

$.fn.editable.defaults.mode = 'block';
$.fn.editable.defaults.emptytext = 'Vide';
$.fn.editable.defaults.ajaxOptions= { type: 'post', dataType: 'json' };
$.fn.editable.defaults.error=  function(response, newValue) {
    if(response.status === 500) {
    return 'Impossible de modifier ce champs.';
    };
    }



$.fn.editable.defaults.success= function(response, config) {
		if(response.success == true) {
			$("#modall").removeClass("alert-danger").addClass("alert-success");
			$("#modall p").empty().append( response.msg );
			$('#modall').show();
		};
	};

	$('#lastName').editable();
	$('#firstName').editable();
	$('#groupName').editable();
	$('#phone').editable();
	$('#work').editable();
	$('#fax').editable();
	$('#email').editable();
	$('#note').editable();


	mamail = $('#email').text();
	//alert(mamail);


});

<?php
echo $this->Html->scriptEnd(array('inline' => true));