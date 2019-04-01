<?php ob_start(); ?> 
    <ul class="nav nav-tabs nav-justified" style="margin: 60px 0;">
      <li><a href="#categories" data-toggle="tab"><h4>QUẢN LÝ DANH MỤC SẢN PHẨM</h4></a></li>
      <li class="active"><a href="#invoices" data-toggle="tab"><h4>QUẢN LÝ ĐƠN HÀNG</h4></a></li>
      <li><a href="#functions" data-toggle="tab"><h4>CHỨC NĂNG</h4></a></li>
    </ul>
    <div class="container-fluid">
        <div class="tab-content">
          <div id="categories" class="tab-pane fade">
            <div class="row">
                <div class="col-xs-12 col-sm-12">
                    <?php if(isset($GLOBALS['template']['shopcategories'])):
                         echo $GLOBALS['template']['shopcategories'];
                        endif;
                     ?>
                </div>
            </div>
          </div>
          
          <div id="invoices" class="tab-pane fade in active">
            <div class="row">
                <div class="col-xs-12 col-sm-12">
                    <?php if(isset($GLOBALS['template']['shopinvoices'])):
                        echo $GLOBALS['template']['shopinvoices'];
                        endif;    
                    ?>
                </div>
            </div>
          </div>
          
          <div id="functions" class="tab-pane fade">
            <div class="row">
                <div class="col-xs-12 col-sm-12">
                    <h3>chức năng</h3>
                    <?php if(isset($GLOBALS['template']['shopfunctions'])):
                        echo $GLOBALS['template']['shopfunctions'];
                            endif;    
                    ?>
                </div>
            </div>
          </div>
        </div>
    </div>
<?php return ob_get_clean(); ?>