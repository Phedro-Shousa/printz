<?php /** @var APBDWMC_design $this */
	//echo $this->GetActionUrl("get-rate");
?>
<div class="row">
    <h3 class="w-100 pl-3"><?php $this->_e("Widget Design") ; ?></h3>
    <hr class="w-100">
</div>
<div class="card  mb-3">
    <div class="card-body">
        <div class="form-group row">
            <label class="col-form-label col-lg-3 align-middle"  style="line-height: 5.5rem;" for="wid_pos"><?php $this->_e("Widget Position"); ?></label>
            <div class="col-lg">
                <div class="">
				    <?php
					    $app_chat_pattern_selected= $this->GetOption("wid_pos","L");
					    $app_wg_pos_option = [
						    "N"  => '<img src="' . plugins_url( 'images/wid-none.jpg', $this->pluginFile ) . '"/>',
						    "L"  => '<img src="' . plugins_url( 'images/wid-left.jpg', $this->pluginFile ) . '"/>',
						    "R"  => '<img src="' . plugins_url( 'images/wid-right.jpg', $this->pluginFile ) . '"/>',
					    ];
					    APBD_GetHTMLRadioBoxByArray("Widget Possition","wid_pos","wid_pos",true,$app_wg_pos_option,$app_chat_pattern_selected,false,"#e8fffd",'bg-green');
				    ?>
                </div>
            </div>
        </div>
        
        <div>
            <div class="form-group row">
                <label class="col-form-label col-lg-3 align-middle"  for="wid_pos"><?php $this->_e("Design Customization"); ?></label>
                <div class="col-lg">
                    <button class="btn btn-sm btn btn-warning apbd-pro-btn btn-icon-left"> <i class="fa fa-unlock"></i> <?php $this->_e("Unlock It") ; ?></button>
                </div>
            </div>
            
        </div>

    </div>
</div>
<div class=" text-sm-right pr-3">
    <button type="submit" class="btn btn-success btn-icon-left"><i class="fa fa-save"></i> <?php $this->_e("Save") ; ?></button>
</div>

