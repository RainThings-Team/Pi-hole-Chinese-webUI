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
    <h1>客户端群组管理</h1>
</div>

<!-- Domain Input -->
<div class="row">
    <div class="col-md-12">
        <div class="box" id="add-client">
            <!-- /.box-header -->
            <div class="box-header with-border">
                <h3 class="box-title">
                    添加一个新的客户端
                </h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <div class="row">
                    <div class="form-group col-md-6">
                        <label for="select">已知客户端:</label>
                        <select id="select" class="form-control" placeholder="">
                            <option disabled selected>Loading...</option>
                        </select><br>
                        <input id="ip-custom" type="text" class="form-control" disabled placeholder="Client IP address (IPv4 or IPv6, CIDR subnetting available, optional)">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="new_comment">描述:</label>
                        <input id="new_comment" type="text" class="form-control" placeholder="Client description (optional)">
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
        <div class="box" id="clients-list">
            <div class="box-header with-border">
                <h3 class="box-title">
                    已配置的客户端列表
                </h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <table id="clientsTable" class="display table table-striped table-bordered" cellspacing="0" width="100%">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>IP 地址</th>
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
<script src="scripts/pi-hole/js/groups-clients.js"></script>

<?php
require "scripts/pi-hole/php/footer.php";
?>
