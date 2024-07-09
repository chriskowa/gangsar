<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="fa fa-2x">&times;</i>
            </button>
            <h4 class="modal-title" id="myModalLabel"><?php echo lang('add_expense'); ?></h4>
        </div>
        <?php $attrib = ['data-toggle' => 'validator', 'role' => 'form'];
        echo admin_form_open_multipart('purchases/add_expense', $attrib); ?>
        <div class="modal-body">
            <p><?= lang('enter_info'); ?></p>

            <?php if ($Owner || $Admin) {
            ?>

                <div class="form-group">
                    <?= lang('date', 'date'); ?>
                    <?= form_input('date', ($_POST['date'] ?? ''), 'class="form-control datetime" id="date" required="required"'); ?>
                </div>
            <?php
        } ?>

            <div class="form-group">
                <?= lang('reference', 'reference'); ?>
                <?= form_input('reference', ($_POST['reference'] ?? $exnumber), 'class="form-control tip" id="reference"'); ?>
            </div>

            <div class="form-group">
                <?= lang('category', 'category'); ?>
                <?php
                $ct[''] = lang('select') . ' ' . lang('category');
                if ($categories) {
                    foreach ($categories as $category) {
                        $ct[$category->id] = $category->name;
                    }
                }
                ?>
                <?= form_dropdown('category', $ct, set_value('category'), 'class="form-control tip" id="category"'); ?>
            </div>

            <div class="form-group">
                <?= lang('warehouse', 'warehouse'); ?>
                <?php
                $wh[''] = lang('select') . ' ' . lang('warehouse');
                foreach ($warehouses as $warehouse) {
                    $wh[$warehouse->id] = $warehouse->name;
                }
                echo form_dropdown('warehouse', $wh, ($_POST['warehouse'] ?? ''), 'id="warehouse" class="form-control input-tip select" style="width:100%;" ');
                ?>
            </div>

            <div class="form-group">
                <?= lang('business_location', 'business_location'); ?>
                <?php
                $bl[''] = lang('select') . ' ' . lang('business_location');
                foreach ($business_locations as $business_location) {
                    $bl[$business_location->id] = $business_location->name;
                }
                echo form_dropdown('business_location', $bl, ($_POST['business_location'] ?? ''), 'id="business_location" class="form-control input-tip select" style="width:100%;" ');
                ?>
            </div>

            <div class="form-group">
                <label for="accountz">Akun</label>
                <?php
                $ak[''] = lang('select') . ' ' . 'akun';
                foreach ($account as $accountz) {
                    $ak[$accountz->id] = $accountz->name;
                }
                echo form_dropdown('accountz', $ak, ($_POST['accountz'] ?? ''), 'id="accountz" class="form-control input-tip select" style="width:100%;" ');
                ?>
            </div>

            <div class="form-group">
                <?= lang('amount', 'amount'); ?>
                <input name="amount" type="text" id="amount" value="" class="pa form-control kb-pad amount"
                       required="required"/>
            </div>

            <div class="form-group">
                <?= lang('attachments', 'document') ?>
                <input id="document" type="file" data-browse-label="<?= lang('browse'); ?>" name="attachments[]" multiple data-show-upload="false" data-show-preview="false" class="form-control file">
            </div>

            <div class="form-group">
                <?= lang('note', 'note'); ?>
                <?php echo form_textarea('note', ($_POST['note'] ?? ''), 'class="form-control" id="note"'); ?>
            </div>

        </div>
        <div class="modal-footer">
            <?php echo form_submit('add_expense', lang('add_expense'), 'class="btn btn-primary"'); ?>
        </div>
    </div>
    <?php echo form_close(); ?>
</div>
<script type="text/javascript" src="<?= $assets ?>js/custom.js"></script>
<script type="text/javascript" charset="UTF-8">
    $.fn.datetimepicker.dates['sma'] = <?=$dp_lang?>;
</script>
<?= $modal_js ?>
<script type="text/javascript" charset="UTF-8">
    $(document).ready(function () {
        $.fn.datetimepicker.dates['sma'] = <?=$dp_lang?>;
        $("#date").datetimepicker({
            format: site.dateFormats.js_ldate,
            fontAwesome: true,
            language: 'sma',
            weekStart: 1,
            todayBtn: 1,
            autoclose: 1,
            todayHighlight: 1,
            startView: 2,
            forceParse: 0
        }).datetimepicker('update', new Date());
    });
</script>
