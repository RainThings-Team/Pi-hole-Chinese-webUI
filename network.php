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

<div class="row">
    <div class="col-md-12">
      <div class="box" id="network-details">
        <div class="box-header with-border">
          <h3 class="box-title">网络概况</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <table id="network-entries" class="display table table-striped table-bordered" cellspacing="0" width="100%">
                <thead>
                    <tr>
                        <th>IP地址</th>
                        <th>硬件地址</th>
                        <th>接口</th>
                        <th>主机名</th>
                        <th>首次发现</th>
                        <th>最后查询</th>
                        <th>查询数</th>
                        <th>使用Pi-hole</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>IP地址</th>
                        <th>硬件地址</th>
                        <th>接口</th>
                        <th>主机名</th>
                        <th>首次发现</th>
                        <th>最后查询</th>
                        <th>查询数</th>
                        <th>使用Pi-hole</th>
                    </tr>
                </tfoot>
            </table>
            <label>背景颜色：看到的来自此设备的最后一个查询...</label>
        <table width="100%">
          <tr class="text-center">
            <td style="background: #e7ffde;" width="15%">现在</td>
            <td style="background-image: linear-gradient(to right, #e7ffde 0%, #ffffdf 100%)" width="30%"><center>... to ...</center></td>
            <td style="background: #ffffdf;" width="15%">24小时前</td>
            <td style="background: #ffedd9;" width="20%">&gt; 24小时前</td>
            <td style="background: #ffbfaa;" width="20%">设备不使用Pi-hole</td>
          </tr>
        </table>
        </div>
        <!-- /.box-body -->
      </div>
      <!-- /.box -->
    </div>
</div>
<!-- /.row -->

<?php
    require "scripts/pi-hole/php/footer.php";
?>

<script src="scripts/vendor/moment.min.js"></script>
<script src="scripts/pi-hole/js/ip-address-sorting.js"></script>
<script src="scripts/pi-hole/js/network.js"></script>
