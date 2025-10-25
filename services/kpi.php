<?php
    $kpi = [
        "average" => 0,
        "requests" => 0,
        "operations" => 0,
        "profits" => 0,
        "totalCapital" => 0,
        "onLine" => 0,
        "services" => 0,
        "hours" => 0,
    ];

    $seconds = 0;
    $services = 0;

    $logs = glob(dirname(__DIR__) . '/../*.log');

    foreach($logs as $log)
    {
        $account = basename(str_replace(".log","",$log));
        $content = file_get_contents($log);

        //SECONDS AVERAGE, OPERATIONs AND PROFITS
        $rows = explode("\n", $content);

        foreach ($rows as $key=>$row) 
        {
            if(str_contains($row, "signal found"))
            {
                $kpi["requests"]++;
                $array = explode("[", $row);
                $second = trim(str_replace("secs]","",$array[1]));
                $seconds += (float)$second;
            }

            if(str_contains($row, "Profits"))
            {
                $kpi["operations"]++;

                $array = explode("Profits: ", $row);
                $profit = trim(str_replace("USDT","",$array[1]));
                $kpi["profits"] += (float)$profit;
            }
        }

        //TOTAL CAPITAL
        $rows = array_reverse(explode("\n", $content));

        foreach ($rows as $key=>$row) 
        {
            if(str_contains($row, "Account balance"))
            {
                $array = explode(":", $row);
                $balance = str_replace("USDTM","",trim($array[3]));
                $balance = (float) str_replace(",",".",trim($balance));
                $kpi["totalCapital"] += $balance;
                break;
            }
        }

        //Online Offline
        $response = shell_exec("ps -ef | grep ".$account);

        $kpi["services"]++;

        if(str_contains($response, "init.php"))
        {
            $kpi["onLine"]++;
        }
    }

    $kpi["average"] = number_format($seconds/$kpi["requests"],2,".","");
    $kpi["hours"] = (int)(($kpi["requests"]*5)/60)
?>