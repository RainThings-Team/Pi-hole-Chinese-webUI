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

$showing = "";

if(isset($setupVars["API_QUERY_LOG_SHOW"]))
{
	if($setupVars["API_QUERY_LOG_SHOW"] === "all")
	{
		$showing = "显示所有";
	}
	elseif($setupVars["API_QUERY_LOG_SHOW"] === "permittedonly")
	{
		$showing = "显示已允许的";
	}
	elseif($setupVars["API_QUERY_LOG_SHOW"] === "blockedonly")
	{
		$showing = "显示已屏蔽的";
	}
	elseif($setupVars["API_QUERY_LOG_SHOW"] === "nothing")
	{
		$showing = "不显示任何查询（由于设置）";
	}
}
else
{
	// If filter variable is not set, we
	// automatically show all queries
	$showing = "显示所有";
}

$showall = false;
if(isset($_GET["all"]))
{
	$showing .= "Pi-hole日志中的所有查询";
}
else if(isset($_GET["client"]))
{
	$showing .= " 请求的客户端 ".htmlentities($_GET["client"]);
}
else if(isset($_GET["domain"]))
{
	$showing .= " 请求的域名 ".htmlentities($_GET["domain"]);
}
else if(isset($_GET["from"]) || isset($_GET["until"]))
{
	$showing .= "在指定的时间间隔内进行查询";
}
else
{
	$showing .= " 前100个查询";
	$showall = true;
}

if(isset($setupVars["API_PRIVACY_MODE"]))
{
	if($setupVars["API_PRIVACY_MODE"])
	{
		// Overwrite string from above
		$showing .= "隐私模式已启用！";
	}
}

if(strlen($showing) > 0)
{
	$showing = "(".$showing.")";
	if($showall)
		$showing .= ", <a href=\"?all\">show all</a>";
}
?>
<!-- Send PHP info to JS -->
<div id="token" hidden><?php echo $token ?></div>


<!--
<div class="row">
    <div class="col-md-12">
        <button class="btn btn-info margin-bottom pull-right">Refresh Data</button>
    </div>
</div>
-->

<!-- Alert Modal -->
<div id="alertModal" class="modal fade" role="dialog" data-backdrop="static" data-keyboard="false">
    <div class="vertical-alignment-helper">
        <div class="modal-dialog vertical-align-center">
            <div class="modal-content">
                <div class="modal-body text-center">
                    <span class="fa-stack fa-2x" style="margin-bottom: 10px">
                        <div class="alProcessing">
                            <i class="fa-stack-2x alSpinner"></i>
                        </div>
                        <div class="alSuccess" style="display: none">
                            <i class="fa fa-circle fa-stack-2x text-green"></i>
                            <i class="fa fa-check fa-stack-1x fa-inverse"></i>
                        </div>
                        <div class="alFailure" style="display: none">
                            <i class="fa fa-circle fa-stack-2x text-red"></i>
                            <i class="fa fa-times fa-stack-1x fa-inverse"></i>
                        </div>
                    </span>
                    <div class="alProcessing">添加中<span id="alDomain"></span>到<span id="alList"></span>...</div>
                    <div class="alSuccess text-bold text-green" style="display: none"><span id="alDomain"></span>成功添加到<span id="alList"></span></div>
                    <div class="alFailure text-bold text-red" style="display: none">
                        <span id="alNetErr">超时或网络连接错误！</span>
                        <span id="alCustomErr"></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
      <div class="box" id="recent-queries">
        <div class="box-header with-border">
          <h3 class="box-title">最近的DNS查询<?php echo $showing; ?></h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <table id="all-queries" class="display table table-striped table-bordered" cellspacing="0" width="100%">
                <thead>
                    <tr>
                        <th>时间</th>
                        <th>类型</th>
                        <th>域名</th>
                        <th>客户端</th>
                        <th>状态</th>
                        <th>回复</th>
                        <th>动作</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>Time</th>
                        <th>Type</th>
                        <th>Domain</th>
                        <th>Client</th>
                        <th>Status</th>
                        <th>Reply</th>
                        <th>Action</th>
                    </tr>
                </tfoot>
            </table>
            <label><input type="checkbox" id="autofilter">&nbsp;单击类型，域名和客户端时应用过滤</label><br/>
            <button type="button" id="resetButton" hidden="true">清除筛选</button>
        </div>
        <!-- /.box-body -->
      </div>
      <!-- /.box -->
    </div>
</div>
<!-- /.row -->

<script src="scripts/vendor/moment.min.js"></script>
<script src="scripts/pi-hole/js/queries.js"></script>

<?php
    require "scripts/pi-hole/php/footer.php";
?>
