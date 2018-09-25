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
    <link type="text/css" rel="stylesheet" href="../views/css/froala_editor.min.css"/>
    <link type="text/css" rel="stylesheet" href="../views/css/froala_style.min.css"/>
     <script src="../Views/js/jquery.min.js"> </script>
    <script src="../Views/js/bootstrap.min.js"></script>  
    <script src="../Views/js/jquery.validate.min.js"></script>     
    <script src="../Views/js/jquery-ui.min.js"></script>
    <link type="text/css" rel="stylesheet" href="../views/css/pgwslideshow.min.css"/>
    <script src="../Views/js/pgwslideshow.min.js"></script>
    <script src="../views/js/froala_editor.min.js"></script>
    <script src="../views/js/script.js"></script>
    <script>
      $( function() {
        
        $( "#datepicker" ).datepicker({
          dateFormat: "dd-mm-yy",
        });
        $( "#check_delivery_date" ).datepicker({
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
        $('.collapse').on('show.bs.collapse', function (e) {
            $('.collapse').collapse("hide")
            });    
     });
    </script>
</head>

<body>
<div class="row">
<div class="col-md-12 col-sm-12 col-xs-12">
    <?php
    if(isset($GLOBALS['template']['menu'])){
        echo $GLOBALS['template']['menu'];
    }
    
?>
</div>
</div>
    <div class="container-fluid" style="padding-top: 10px;" >
        
        <div class="row bg-transparent">
            <?php if(isset($GLOBALS['template']['leftmenu'])): ?>
           <div class="col-md-3 col-sm-3 col-xs-5">
                <?php
                
                if(isset($GLOBALS['template']['leftmenu'])){
                    echo $GLOBALS['template']['leftmenu'];
                 }
                ?>
            </div>
            
            <div class="col-md-9 col-sm-9 col-xs-7">
                    <?php
                if(isset($GLOBALS['template']['content'])){
                    echo $GLOBALS['template']['content'];
                }
            ?>
            </div>
            <?php else: ?>
            <div class="col-md-12 col-sm-12 col-xs-12">
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
<script type="text/javascript">
    $(function() { $('textarea').froalaEditor({
        heightMin: 250,
        heightMax: 500,
        toolbarButtons: ['fullscreen', 'bold', 'italic', 'underline', 'strikeThrough', 'subscript', 'superscript', '|', 'fontFamily', 'fontSize', 'color', 'inlineStyle', 'paragraphStyle', '|', 'paragraphFormat', 'align', 'formatOL', 'formatUL', 'outdent', 'indent', 'quote', '-', 'insertLink', 'insertImage', 'insertVideo', 'insertFile', 'insertTable', '|', 'emoticons', 'specialCharacters', 'insertHR', 'selectAll', 'clearFormatting', '|', 'print', 'help', 'html', '|', 'undo', 'redo'],
        toolbarSticky: false
        
    }) 
    });
</script>
</body>
</html>