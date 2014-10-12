<div class="box">
<?= $this->Form->create('User'); ?>
	<?= $this->Form->input('username', array('placeholder' => 'Identifiant', 'label' => '', 'value' => '')); ?>
	<?= $this->Form->input('password', array('placeholder' => 'Mot de passe', 'label' => '', 'value' => '')); ?>

<?= $this->Form->end('Se connecter'); ?>
</div>

