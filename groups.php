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
    <h1>Group管理器</h1>
</div>

<!-- Group Input -->
<div class="row">
    <div class="col-md-12">
        <div class="box" id="add-group">
            <!-- /.box-header -->
            <div class="box-header with-border">
                <h3 class="box-title">
                    添加新组
                </h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <div class="row">
                    <div class="form-group col-md-6">
                        <label for="new_name">Name:</label>
                        <input id="new_name" type="text" class="form-control" placeholder="Group name">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="new_desc">描述:</label>
                        <input id="new_desc" type="text" class="form-control" placeholder="Group description (optional)">
                    </div>
                </div>
            </div>
            <div class="box-footer clearfix">
                <button id="btnAdd" class="btn btn-primary pull-right">添加</button>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="box" id="groups-list">
            <div class="box-header with-border">
                <h3 class="box-title">
                    已配置的组列表
                </h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <table id="groupsTable" class="display table table-striped table-bordered" cellspacing="0" width="100%">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>名称</th>
                        <th>状态</th>
                        <th>描述</th>
                        <th>动作</th>
                    </tr>
                    </thead>
                </table>
                <button type="button" id="resetButton" hidden="true"> 重置排序</button>
            </div>
            <!-- /.box-body -->
        </div>
        <!-- /.box -->"
    </div>
</div>

<script src="scripts/pi-hole/js/groups-common.js"></script>
<script src="scripts/pi-hole/js/groups.js"></script>

<?php
require "scripts/pi-hole/php/footer.php";
?>
