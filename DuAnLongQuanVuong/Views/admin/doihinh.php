<?php ob_start();?>

    <fieldset>
        <legend>Thêm Hình Quảng Cáo</legend>        
       	<div class="col-md-9" style="padding-bottom: 20px;">
            <form action="?action=doihinh" method="post" enctype="multipart/form-data">  
                <div class="row">
                    <div class="col-md-2">Chọn hình</div>
                    <div class="col-md-8">
                        <input type="file" name="upimg" class="form-control" />
                    </div>
                     <div class="col-md-2"><input type="submit" class="btn btn-primary" name="submit" value="Lưu"/></div>
                </div>                   
            </form>
        </div>
    </fieldset>
    <fieldset>
    <table class="table table-bordered table-striped">
        <tr style="background-color:darkblue;color:#FFF">
            <td>&nbsp; STT</td>
            <td>&nbsp; Hình ảnh</td>
            <td>&nbsp; Thao tác</td>
          </tr>
         <?php  $i=1; foreach($rsdoihinh as $row)
        {
            echo '
            <tr>
				<td>&nbsp;'.$i++.'</td>
				<td>&nbsp;<img src="../Views/img/thumb/thumb_'.$row->hinh1.'"/></td>	
				<td><a href="../Controllers/admin_controller.php?action=doiquangcao&id='.$row->hinhID.'">
                    <span class="glyphicon glyphicon-pencil"></span></a> &nbsp; 
			  </tr>';
        } ?>
    </table>
       
    </fieldset>

<?php return ob_get_clean(); ?>