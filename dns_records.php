<?php /*
*    Pi-hole: A black hole for Internet advertisements
*    (c) 2017 Pi-hole, LLC (https://pi-hole.net)
*    Network-wide ad blocking via your own hardware.
*
*    This file is copyright under the latest version of the EUPL.
*    Please see LICENSE file for your rights under this license. */
    require "scripts/pi-hole/php/header.php";

?>

<!-- Title -->
<div class="page-header">
    <h1>本地DNS记录设置</h1>
    <small>在这个页面你可以指定一个域名解析到设置的IP地址</small>
</div>

<!-- Domain Input -->
<div class="row">
    <div class="col-md-12">
        <div class="box">
            <!-- /.box-header -->
            <div class="box-header with-border">
                <h3 class="box-title">
                    添加新的域/ IP组合
                </h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <div class="row">
                    <div class="form-group col-md-6">
                        <label for="domain">域名:</label>
                        <input id="domain" type="text" class="form-control" placeholder="Add a domain (example.com or sub.example.com)">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="ip">IP地址:</label>
                        <input id="ip" type="text" class="form-control" placeholder="Associated IP address">
                    </div>
                </div>
            </div>
            <div class="box-footer clearfix">
                <button id="btnAdd" class="btn btn-primary pull-right">添加</button>
            </div>
        </div>
    </div>
</div>

<!-- Alerts -->
<div id="alInfo" class="alert alert-info alert-dismissible fade in" role="alert" hidden="true">
    <button type="button" class="close" data-hide="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    正在更新自定义DNS条目.....
</div>
<div id="alSuccess" class="alert alert-success alert-dismissible fade in" role="alert" hidden="true">
    <button type="button" class="close" data-hide="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    成功! 列表已刷新。
</div>
<div id="alFailure" class="alert alert-danger alert-dismissible fade in" role="alert" hidden="true">
    <button type="button" class="close" data-hide="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    失败！ 出问题了，请参见下面的输出:<br/><br/><pre><span id="err"></span></pre>
</div>
<div id="alWarning" class="alert alert-warning alert-dismissible fade in" role="alert" hidden="true">
    <button type="button" class="close" data-hide="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    至少已经存在一个相同的域，请参见以下输出:<br/><br/><pre><span id="warn"></span></pre>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="box" id="recent-queries">
            <div class="box-header with-border">
                <h3 class="box-title">
                    本地DNS列表
                </h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <table id="customDNSTable" class="display table table-striped table-bordered" cellspacing="0" width="100%">
                    <thead>
                    <tr>
                        <th>域名</th>
                        <th>IP</th>
                        <th>动作</th>
                    </tr>
                    </thead>
                </table>
                <button type="button" id="resetButton" hidden="true">清除筛选</button>
            </div>
            <!-- /.box-body -->
        </div>
        <!-- /.box -->
    </div>
</div>

<script src="scripts/pi-hole/js/customdns.js"></script>

<?php
require "scripts/pi-hole/php/footer.php";
?>
