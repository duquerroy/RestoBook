<div class="reserv panel panel-default">
	<div class="panel-heading">
		<div id="dialogModal">
		     <div class="contentWrap">
		     </div>
		</div>
		<span class='boutPrint btn-xs btn-warning'><a href="javascript:window.print();" class='action5'>Imprimer</a></span>


		<?php if ($id == 7): ?>
			<h3 class="panel-title"><?php echo __('Réservations'); ?> du <?= $date->format('Y-m-d').' au '.$datef->format('Y-m-d');  ?></h3>
		<?php else: ?>
			<h3 class="panel-title"><?php echo __('Réservations'); ?> du <?= $date->format('Y-m-d');  ?></h3>
		<?php endif ?>

	</div>
	<div class="panel-body">
		<h4>Déjeuner <span class="nbrClientTotal1"> couverts</span></h4>
		<?php if ($events == array()) echo "<p>Aucune réservation</p>"; ?>
		<?php $nbrClientTotal1 = 0; ?>
		<?php foreach ($events as $event): ?>
			<ul class='clearfix reserv'>
				<?php if ($id == 7):
					  $start = ($event['Event']['start']);
				 else:
					  $start = substr($event['Event']['start'], -9);
				 endif ?>
				<?php  $end = substr($event['Event']['end'], -9); ?>
				<?php $nbrClient =  $event['Event']['size_adulte'] + $event['Event']['size_enfant'] + $event['Event']['size_3ans']; ?>
				<?php $nbrClientTotal1 += $nbrClient; ?>

				<?php (($event['Event']['notes'] !='') || ($event['Event']['special_clause'] != ''))? $flech = "flech" : $flech=''; ?>
				<?php ($event['Event']['status'] =='Prévu')? $btn = "btn-info" :( ($event['Event']['status'] =='Confirmé')? $btn = "btn-success" : $btn=''); ?>
				<?php ($event['Event']['block_resto'] == 1)? $restoBlock = "restoBlock" : $restoBlock='small'; ?>
				<?php ($event['Event']['block_room'] == 1)? $block_room = "block_room" : $block_room=''; ?>
				<?php ($event['Event']['nb_tables'] > 0)? $table = "nbrTable" : $table='small'; ?>


				<li class="clock <?= $flech; ?>"><?php echo h($start); ?>&nbsp;<?php echo h($end); ?></li>
				<li class="person"><?php echo $customers[$event['Event']['customer_id']]; ?>&nbsp;</li>
				<li class='nbr'><?php echo h($nbrClient); ?>&nbsp;</li>
				<li class="<?= $restoBlock; ?>">&nbsp;</li>
				<li class="<?= $table; ?>"><?php echo h($event['Event']['nb_tables']); ?>&nbsp;</li>
				<li class="room <?= $block_room; ?>"><?php echo $eventTypes[$event['Event']['event_type_id']]; ?>&nbsp;</li>

				<li id="<?= $event['Event']['id']; ?>" class="prev btn-xs <?= $btn  ?>"> <a href="#"><?= $event['Event']['status'] ?> </a></li>

				<li class="action"><?php echo $this->Html->link(__(''), array('action' => 'viewover', $event['Event']['id']), array ("class"=>"overlay action1", "title"=>"Réservation")); ?></li>


				<li class="action "><?php echo $this->Html->link(__(''), array('action' => 'add', $event['Event']['id']), array ("class"=>"action2")); ?></li>
				<li class="action "><?php echo $this->Form->postLink(__(''), array('action' => 'delete', $event['Event']['id']), array ("class"=>"action3"), __('Are you sure you want to delete # %s?', $event['Event']['id'])); ?></li>
			</ul>
			<div class="boto boto1">
			<?php if  (( $event['Event']['notes'] != '' ) || ($event['Event']['special_clause'] !='') ) {	?>
				<p class="notes"><?php echo h($event['Event']['notes']); ?>&nbsp;</p>
				<p class="clauses"><?php echo h($event['Event']['special_clause']); ?>&nbsp;</p>
			<?php }	?>
			</div>
		<?php endforeach; ?>

		<h4>Diner <span class="nbrClientTotal2"> couverts</span></h4>
		<?php if ($events1 == array()) echo "<p>Aucune réservation</p>"; ?>
		<?php $nbrClientTotal2 = 0; ?>
		<?php foreach ($events1 as $event): ?>
			<ul class='clearfix reserv'>
				<?php if ($id == 7):
					  $start = ($event['Event']['start']);
				 else:
					  $start = substr($event['Event']['start'], -9);
				 endif ?>
				<?php  $end = substr($event['Event']['end'], -9); ?>
				<?php $nbrClient =  $event['Event']['size_adulte'] + $event['Event']['size_enfant'] + $event['Event']['size_3ans']; ?>
				<?php $nbrClientTotal2 += $nbrClient; ?>

				<?php (($event['Event']['notes'] !='') || ($event['Event']['special_clause'] != ''))? $flech = "flech" : $flech=''; ?>
				<?php ($event['Event']['status'] =='Prévu')? $btn = "btn-info" :( ($event['Event']['status'] =='Confirmé')? $btn = "btn-success" : $btn=''); ?>
				<?php ($event['Event']['block_resto'] == 1)? $restoBlock = "restoBlock" : $restoBlock='small'; ?>
				<?php ($event['Event']['block_room'] == 1)? $block_room = "block_room" : $block_room=''; ?>
				<?php ($event['Event']['nb_tables'] > 0)? $table = "nbrTable" : $table='small'; ?>


				<li class="clock clock1 <?= $flech; ?>"><?php echo h($start); ?>&nbsp;<?php echo h($end); ?></li>
				<li class="person"><?php echo $customers[$event['Event']['customer_id']]; ?>&nbsp;</li>
				<li class='nbr'><?php echo h($nbrClient); ?>&nbsp;</li>
				<li class="<?= $restoBlock; ?>">&nbsp;</li>
				<li class="<?= $table; ?>"><?php echo h($event['Event']['nb_tables']); ?>&nbsp;</li>
				<li class="room <?= $block_room; ?>"><?php echo $eventTypes[$event['Event']['event_type_id']]; ?>&nbsp;</li>
				<li id="<?= $event['Event']['id']; ?>" class="prev btn-xs <?= $btn  ?>"> <a href="#"><?= $event['Event']['status'] ?> </a></li>

				<li class="action"><?php echo $this->Html->link(__(''), array('action' => 'viewover', $event['Event']['id']), array ("class"=>"overlay action1", "title"=>"Réservation")); ?></li>
				<li class="action "><?php echo $this->Html->link(__(''), array('action' => 'add', $event['Event']['id']), array ("class"=>"action2")); ?></li>
				<li class="action "><?php echo $this->Form->postLink(__(''), array('action' => 'delete', $event['Event']['id']), array ("class"=>"action3"), __('Are you sure you want to delete # %s?', $event['Event']['id'])); ?></li>
			</ul>
			<div class="boto boto2">
			<?php if  (( $event['Event']['notes'] != '' ) || ($event['Event']['special_clause'] !='') ) {	?>
				<p class="notes"><?php echo h($event['Event']['notes']); ?>&nbsp;</p>
				<p class="clauses"><?php echo h($event['Event']['special_clause']); ?>&nbsp;</p>
			<?php }	?>
			</div>

		<?php endforeach; ?>

		<h4>Souper <span class="nbrClientTotal3"> couverts</span></h4>
		<?php if ($events2 == array()) echo "<p>Aucune réservation</p>"; ?>
		<?php $nbrClientTotal3 = 0; ?>
		<?php foreach ($events2 as $event): ?>
			<ul class='clearfix reserv'>
				<?php if ($id == 7):
					  $start = ($event['Event']['start']);
				 else:
					  $start = substr($event['Event']['start'], -9);
				 endif ?>
				<?php  $end = substr($event['Event']['end'], -9); ?>
				<?php $nbrClient =  $event['Event']['size_adulte'] + $event['Event']['size_enfant'] + $event['Event']['size_3ans']; ?>
				<?php $nbrClientTotal3 += $nbrClient; ?>

				<?php (($event['Event']['notes'] !='') || ($event['Event']['special_clause'] != ''))? $flech = "flech" : $flech=''; ?>
				<?php ($event['Event']['status'] =='Prévu')? $btn = "btn-info" :( ($event['Event']['status'] =='Confirmé')? $btn = "btn-success" : $btn=''); ?>
				<?php ($event['Event']['block_resto'] == 1)? $restoBlock = "restoBlock" : $restoBlock='small'; ?>
				<?php ($event['Event']['block_room'] == 1)? $block_room = "block_room" : $block_room=''; ?>
				<?php ($event['Event']['nb_tables'] > 0)? $table = "nbrTable" : $table='small'; ?>


				<li class="clock clock2 <?= $flech; ?>"><?php echo h($start); ?>&nbsp;<?php echo h($end); ?></li>
				<li class="person"><?php echo $customers[$event['Event']['customer_id']]; ?>&nbsp;</li>
				<li class='nbr'><?php echo h($nbrClient); ?>&nbsp;</li>
				<li class="<?= $restoBlock; ?>">&nbsp;</li>
				<li class="<?= $table; ?>"><?php echo h($event['Event']['nb_tables']); ?>&nbsp;</li>
				<li class="room <?= $block_room; ?>"><?php echo $eventTypes[$event['Event']['event_type_id']]; ?>&nbsp;</li>

				<li id="<?= $event['Event']['id']; ?>" class="prev btn-xs <?= $btn  ?>"> <a href="#"><?= $event['Event']['status'] ?> </a></li>

				<li class="action"><?php echo $this->Html->link(__(''), array('action' => 'viewover', $event['Event']['id']), array ("class"=>"overlay action1", "title"=>"Réservation")); ?></li>
				<li class="action "><?php echo $this->Html->link(__(''), array('action' => 'add', $event['Event']['id']), array ("class"=>"action2")); ?></li>
				<li class="action "><?php echo $this->Form->postLink(__(''), array('action' => 'delete', $event['Event']['id']), array ("class"=>"action3"), __('Are you sure you want to delete # %s?', $event['Event']['id'])); ?></li>
			</ul>
			<div class="boto boto3">
			<?php if  (( $event['Event']['notes'] != '' ) || ($event['Event']['special_clause'] !='') ) {	?>
				<p class="notes"><?php echo h($event['Event']['notes']); ?>&nbsp;</p>
				<p class="clauses"><?php echo h($event['Event']['special_clause']); ?>&nbsp;</p>
			<?php }	?>
			</div>


		<?php endforeach; ?>

		<h4>Journée <span class="nbrClientTotal4"> couverts</span></h4>
		<?php if ($events3 == array()) echo "<p>Aucune réservation</p>"; ?>
		<?php $nbrClientTotal4 = 0; ?>
		<?php foreach ($events3 as $event): ?>
			<ul class='clearfix reserv'>
				<?php  $start = substr($event['Event']['start'], 0, 10); ?>
				<?php $nbrClient =  $event['Event']['size_adulte'] + $event['Event']['size_enfant'] + $event['Event']['size_3ans']; ?>
				<?php $nbrClientTotal4 += $nbrClient; ?>

				<?php (($event['Event']['notes'] !='') || ($event['Event']['special_clause'] != ''))? $flech = "flech" : $flech=''; ?>
				<?php ($event['Event']['status'] =='Prévu')? $btn = "btn-info" :( ($event['Event']['status'] =='Confirmé')? $btn = "btn-success" : $btn=''); ?>
				<?php ($event['Event']['block_resto'] == 1)? $restoBlock = "restoBlock" : $restoBlock='small'; ?>
				<?php ($event['Event']['block_room'] == 1)? $block_room = "block_room" : $block_room=''; ?>
				<?php ($event['Event']['nb_tables'] > 0)? $table = "nbrTable" : $table='small'; ?>


				<li class="clock clock3 <?= $flech; ?>"><?php echo h($start); ?>&nbsp;</li>
				<li class="person"><?php echo $customers[$event['Event']['customer_id']]; ?>&nbsp;</li>
				<li class='nbr'><?php echo h($nbrClient); ?>&nbsp;</li>
				<li class="<?= $restoBlock; ?>">&nbsp;</li>
				<li class="<?= $table; ?>"><?php echo h($event['Event']['nb_tables']); ?>&nbsp;</li>
				<li class="room <?= $block_room; ?>"><?php echo $eventTypes[$event['Event']['event_type_id']]; ?>&nbsp;</li>
				<li id="<?= $event['Event']['id']; ?>" class="prev btn-xs <?= $btn  ?>"> <a href="#"><?= $event['Event']['status'] ?> </a></li>

				<li class="action"><?php echo $this->Html->link(__(''), array('action' => 'viewover', $event['Event']['id']), array ("class"=>"overlay action1", "title"=>"Réservation")); ?></li>
				<li class="action "><?php echo $this->Html->link(__(''), array('action' => 'add', $event['Event']['id']), array ("class"=>"action2")); ?></li>
				<li class="action "><?php echo $this->Form->postLink(__(''), array('action' => 'delete', $event['Event']['id']), array ("class"=>"action3"), __('Are you sure you want to delete # %s?', $event['Event']['id'])); ?></li>
			</ul>
			<div class="boto boto4">
			<?php if  (( $event['Event']['notes'] != '' ) || ($event['Event']['special_clause'] !='') ) {	?>
				<p class="notes"><?php echo h($event['Event']['notes']); ?>&nbsp;</p>
				<p class="clauses"><?php echo h($event['Event']['special_clause']); ?>&nbsp;</p>
			<?php }	?>
			</div>


		<?php endforeach; ?>
		<br/>
	<p class="restoBlock"> => Restaurant bloqué</p>
	<p class="flech">=> Informations complémentaires disponibles, cliquez</p>
	<p class="nbrTable">=> Nombre de tables</p>
	<p class="block_roomP">=> Salle bloquée</p>
	</div>
</div>



<?php
$this->Html->scriptStart( array('inline' => false));
?>
	$(".person, .clock").click(function(){
	 	<!-- $(".boto").hide( "fast" ); -->
	 	$(this).parent().next(".boto").toggle( "fast" );
	});
	$(".nbrClientTotal1").prepend(<?php echo $nbrClientTotal1 ?>);
	$(".nbrClientTotal2").prepend(<?php echo $nbrClientTotal2 ?>);
	$(".nbrClientTotal3").prepend(<?php echo $nbrClientTotal3 ?>);
	$(".nbrClientTotal4").prepend(<?php echo $nbrClientTotal4 ?>);

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