<!DOCTYPE HTML>
<head>
	<meta http-equiv="content-type" content="text/html" />
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
	<title>
    <?php
        if(isset($GLOBALS['template']['title'])){
            echo $GLOBALS['template']['title'];
        } 
    ?>
    </title>
    <link type="text/css" rel="stylesheet" href="../views/css/designer.css"/>
   	<link type="text/css" rel="stylesheet" href="../views/css/bootstrap.min.css"/> 
   	<link type="text/css" rel="stylesheet" href="../views/css/font-awesome.css"/>
    <link type="text/css" rel="stylesheet" href="../views/css/jquery-ui.min.css"/>
    <link type="text/css" rel="stylesheet" href="../views/css/jquery-ui.theme.min.css"/>
     <script src="../Views/js/jquery.min.js"> </script>
    <script src="../Views/js/bootstrap.min.js"></script>  
    <script src="../Views/js/jquery.validate.min.js"></script>     
    <script src="../Views/js/jquery-ui.min.js"></script>
    <link type="text/css" rel="stylesheet" href="../views/css/pgwslideshow.min.css"/>
    <script src="../Views/js/pgwslideshow.min.js"></script>
    <script src="../views/js/script.js"></script>
    <script>
      $( function() {
        $( "#datepicker" ).datepicker({
          dateFormat: "dd-mm-yy"
        });
        $('.date-month').datepicker( {
        changeMonth: true,
        changeYear: true,
        showButtonPanel: true,
        dateFormat: 'mm yy',
        onClose: function(dateText, inst) { 
            $(this).datepicker('setDate', new Date(inst.selectedYear, inst.selectedMonth, 1));
        }
        });
            $(".date-month").focus(function () {
            $(".ui-datepicker-calendar").hide();
            $("#ui-datepicker-div").position({
                my: "center top",
                at: "center bottom",
                of: $(this)
            });
        });
         $('.date-year').datepicker( {
            changeYear: true,
            showButtonPanel: true,
            dateFormat: 'yy',
            onClose: function(dateText, inst) { 
                $(this).datepicker('setDate', new Date(inst.selectedYear, 1));
            }
            });
                $(".date-year").focus(function () {
                $(".ui-datepicker-calendar").hide();
                $("#ui-datepicker-div").position({
                    my: "center top",
                    at: "center bottom",
                    of: $(this)
                });
            });
     });
    </script>
</head>

<body>
    <?php
    if(isset($GLOBALS['template']['menu'])){
        echo $GLOBALS['template']['menu'];
    }
    
?>

    <div class="container-fluid" style="padding-top: 10px;" >
        
        <div class="row bg-transparent">
            <?php if(isset($GLOBALS['template']['leftmenu'])): ?>
           <div class="col-sm-3">
                <?php
                
                if(isset($GLOBALS['template']['leftmenu'])){
                    echo $GLOBALS['template']['leftmenu'];
                 }
                ?>
            </div>
            
            <div class="col-sm-9">
                    <?php
                if(isset($GLOBALS['template']['content'])){
                    echo $GLOBALS['template']['content'];
                }
            ?>
            </div>
            <?php else: ?>
            <div class="col-sm-12">
                    <?php
                if(isset($GLOBALS['template']['content'])){
                    echo $GLOBALS['template']['content'];
                }
            ?>
            </div>
            <?php endif;?>
        </div>
      
        <div class="row">
            <?php 
                if(isset($GLOBALS['template']['footer'])){
                    echo $GLOBALS['template']['footer'];
            }
             ?>
        </div>
    </div>   
    </div>     
   
  </div>
</body>
</html>