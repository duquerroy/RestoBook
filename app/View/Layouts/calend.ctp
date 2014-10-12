<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" href="../../assets/ico/favicon.ico">

    <title>RestoBook</title>

    <!-- Bootstrap core CSS -->
    <?php echo $this->html->css('bootstrap') ?>
    <?php echo $this->html->css('bootstrap-theme.min') ?>
    <?php echo $this->html->css('style'); ?>
    <!-- Bootstrap theme -->
    <?= $this->fetch('css'); ?>


  </head>

  <body role="document">



     <!-- Fixed navbar -->
    <div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
      <div class="container">

        <div class="navbar-header">
          <a class="navbar-brand" href="full_calendar">RestoBook -> <?= $title_for_layout; ?></a>


          <?php // echo $this->Html->link('Accueil', array('controller' => 'full_calendar', 'action' => 'index'), array ('class' => 'navbar-brand') ); ?>
        </div>

        <div class="navbar-collapse collapse">

        <div id='modall' class='alert  navbar-left' style="display:none">
              <a href="#" class="close" onclick="$(this).parent().slideUp()">X</a>
              <p></p>
        </div>

          <ul class="nav navbar-nav navbar-right">
            <?php if ($this->Session->read('Auth.User.id')): ?>
            <li><?= $this->Html->link('Utilisateur : '.$this->Session->read('Auth.User.username').' --- Déconnexion ---', array('plugin'=>'', 'controller' => 'users', 'action' => 'logout')); ?></li>
            <?php endif ?>
          </ul>
        </div><!--/.nav-collapse -->

      </div>
    </div>

    <div class="container theme-showcase" role="main">

    <!-- Main jumbotron for a primary marketing message or call to action -->
      <!-- <div class="jumbotron">
        <h1>HotelRestoBooking.com</h1>
        <p>Gestion des réservations en ligne</p>
      </div> -->
      <div id="sidebar" class="sidebar">
        <?php echo $this->element('sidebar'); ?>
      </div>


      <div class="page-header">

        <?= $this->Session->flash(); ?>
        <?= $this->Session->flash('auth'); ?>



        <?= $this->fetch('content'); ?>

      </div>



    </div> <!-- /container -->


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
<!--     <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
    <script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.10.4/jquery-ui.min.js"></script> -->
    <?php echo $this->html->script('/full_calendar/js/jquery-1.5.min') ?>
    <?php echo $this->html->script('/full_calendar/js/jquery-ui-1.8.9.custom.min') ?>
    <?php echo $this->html->script('bootstrap.min') ?>
    <?php echo $this->html->css('font-awesome'); ?>

    <?php echo $this->html->script('resto') ?>


    <script>
      var url = window.location;
      // Will only work if string in href matches with location
      $('ul.nav a[href="'+ url +'"]').parent().addClass('active');

      // Will also work for relative and absolute hrefs
      $('ul.nav a').filter(function() {
        return this.href == url;
      }).parent().addClass('active');
    </script>

    <script>
      // storage l'heure d'ouverture du resto pour la passer au calendar (ready.js)
      localStorage.setItem('dateStartCalend', '<?php echo $dateStartCalend; ?>');
    </script>



    <?php
    echo $this->Html->script(array('/full_calendar/js/fullcalendar.min', '/full_calendar/js/jquery.qtip-1.0.0-rc3.min', '/full_calendar/js/ready'), array('inline' => 'false'));
    echo $this->Html->css('/full_calendar/css/fullcalendar');
    ?>


    <?= $this->fetch('script'); ?>
  </body>
</html>
