<?php
	ob_start();
?>
<fieldset>
    <legend style="80%">Đổi Quy Định Giao Hàng</legend>
            <form id="formAddUnit" method="post" action="?action=editquydinh">
            <input type="hidden" name="id" value="<?php echo $rsquydinh[0]->tieudeid; ?>" />
                <div class="row">
                    <div class="col-md-2">Tên Quy Định</div> 
                    <div class="col-md-4"> 
                    	<textarea name="tentd"><?php echo $rsquydinh[0]->tentieude; ?></textarea>
                    </div> 
                </div>
                <div class="row">
                    <div class="col-md-2"></div> 
                    <div class="col-md-4"> 
                    	<input type="submit" name="submit" class="btn btn-primary" value="Lưu"/>
                    </div> 
</fieldset>
<?php
	return ob_get_clean();
?>