<?php

/*************************************************************************
 ***  Kamery Liberec - Pilínkov                                        ***
 *************************************************************************/
require "./config.php";         // skript s nastavenim
require "./scripts/functions.php";       // skript s nekolika funkcemi
require_once "./scripts/lang.php";
?>
<!DOCTYPE html>
<html>

    <head>
        <!-- Global site tag (gtag.js) - Google Analytics -->
        <script async src="https://www.googletagmanager.com/gtag/js?id=UA-70474721-2"></script>
        <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());
        gtag('config', 'UA-70474721-2');
        </script>
        
        <title><?php echo $lang['titulekstranky']; ?></title>
        <meta charset="UTF-8">        
        <link rel="stylesheet" href="css/css.css" type="text/css">
        <meta NAME="description" CONTENT="<?php echo $lang['popisstranky']; ?>">
        <meta http-equiv="refresh" content="300">
        <meta NAME="author" CONTENT="Tomáš Krupička (info@tomaskrupicka.cz)">
        <meta name="viewport" content="width=device-width, maximum-scale=1, initial-scale=1, user-scalable=0">
        <script src="scripts/js/jquery.tools.ui.timer.colorbox.tmep.highcharts.js" type="text/javascript"></script>
        <script type="text/javascript">
            $(document).ready(function () {
                // jQuery UI - datepicker
                $("#den").datepicker($.datepicker.regional["<?php echo $l;  ?>"]);
                $.datepicker.setDefaults({dateFormat: "yy-mm-dd", minDate: new Date(2020,10,01), maxDate: new Date(2021,3,31), changeMonth: true, changeYear: true});
            });
        </script>
        
    </head>
    
    <body>
    
    <?php


  echo "<div class='roztahovak-modry'>
        <div class='hlavicka container'>
        <div id='nadpis'><h1>".$lang['hlavninadpis']."</h1></div>

        <div id='menu'><nav><ul>".menuJazyky($jazyky, $l)."</ul></nav></div>

        </div>
        </div>";

        require_once "./scripts/head.php"; ?>

        <div id='hlavni' class="container">

              <?php require_once "./scripts/galerie.php"; ?>
          
        </div>
        
          <div class='roztahovak-modry'>
              <div class='paticka container'><p><?php echo $lang['paticka']; ?></p></div>
           </div>


    </body>
</html>
