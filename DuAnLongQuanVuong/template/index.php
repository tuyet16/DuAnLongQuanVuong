<!DOCTYPE HTML>
<head>
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">

    <!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-66906921-2"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-66906921-2');
</script>

	<meta http-equiv="content-type" content="text/html" />
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
	<title>
    <?php
        if(isset($GLOBALS['template']['title'])){
            echo $GLOBALS['template']['title'];
        } 
        else
        {
            echo 'Thương mại điện tử, mua sắm trực tuyến, shipper quận 5';
        } 
    ?>
    </title>
   	<link type="text/css" rel="stylesheet" href="../Views/css/bootstrap.min.css"/>
   	<link type="text/css" rel="stylesheet" href="../Views/css/font-awesome.css"/>
    
    <link type="text/css" rel="stylesheet" href="../Views/css/jquery-ui.min.css"/>
    <link type="text/css" rel="stylesheet" href="../Views/css/jquery-ui.theme.min.css"/>
    <link  rel="stylesheet" href="../Views/css/designer.css"/>
    
    
    <link type="text/css" rel="stylesheet" href="../Views/css/styles.css"/>
    
    <script src="../Views/js/jquery.min.js"> </script>
    <script src="../Views/js/bootstrap.min.js"></script>  
    <script src="../Views/js/jquery.validate.min.js"></script>     
    <script src="../Views/js/jquery-ui.min.js"></script>
    
    <link type="text/css" href="../Views/css/summernote.css" rel="stylesheet"/>
    <script src="../Views/js/summernote.min.js"></script>
	<script src="../Views/js/script.js"></script>
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
<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = 'https://connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v3.2&appId=128431864177508&autoLogAppEvents=1';
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>
<div class="row">
<div class="col-md-12 col-sm-12 col-xs-12">
    <?php
    if(isset($GLOBALS['template']['carousel'])){
        echo $GLOBALS['template']['carousel'];
    }
    if(isset($GLOBALS['template']['menu'])){
        echo $GLOBALS['template']['menu'];
    }
    
?>
</div>
</div>
    <div class="container-fluid" style="padding-top: 10px;" >
        <?php
              if(isset($GLOBALS['template']['leftmenu'])){ ?>
        <div class="row bg-transparent">
           <div class="col-md-3 col-sm-12 col-xs-12">
              <?php  echo $GLOBALS['template']['leftmenu']; ?>
            </div>
            <div class="col-md-9 col-sm-12 col-xs-12">
            <?php
                if(isset($GLOBALS['template']['content'])){
                    echo $GLOBALS['template']['content'];
                }
            ?>
            </div>
        </div>
        <?php }else{?>
        <div class="row bg-transparent">
            <div class="col-md-12 col-sm-12 col-xs-12">
            <?php
                if(isset($GLOBALS['template']['content'])){
                    echo $GLOBALS['template']['content'];
                }
            ?>
            </div>
        </div>
        <?php }?>
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