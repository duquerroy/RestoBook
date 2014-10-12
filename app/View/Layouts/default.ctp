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
    <?php echo $this->html->css('jquery-ui-1.10.4.custom.min') ?>
    <?php echo $this->html->css('jquery-ui-timepicker-addon'); ?>
    <?php echo $this->html->css('font-awesome'); ?>
    <?php echo $this->html->css('style'); ?>
    <?php echo $this->html->css('chosen/chosen.min'); ?>
    <?php echo $this->html->css('DataTables/jquery.dataTables.min'); ?>
    <?php echo $this->Html->css('/full_calendar/css/fullcalendar'); ?>
    <?php echo $this->Html->css('jquery-editable'); ?>
    <?php echo $this->html->css(array('print'), 'stylesheet', array('media' => 'print')); ?>
    <!-- Bootstrap theme -->
    <?= $this->fetch('css'); ?>


  </head>

  <body role="document">

    <!-- Fixed navbar -->
    <div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
      <div class="container">
        <div class="navbar-header">
          <a class="navbar-brand" href="">RestoBook -> <?= $title_for_layout; ?></a>
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

      <div id="sidebar" class="sidebar">
        <?php echo $this->element('sidebar'); ?>
      </div>

      <div class="page-header">

        <?= $this->Session->flash(); ?>
        <?= $this->Session->flash('auth'); ?>

        <?= $this->fetch('content'); ?>

      </div>
<?php //echo $this->element('sql_dump'); ?>


    </div> <!-- /container -->



    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
    <script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.10.4/jquery-ui.min.js"></script>
    <?php //echo $this->html->script('/full_calendar/js/jquery-1.5.min') ?>
    <?php //echo $this->html->script('/full_calendar/js/jquery-ui-1.8.9.custom.min') ?>
    <?php echo $this->html->script('jquery-ui-timepicker-addon') ?>
    <?php echo $this->html->script('jquery-ui-sliderAccess'); ?>

     <?php echo $this->html->script('jquery.poshytip') ?>
     <?php echo $this->html->script('jquery-editable-poshytip') ?>

    <?php echo $this->html->script('bootstrap.min') ?>

    <?php echo $this->html->script('velocity') ?>
    <?php echo $this->html->script('velocity_ready') ?>

    <?php echo $this->html->script('resto') ?>
    <?php echo $this->html->script('chosen/chosen.jquery.min') ?>
    <?php echo $this->html->script('DataTables/jquery.dataTables.min') ?>



     <?php //echo $this->Html->script(array( '/full_calendar/js/moment.min', '/full_calendar/js/jquery.qtip-1.0.0-rc3.min', '/full_calendar/js/fullcalendar.min',  '/full_calendar/js/ready'), array('inline' => 'false')); ?>

    <?php //echo $this->html->script('/full_calendar/js/moment.min') ?>
    <?php echo $this->html->script('/full_calendar/js/jquery.qtip-1.0.0-rc3.min') ?>
    <?php //echo $this->html->script('/full_calendar/js/fullcalendar.min') ?>
    <?php //echo $this->html->script('/full_calendar/js/ready') ?>
    <script>
      $(document).ready(function() {
        // $.datepicker.setDefaults( $.datepicker.regional['fr']);


        $("#datetimepicker").datetimepicker(
          {
            dateFormat: 'yy-mm-dd',
            // onSelect: function(date){
            // },
            onSelect: function() {
              var dateText = $( "#datetimepicker" ).datetimepicker( "getDate" );
              console.log(dateText);
              // $('#datetimepicker1').datetimepicker('option', 'minDate');
              var d = new Date(dateText);
               // alert(d);

              n = d.getHours()+1;
              d.setHours(n);
              var heur = d.getHours();
              var minu = d.getMinutes();
              var jour = d.getDate();
              var mois = d.getMonth()+1;
              if(heur < 10) heur = "0"+heur; else heur = heur;
              if(minu < 10) minu = "0"+minu; else minu = minu;
              if(jour < 10) jour = "0"+jour; else jour = jour;
              if(mois < 10) mois = "0"+mois; else mois = mois;
              d = d.getFullYear()+'-'+mois+'-'+jour+' '+heur+':'+minu;

              // alert(d);
              $('#datetimepicker1').val(d);
            }
          });

        $("#datetimepicker1").datetimepicker(
          {
             dateFormat: 'yy-mm-dd'
             // onSelect: function(date){
             //    $('#datetimepicker').datetimepicker('option', 'maxDate', date);
             // },
          }
        );

      });

    </script>


    <script>
    //Initialise les dates dans les pickers à maintenant si vide
    // datetimepicker -> now
    // datetimepicker1 -> now + 1
    $(document).ready(function() {


      var currentDate = $( "#datetimepicker" ).datetimepicker( "getDate" );
      if (currentDate == null) {
        //verif si date dans le cache, si click sur le Calendrier
        if (localStorage.getItem('data')) {
          var d = new Date(localStorage.getItem('data'));
        }else{
          var d = new Date();
        }

        localStorage.removeItem('data');

        $("#datetimepicker").datetimepicker( "setDate",  d );
        n = d.getHours()+1;
        d.setHours(n);
        $("#datetimepicker1").datetimepicker( "setDate",  d );
        currentDate = $( "#datetimepicker" ).datetimepicker( "getDate" );
        // console.log('cour',currentDate);
      }
    });
    </script>


    <script>
    //popup ajout customers
    $(document).ready(function() {
        //prepare the dialog
        $( "#dialogModal" ).dialog({
            position: ['middle',100],
            autoOpen: false,
            width: 350,
            show: {
                effect: "explode",
                duration: 500
                },
            hide: {
                effect: "explode",
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

    var url = window.location;
    // Will only work if string in href matches with location
    $('ul.nav a[href="'+ url +'"]').parent().addClass('active');

    // Will also work for relative and absolute hrefs
    $('ul.nav a').filter(function() {
        return this.href == url;
    }).parent().addClass('active');


    //Appel Chosen
    // $("#EventCustomerId").chosen()

    //Appel DataTables
    $('#tableData').DataTable();



    </script>




    <?php  //echo $this->Html->css('/full_calendar/css/fullcalendar'); ?>
    <?= $this->fetch('script'); ?>



    <?php
    if (class_exists('JsHelper') && method_exists($this->Js, 'writeBuffer')) echo $this->Js->writeBuffer();
    // Writes cached scripts
    ?>
  </body>
</html>
