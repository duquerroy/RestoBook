<ul class="nav">

          <li><?= $this->Html->link('Dashboard', array('plugin'=>'full_calendar', 'controller' => 'events', 'action' => 'dashboard')); ?></li>
          <li class="has-sub"><a href="javascript:;">
                <span>Réservations</span>
            </a>
            <ul class="sub-menu" >
              <li><?= $this->Html->link('Calendrier', array('controller' => 'full_calendar', 'action' => 'index')); ?></li>
              <li><?= $this->Html->link('Liste', array('plugin'=>'full_calendar', 'controller' => 'events', 'action' => 'index')); ?></li>
              <li><?= $this->Html->link('Ce jour', array('plugin'=>'full_calendar', 'controller' => 'events', 'action' => 'today')); ?></li>
              <li><?= $this->Html->link('Demain', array('plugin'=>'full_calendar', 'controller' => 'events', 'action' => 'today', 1)); ?></li>
              <li><?= $this->Html->link('+7 jours', array('plugin'=>'full_calendar', 'controller' => 'events', 'action' => 'today', 7)); ?></li>
              <li><?= $this->Html->link(__('Nouvelle', true), array('plugin' => 'full_calendar', 'controller' => 'events', 'action' => 'add')); ?></li>
            </ul>
          </li>

          <li class="has-sub"><a href="javascript:;">
                <span>Clients</span>
            </a>
            <ul class="sub-menu" >
              <li><?php echo $this->Html->link(__('Liste'), array('plugin'=>'', 'controller' => 'customers', 'action' => 'index')); ?> </li>
              <li><?php echo $this->Html->link(__('Nouveau'), array('plugin'=>'', 'controller' => 'customers' , 'action' => 'add')); ?></li>
            </ul>
          </li>

          <li class="has-sub"><a href="javascript:;">
                <span>Salles</span>
            </a>
            <ul class="sub-menu" >
              <li><?php echo $this->Html->link(__('Liste'), array('plugin'=>'full_calendar', 'controller' => 'EventTypes', 'action' => 'index')); ?> </li>
              <li><?php echo $this->Html->link(__('Nouvelle'), array('plugin'=>'full_calendar', 'controller' => 'EventTypes' , 'action' => 'add')); ?></li>
            </ul>
          </li>

          <li class="has-sub"><a href="javascript:;">
                <span>Utilisateurs</span>
            </a>
            <ul class="sub-menu" >
              <li><?php echo $this->Html->link(__('Liste'), array('plugin'=>'', 'controller' => 'Users', 'action' => 'index')); ?> </li>
              <li><?php echo $this->Html->link(__('Nouveau'), array('plugin'=>'', 'controller' => 'Users' , 'action' => 'add')); ?></li>
            </ul>
          </li>
          <li><?= $this->Html->link('Options', array('plugin'=>'', 'controller' => 'settings', 'action' => 'index')); ?></li>

        </ul>