<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<div class="box">
    <div class="box-header">
        <h2 class="blue"><i class="fa-fw fa fa-briefcase"></i><?= lang('open_registers'); ?></h2>
        <div class="box-icon">
            <ul class="btn-tasks">
                <li class="dropdown">
                    <a data-toggle="dropdown" class="dropdown-toggle" href="#"><i class="icon fa fa-tasks tip"  data-placement="left" title="<?= lang('actions') ?>"></i></a>
                    <ul class="dropdown-menu pull-right tasks-menus" role="menu" aria-labelledby="dLabel">
                        <li><a href="<?= admin_url('pos/open_register') ?>"><i class="fa fa-plus-circle"></i> <?= lang('add_register') ?></a></li>                        
                    </ul>
                </li>
                
            </ul>
        </div>
    </div>
    <div class="box-content">
        <p class="introtext"><?= lang('review_opened_registers'); ?></p>

        <div class="row">
            <div class="col-lg-12">
                <table class="table table-bordered table-striped">
                    <thead>
                    <tr>
                        <td><?= lang('user'); ?></td>
                        <td><?= lang('opened_at'); ?></td>
                        <td><?= lang('cash_in_hand'); ?></td>
                        <td width="100px;"><?= lang('actions'); ?></td>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    if (!empty($registers)) {
                        foreach ($registers as $register) {
                            echo '<tr>';
                            echo '<td>' . $register->user . '</td><td>' . $this->sma->hrld($register->date) . '</td><td>' . $register->cash_in_hand . '</td>';
                            echo '<td width="50px;"><a href="' . admin_url('pos/close_register/' . $register->user_id) . '" data-target="#myModal" data-toggle="modal"><span class="label label-danger"><i class="fa fa-times"></i> ' . lang('close_register') . '</span></a></td>';
                            echo '</tr>';
                        }
                    } else {
                        echo '<tr>';
                        echo '<td colspan="4">' . lang('all_registers_are_closed') . '</td>';
                        echo '</tr>';
                    }
                    ?>
                    </tbody>
                </table>
                <div class="clearfix"></div>
            </div>
        </div>
    </div>
</div>
