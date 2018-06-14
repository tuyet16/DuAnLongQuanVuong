<!DOCTYPE HTML><head>
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

    <link type="text/css" rel="stylesheet" href="../views/css/bootstrap.min.css"/> 
     <script src="../views/js/jquery.js"> </script>
    <script src="../views/js/bootstrap.min.js"></script>       
    <script src="../Views/js/jquery.validate.min.js"></script>
    <link type="text/css" rel="stylesheet" href="../views/css/styles.css"  />
    <script src="../views/js/script.js"></script>

</head>

<body>
    <?php
    if(isset($GLOBALS['template']['menu'])){
        echo $GLOBALS['template']['menu'];
    }
    
?>
    <div class="container-fluid" style="padding-top: 70px;">
        <div class="row">
            
        </div>
        <div class="row bg-transparent">
           <div class="col-sm-3">
                <?php
                
                if(isset($GLOBALS['template']['leftmenu'])){
                    echo $GLOBALS['template']['leftmenu'];
                 }
                ?>
         </div>
        
            <div class="col-md-9" id="dichvu">
                    <?php
                if(isset($GLOBALS['template']['content'])){
                    echo $GLOBALS['template']['content'];
                }
            ?>
    </div>
        </div>



    </div>     
   
    </div> 
</body>
</html>