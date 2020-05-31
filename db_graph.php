<?php /*
*    Pi-hole: A black hole for Internet advertisements
*    (c) 2017 Pi-hole, LLC (https://pi-hole.net)
*    Network-wide ad blocking via your own hardware.
*
*    This file is copyright under the latest version of the EUPL.
*    Please see LICENSE file for your rights under this license. */
    require "scripts/pi-hole/php/header.php";

// Generate CSRF token
if(empty($_SESSION['token'])) {
    $_SESSION['token'] = base64_encode(openssl_random_pseudo_bytes(32));
}
$token = $_SESSION['token'];

?>
<!-- Send PHP info to JS -->
<div id="token" hidden><?php echo $token ?></div>

<!-- Title -->
<div class="page-header">
    <h1>从Pi-hole数据库计算图形统计信息</h1>
</div>

<div class="row">
    <div class="col-md-12">
<!-- Date Input -->
      <div class="form-group">
        <label>时间和日期范围:</label>

        <div class="input-group">
          <div class="input-group-addon">
            <i class="far fa-clock"></i>
          </div>
          <input type="button" class="form-control pull-right" id="querytime" value="Click to select date and time range">
        </div>
        <!-- /.input group -->
      </div>
    </div>
</div>

<div id="timeoutWarning" class="alert alert-warning alert-dismissible fade in" role="alert" hidden="true">
    根据您指定的范围的大小，Pi-hole尝试检索所有数据时，请求可能会超时。<br/><span id="err"></span>
</div>

<div class="row">
    <div class="col-md-12">
    <div class="box" id="queries-over-time">
        <div class="box-header with-border">
          <h3 class="box-title">选择查询的时间段</h3>
        </div>
        <div class="box-body">
          <div class="chart">
            <canvas id="queryOverTimeChart" width="800" height="250"></canvas>
          </div>
        </div>
        <div class="overlay" hidden="true">
          <i class="fa fa-sync fa-spin"></i>
        </div>
        <!-- /.box-body -->
      </div>
    </div>
</div>

<script src="scripts/vendor/moment.min.js"></script>
<script src="scripts/vendor/daterangepicker.js"></script>
<script src="scripts/pi-hole/js/db_graph.js"></script>

<?php
    require "scripts/pi-hole/php/footer.php";
?>
