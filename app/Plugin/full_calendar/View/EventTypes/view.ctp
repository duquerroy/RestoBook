<div class="reserv panel panel-default">
	<div class="panel-heading">
		<div id="dialogModal">
			<div class="contentWrap">
			</div>
		</div>
		<div class="eventTypes view popupevent">
		<h2><?php echo __('Salles'); ?></h2>
			<ul class='clearfix back'>
				<li class="tit"><?php echo __('Nom'); ?></li>
				<li><?php echo h($eventType['EventType']['name']); ?>&nbsp;</li>
			</ul><ul class='clearfix'>
				<li class="tit"><?php echo __('Couleur'); ?></li>
				<li class="<?php echo h($eventType['EventType']['color']); ?>"><?php echo h($eventType['EventType']['color']); ?> &nbsp; </li>
			</ul><ul class='clearfix back'>
				<li class="tit"><?php echo __('Capacité'); ?></li>
				<li> <?php echo h($eventType['EventType']['capacity']); ?> &nbsp; </li>
			</ul><ul class='clearfix'>
				<li class="tit"><?php echo __('À partir du mois'); ?></li>
				<li> <?php echo h($eventType['EventType']['month_from']); ?>&nbsp;</li>
			</ul><ul class='clearfix back'>
				<li class="tit"><?php echo __('Jusqu\'au mois'); ?></li>
				<li><?php echo h($eventType['EventType']['month_to']); ?>&nbsp;</li>
			</ul><ul class='clearfix'>
				<li class="tit"><?php echo __('Salle parente'); ?></li>
				</li>
				<li><?php echo h($nameparent); ?>&nbsp;</li>
			</ul>
			<?php echo $this->Html->link(__('Modifier salle'), array('action' => 'edit', $eventType['EventType']['id'])); ?>
			<?php echo $this->Form->postLink(__('Supprimer salle'), array('action' => 'delete', $eventType['EventType']['id']), null, __('Are you sure you want to delete # %s?', $eventType['EventType']['id'])); ?>
			<?php echo $this->Html->link(__('Liste des salles'), array('action' => 'index')); ?>
			<?php echo $this->Html->link(__('Création salle'), array('action' => 'add')); ?>
			<?php echo $this->Html->link(__('Nouvelle réservation'), array('controller' => 'events', 'action' => 'add')); ?>
		</div>


		<div class="related">
			<h3><?php echo __('Réservations dans cette salle pour le '); ?><?= $date->format('Y-m-d');  ?></h3>
			<?php if (!empty($eventType['Event'])): ?>
				<?php $nbrClientTotal1 = 0; ?>
				<?php foreach ($eventType['Event'] as $event): ?>
					<?php 
					$compDate = substr($event['start'], 0, 10); 
					if ( $compDate ==  $date->format('Y-m-d')) {
						?>
						<ul class='clearfix reserv'>
						<?php $start = substr($event['start'], -9); ?>
						<?php $end = substr($event['end'], -9); ?>
						<?php $nbrClient =  $event['size_adulte'] + $event['size_enfant'] + $event['size_3ans']; ?>
						<?php $nbrClientTotal1 += $nbrClient; ?>

						<?php (($event['notes'] !='') || ($event['special_clause'] != ''))? $flech = "flech" : $flech=''; ?>
						<?php ($event['status'] =='Prévu')? $btn = "btn-info" :( ($event['status'] =='Confirmé')? $btn = "btn-success" : $btn=''); ?>
						<?php ($event['block_resto'] == 1)? $restoBlock = "restoBlock" : $restoBlock='small'; ?>
						<?php ($event['block_room'] == 1)? $block_room = "block_room" : $block_room=''; ?>
						<?php ($event['nb_tables'] > 0)? $table = "nbrTable" : $table='small'; ?>


						<li class="clock <?= $flech; ?>"><?php echo h($start); ?>&nbsp;<?php echo h($end); ?></li>
						<li class="person"><?php echo $customers[$event['customer_id']]; ?>&nbsp;</li>
						<li class='nbr'><?php echo h($nbrClient); ?>&nbsp;</li>
						<li class="<?= $restoBlock; ?>">&nbsp;</li>
						<li class="<?= $table; ?>"><?php echo h($event['nb_tables']); ?>&nbsp;</li>
						<li class="room <?= $block_room; ?>"><?php echo $eventTypes[$event['event_type_id']]; ?>&nbsp;</li>

						<li id="<?= $event['id']; ?>" class="prev btn-xs <?= $btn  ?>"> <a href="#"><?= $event['status'] ?> </a></li>

						<li class="action"><?php echo $this->Html->link(__(''), array('controller'=>'Events', 'action' => 'viewover', $event['id']), array ("class"=>"overlay action1", "title"=>"Réservation")); ?></li>


						<li class="action "><?php echo $this->Html->link(__(''), array('controller'=>'Events', 'action' => 'add', $event['id']), array ("class"=>"action2")); ?></li>
						<li class="action "><?php echo $this->Form->postLink(__(''), array('controller'=>'Events', 'action' => 'delete', $event['id']), array ("class"=>"action3"), __('Are you sure you want to delete # %s?', $event['id'])); ?></li>
						</ul>
						<div class="boto boto1">
						<p>Notes : <?php echo h($event['notes']); ?>&nbsp;</p>
						<p>Clauses Spéciales : <?php echo h($event['special_clause']); ?>&nbsp;</p>
						</div>
					<?php } ?>

				<?php endforeach; ?>
				<br/>
				<p class="restoBlock"> => Restaurant bloqué</p>
				<p class="flech">=> Informations complémentaires disponibles, cliquez</p>
				<p class="nbrTable">=> Nombre de tables</p>
				<p class="block_roomP">=> Salle bloquée</p>
			<?php endif; ?>
		</div>
	</div>
</div>

<?php
$this->Html->scriptStart( array('inline' => false));
?>
	$(".person, .clock").click(function(){
	 	<!-- $(".boto").hide( "fast" ); -->
	 	$(this).parent().next(".boto").toggle( "fast" );
	});

	$( ".prev" ).on( "click", function() {

		// l'id se cache dans l'id du li
		var id = ($(this).attr('id'));

		if ( $(this).hasClass("btn-info") == true) {
			$.ajax({
				url: "\/resto\/full_calendar\/Events\/changeStatus\/"+id,
				context: $( this )
				}).done(function() {
				$( this ).addClass( "btn-success" ).removeClass("btn-info").text("Confirmé");
			});

		} else {

			$.ajax({
				url: "\/resto\/full_calendar\/Events\/changeStatus\/"+id,
				context: $( this )
				}).done(function() {
				$( this ).addClass( "btn-info" ).removeClass("btn-success").text("Prévu");
			});

		}
	});


	//popup view reservation
    $(document).ready(function() {
        //prepare the dialog
        $( "#dialogModal" ).dialog({
            position: ['middle',100],
            autoOpen: false,
            width: 600,
            show: {
                effect: "fade",
                duration: 300
                },
            hide: {
                effect: "fade",
                duration: 300
                },
            modal: true
            });
        //respond to click event on anything with 'overlay' class
        $(".overlay").click(function(event){
            $('.contentWrap').load($(this).attr("href"));  //load content from href of link
            $('#dialogModal').dialog('option', 'title', $(this).attr("title"));  //make dialog title that of link
            $('#dialogModal').dialog('open');  //open the dialog
            event.preventDefault();
            });


        // $( document ).on( "click", ".submit", function() {
        //   console.log('pou');
        //   //$('#dialogModal').dialog('close');  //close containing dialog

        // });
    });




<?php
echo $this->Html->scriptEnd(array('inline' => false));
?>
