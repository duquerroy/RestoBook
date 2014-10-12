<!doctype html>
<!--[if IE 9]><html class="lt-ie10" lang="en" > <![endif]-->
<html class="no-js" lang="fr" data-useragent="Mozilla/5.0 (compatible; MSIE 10.0; Windows NT 6.2; Trident/6.0)">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>RestoBook</title>


    <meta name="description" content="Documentation and reference library for ZURB Foundation. JavaScript, CSS, components, grid and more." />

    <meta name="author" content="ZURB, inc. ZURB network also includes zurb.com" />
    <meta name="copyright" content="ZURB, inc. Copyright (c) 2013" />
  <?php echo $this->html->css('foundation'); ?>
  <?php echo $this->html->css('jquery-ui-1.10.4.custom'); ?>

	<?php echo $this->html->css('jquery-ui-timepicker-addon'); ?>

	<?php echo $this->html->script('vendor/modernizr'); ?>
  <?php echo $this->html->script('jquery-1.10.2'); ?>
  <?php echo $this->html->script('jquery-ui-1.10.4.custom.min'); ?>

  <?php echo $this->html->script('jquery-ui-sliderAccess'); ?>
  <?php echo $this->html->script('jquery-ui-timepicker-addon'); ?>

  </head>
  <body>



<!-- Header and Nav -->

  <div class="row">
    <div class="large-3 columns">
      <h1><img src="" /></h1>
    </div>
    <div class="large-9 columns">
      <ul class="inline-list right">
       <li><?= $this->Html->link('Customers', array('plugin'=>'', 'controller' => 'customers', 'action' => 'index')); ?></li>
       <li><?= $this->Html->link('Rooms', array('plugin'=>'', 'controller' => 'EventTypes', 'action' => 'index')); ?></li>
       <li><?= $this->Html->link('Calendrier', array('controller' => 'full_calendar', 'action' => 'index')); ?></li>
       <li><?= $this->Html->link('Item Meta', array('plugin'=>'', 'controller' => 'AzFrmItemMetas', 'action' => 'index')); ?></li>
        <?php if ($this->Session->read('Auth.User.id')): ?>
        <li><?= $this->Html->link('Se déconnecter', array('plugin'=>'', 'controller' => 'users', 'action' => 'logout')); ?></li>
        <?php endif ?>
      </ul>
    </div>
  </div>

  <!-- End Header and Nav -->


  <div class="row">

    <!-- Main Content Section -->
    <!-- This has been source ordered to come first in the markup (and on small devices) but to be to the right of the nav on larger screens -->
    <div class="large-9 columns">

      <h3>Page Title <small>Page subtitle</small></h3>
      			<?php echo $this->fetch('content'); ?>

    </div>


    <!-- Nav Sidebar -->
    <!-- This is source ordered to be pulled to the left on larger screens -->
<!--     <div class="large-3 pull-9 columns">

      <ul class="side-nav">
        <li><a href="#">Section 1</a></li>
        <li><a href="#">Section 2</a></li>
        <li><a href="#">Section 3</a></li>
        <li><a href="#">Section 4</a></li>
        <li><a href="#">Section 5</a></li>
        <li><a href="#">Section 6</a></li>
      </ul>

      <p><img src="http://lorempixel.com/320/240/" /></p>

    </div> -->

  </div>


  <!-- Footer -->

  <footer class="row">
    <div class="large-12 columns">
      <hr />
      <div class="row">
        <div class="large-6 columns">
          <p>&copy; Copyright no one at all. Go to town.</p>
        </div>
        <div class="large-6 columns">
          <ul class="inline-list right">
            <li><a href="#">Section 1</a></li>
            <li><a href="#">Section 2</a></li>
            <li><a href="#">Section 3</a></li>
            <li><a href="#">Section 4</a></li>
          </ul>
        </div>
      </div>
    </div>
  </footer>

	<?php echo $this->html->script('foundation/foundation'); ?>
  <script>
    $(function() {
     // $.datepicker.setDefaults( $.datepicker.regional['fr']);

     $("#datetimepicker").datetimepicker(
        {
           dateFormat: 'yy/mm/dd',
           onSelect: function(date){
              $('#datetimepicker1').datetimepicker('option', 'minDate', date);
           },
          onClose: function(dateText) {
            $('#datetimepicker1').val(dateText)
          }
        }

      );

     $("#datetimepicker1").datetimepicker(
        {
           dateFormat: 'yy/mm/dd',
           // onSelect: function(date){
           //    $('#datetimepicker').datetimepicker('option', 'maxDate', date);
           // },
        }
      );

    });

  </script>

    <script>
      $(document).foundation();

      var doc = document.documentElement;
      doc.setAttribute('data-useragent', navigator.userAgent);
    </script>
<?php
//echo $this->Html->script(array('/full_calendar/js/jquery-1.5.min', '/full_calendar/js/jquery-ui-1.8.9.custom.min', '/full_calendar/js/fullcalendar.min', '/full_calendar/js/jquery.qtip-1.0.0-rc3.min', '/full_calendar/js/ready'), array('inline' => 'false'));
//echo $this->Html->css('/full_calendar/css/fullcalendar');
?>
  </body>
</html>