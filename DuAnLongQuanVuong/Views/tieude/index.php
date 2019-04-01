<?php
	ob_start();
?>

<fieldset style="margin-top:2%">
    <legend>Đơn Vị Tính</legend>
        <table class="table table-bordered table-striped" width="80%">
          <tr style="background-color:darkblue;color:#FFF">
            <td>&nbsp;STT</td>
            <td>&nbsp; Tên Tiêu Đề</td>
            <td>&nbsp; </td>
            
          </tr>
     <?php  
	 	$i=1;
         foreach($dsquydinh as $row){    
             echo'<tr>
    			 	<td>&nbsp; '.$i++.'</td>
                    <td>&nbsp; '.$row->tentieude.'</td>
                    <td>
                        <a href="../Controllers/tieude_controller.php?action=editquydinh&id='.$row->tieudeid.'"><span class="glyphicon glyphicon-pencil" data-toggle="tooltip" title="Sửa"></span></a> 
                    </td>
                <tr>';
                }
    ?>
<?php
	return ob_get_clean();
?>