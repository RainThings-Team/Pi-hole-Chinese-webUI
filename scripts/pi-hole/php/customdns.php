<?php

    require_once "func.php";

    $customDNSFile = "/etc/pihole/custom.list";

    switch ($_REQUEST['action'])
    {
        case 'get':     echo json_encode(echoCustomDNSEntries());    break;
        case 'add':     echo json_encode(addCustomDNSEntry());      break;
        case 'delete':  echo json_encode(deleteCustomDNSEntry());   break;
        default:
            die("错误的动作");
    }

    function echoCustomDNSEntries()
    {
        $entries = getCustomDNSEntries();

        $data = [];
        foreach ($entries as $entry)
            $data[] = [ $entry->domain, $entry->ip ];

        return [ "data" => $data ];
    }

    function getCustomDNSEntries()
    {
        global $customDNSFile;

        $entries = [];

        $handle = fopen($customDNSFile, "r");
        if ($handle)
        {
            while (($line = fgets($handle)) !== false) {
                $line = str_replace("\r","", $line);
                $line = str_replace("\n","", $line);
                $explodedLine = explode (" ", $line);

                if (count($explodedLine) != 2)
                    continue;

                $data = new \stdClass();
                $data->ip = $explodedLine[0];
                $data->domain = $explodedLine[1];
                $entries[] = $data;
            }

            fclose($handle);
        }

        return $entries;
    }

    function addCustomDNSEntry()
    {
        try
        {
            $ip = !empty($_REQUEST['ip']) ? $_REQUEST['ip']: "";
            $domain = !empty($_REQUEST['domain']) ? $_REQUEST['domain']: "";

            if (empty($ip))
                return errorJsonResponse("必须设置IP");

            $ipType = get_ip_type($ip);

            if (!$ipType)
                return errorJsonResponse("请使用有效的IP");

            if (empty($domain))
                return errorJsonResponse("必须设置域名");

            if (!is_valid_domain_name($domain))
                return errorJsonResponse("域名无效");

            $existingEntries = getCustomDNSEntries();

            foreach ($existingEntries as $entry)
                if ($entry->domain == $domain)
                    if (get_ip_type($entry->ip) == $ipType)
                        return errorJsonResponse("该域已经具有用于IPv6的自定义DNS条目" . $ipType);

            exec("sudo pihole -a addcustomdns ".$ip." ".$domain);

            return successJsonResponse();
        }
        catch (\Exception $ex)
        {
            return errorJsonResponse($ex->getMessage());
        }
    }

    function deleteCustomDNSEntry()
    {
        try
        {
            $ip = !empty($_REQUEST['ip']) ? $_REQUEST['ip']: "";
            $domain = !empty($_REQUEST['domain']) ? $_REQUEST['domain']: "";

            if (empty($ip))
                return errorJsonResponse("IP must be set");

            if (empty($domain))
                return errorJsonResponse("Domain must be set");

            $existingEntries = getCustomDNSEntries();

            $found = false;
            foreach ($existingEntries as $entry)
                if ($entry->domain == $domain)
                    if ($entry->ip == $ip) {
                        $found = true;
                        break;
                    }

            if (!$found)
                return errorJsonResponse("该域/ IP关联不存在");

            exec("sudo pihole -a removecustomdns ".$ip." ".$domain);

            return successJsonResponse();
        }
        catch (\Exception $ex)
        {
            return errorJsonResponse($ex->getMessage());
        }
    }

    function successJsonResponse($message = "")
    {
        return [ "success" => true, "message" => $message ];
    }

    function errorJsonResponse($message = "")
    {
        return [ "success" => false, "message" => $message ];
    }
?>
