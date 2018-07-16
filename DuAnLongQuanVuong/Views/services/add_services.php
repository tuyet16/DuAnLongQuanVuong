<div class="row">
	<div class="col-md-2 text-right">Khu vực</div>
    <div class="col-md-4 text-right">
    	<select name="slKV" id="slKV" class="form-control" >
			<?php
                 foreach($dsAreas as $row){
                        echo "<option name='otpKV' value='".$row->areasID."'>".$row->areasName."</option>"; 
                }?> 
        </select>
    </div>
</div>
<div class="row">
	<div class="col-md-2 text-right">Quận</div>
    <div class="col-md-4 text-right">
    	<select name="quan" id="quan" class="form-control">
			<?php
                 foreach($dsDistricts as $row){
                      echo "<option name='optquan' value='".$row->districtID."'>".$row->districtName."</option>"; 
                }?>  
        </select>
    </div>
</div>