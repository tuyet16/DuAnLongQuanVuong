<?php
ob_start();
$user = new Users();
$rsvitriquangcao1 = $user->carosoulpanel();
?>
<!--Script run carousel-->
<link rel="stylesheet" type="text/css" href="../Views/css/owl.carousel.min.css"/>
<link rel="stylesheet" type="text/css" href="../Views/css/owl.theme.default.min.css"/>
<script src="../Views/js/jquery.min.js"> </script>
<script src="../Views/js/owl.carousel.min.js"></script>
<script>
$(document).ready(function(){
 $(".owl-carousel").owlCarousel({
		loop:true,
		margin:10,
		//responsiveClass:true,
		autoplay:true,
		autoplayTimeout:1000,
		autoplayHoverPause:true,
		autoPlay: 3000, //Set AutoPlay to 3 seconds
		responsive:{
			0:{
				items:1,
				nav:true
			},
			600:{
				items:3,
				nav:false,
			},
		}
         });
  });
</script>
<div id="demo" >
        <div class="container">
          <div class="row" style="margin-top:80px">
              <div id="owl-demo" class="owl-carousel" style="display:block">
                <?php foreach($rsvitriquangcao1 as $vt1)
                	{	
                	   echo '<div class="item">
								<img src="../Views/img/'.$vt1->hinh1.'" alt="Owl Image" width="100%"/></div>';
                
					}
				?>
              </div>
          </div>
        </div>
    </div>
<!-- End carousel owl-->
<?php
return ob_get_clean();
?>