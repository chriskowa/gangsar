<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<div class="box">
    <div class="box-header">
        <h2 class="blue"><i class="fa-fw fa fa-briefcase"></i><?= lang('open_register'); ?></h2>
    </div>
    <div class="box-content">
        <div class="row">
            <div class="col-lg-12">
                <div class="well well-sm col-sm-6">
                    <?= admin_form_open('pos/open_register'); ?>
                    <div class="form-group">
                        <?= lang('cash_in_hand', 'cash_in_hand') ?>
                        <?= form_input('cash_in_hand', '', 'id="cash_in_hand" class="form-control"'); ?>
                    </div>
                    <div class="form-group">
                        <label><?= lang('business_location') ?></label>                        
                            <?php
                            $bl[''] = '';                                
                            foreach ($business_locations as $business_location) {
                                $bl[$business_location->id] = $business_location->name;
                            }
                            echo form_dropdown('business_location', $bl,'', 'id="pbusiness_location" class="form-control input-tip select" data-placeholder="' . lang('select') . ' ' . lang('business_location') . '" style="width:100%;" '); ?>
                        
                    </div>
                    <?php echo form_submit('open_register', lang('open_register'), 'class="btn btn-primary" id="open_register"'); ?>
                    <?php echo form_close(); ?>
                    <div class="clearfix"></div>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function() {
        $('#cash_in_hand').change(function(e) {
            if ($(this).val() && !is_numeric($(this).val())) {
                bootbox.alert("<?= lang('unexpected_value'); ?>");
                $(this).val('');
            }
        })
    });
</script>