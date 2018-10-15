<?php ob_start();?>

    <fieldset>
        <legend>Sửa Hình Quảng Cáo</legend>     
                
       	<div class="col-md-9" style="padding-bottom: 20px;">
            <form action="?action=doiquangcao" method="post" enctype="multipart/form-data" >  
            <input type="hidden" name="hinhID" type="text" value="<?php if($rshinh!=null){ echo $rshinh[0]->hinhID; }?>" />         
                <div class="row">
                    <div class="col-md-2">Chọn hình</div>
                    <div class="col-md-10">
                        <input type="file" name="hinh" class="form-control" value="<?php if($rshinh!=null){ echo $rshinh[0]->hinh1;} ?>" />
                        <input name="image" type="hidden" value="<?php echo $rshinh[0]->hinh1; ?>" />
                    </div>
                </div>              
                <div class="row">
                    <div class="col-md-2">chọn Vị Trí</div>
                        <div class="col-md-10">
                            <input type="text" name="vitri" class="form-control" value="<?php if($rshinh!=null){ echo $rshinh[0]->vitri;} ?>" />
                        </div>
                </div>      
                <input type="submit" class="btn btn-primary" name="submit" value="Lưu"/>
            </form>
        </div>
    </fieldset>
    <fieldset>
    <table class="table table-bordered table-striped">
        <tr style="background-color:darkblue;color:#FFF">
            <td>&nbsp; STT</td>
            <td>&nbsp; Hình ảnh</td>
            <td>&nbsp; Vị trí</td>
            <td>&nbsp; Thao tác</td>
          </tr>
         <?php  $i=1; foreach($rsdoihinh as $row)
        {
            echo '
            <tr>
				<td>&nbsp;'.$i++.'</td>
				<td>&nbsp;<img src="../Views/img/thumb/thumb_'.$row->hinh1.'"/></td>
				<td>&nbsp;'.$row->vitri.'</td>			
				<td><a href="../Controllers/admin_controller.php?action=doiquangcao&id='.$row->hinhID.'">
                    <span class="glyphicon glyphicon-pencil"></span></a> &nbsp; 
			  </tr>';
        } ?>
    </table>
       
    </fieldset>

<?php return ob_get_clean(); ?>