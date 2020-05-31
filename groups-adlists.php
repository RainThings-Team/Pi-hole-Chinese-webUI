<?php /*
*    Pi-hole: A black hole for Internet advertisements
*    (c) 2019 Pi-hole, LLC (https://pi-hole.net)
*    Network-wide ad blocking via your own hardware.
*
*    This file is copyright under the latest version of the EUPL.
*    Please see LICENSE file for your rights under this license. */
    require "scripts/pi-hole/php/header.php";
?>

<!-- Title -->
<div class="page-header">
    <h1>广告群组管理</h1>
</div>

<!-- Domain Input -->
<div class="row">
    <div class="col-md-12">
        <div class="box" id="add-group">
            <!-- /.box-header -->
            <div class="box-header with-border">
                <h3 class="box-title">
                    新增广告列表
                </h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <div class="row">
                    <div class="form-group col-md-6">
                        <label for="new_address">地址:</label>
                        <input id="new_address" type="text" class="form-control" placeholder="http://..., https://..., file://...">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="new_comment">描述:</label>
                        <input id="new_comment" type="text" class="form-control" placeholder="Adlist description (optional)">
                    </div>
                </div>
            </div>
            <div class="box-footer clearfix">
                <strong>提示:</strong>&nbsp;请运行<code>pihole -g</code> 或更新广告内置列表<a href="gravity.php"></a> 以应用添加的屏蔽地址
                <button id="btnAdd" class="btn btn-primary pull-right">添加</button>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="box" id="adlists-list">
            <div class="box-header with-border">
                <h3 class="box-title">
                    已配置广告屏蔽的列表
                </h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <table id="adlistsTable" class="display table table-striped table-bordered" cellspacing="0" width="100%">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>地址</th>
                        <th>状态</th>
                        <th>描述</th>
                        <th>群组</th>
                        <th>动作</th>
                    </tr>
                    </thead>
                </table>
                <button type="button" id="resetButton" hidden="true">重置排序</button>
            </div>
            <!-- /.box-body -->
        </div>
        <!-- /.box -->
    </div>
</div>

<script src="scripts/pi-hole/js/groups-common.js"></script>
<script src="scripts/pi-hole/js/groups-adlists.js"></script>

<?php
require "scripts/pi-hole/php/footer.php";
?>
