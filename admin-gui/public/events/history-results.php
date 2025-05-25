<?php
if($allAirtime["statusret"] ==="success"){
    $thePlans = $allAirtime["data"];
    $allRows = $allAirtime["totalRows"];
    $nextp = $allAirtime["nextPage"];
    $dpp = (int) $allAirtime["displayPerPage"];
    echo '<p>Total : '.$allRows.' </p> ';
    echo '<p>Filter By :</p>';
    echo '<form action="" method="GET" enctype="multipart/form-data">';
    echo '<table style="width:100%;">';
    echo '<tr style="width:100%;">';
    echo '<td style="width:50%;"> Start:<br/> <input type="date" id="startfrom" name="startfrom" value="'.$startFrom.'" style="height:35px; width:100%;" /></td>';
    echo '<td style="width:50%;">End:<br/> <input type="date" id="endto" name="endto" value="'.$endTo.'" style="height:35px; width:100%;" /></td>';
    echo '<tr>';
    echo '</table>';
    
    echo '<table style="width:100%;">';
    echo '<tr style="width:100%;">';
    echo '<td style="width:33%;"> Rows:<br/>
    <select style="height:35px; width:100%;" name="page_number">
    <option value="'.$pageNumberSearch.'">'.$pageNumberSearch.'</option>
    <option value="10">10</option>
    <option value="20">20</option>
    <option value="50">50</option>
    <option value="100">100</option>
    <option value="150">150</option>
    <option value="200">200</option>
    </select>
    </td>';
    echo '<td style="width:33%;"> Page:<br/>';
    $tpt = ceil($allRows/$pageNumberSearch);
    echo '<select style="height:35px; width:100%;" name="current_page">';
    echo '<option value='.$currentPageSearch.'>'.$currentPageSearchDisplay.'</option>';
    for($x=0; $x<$tpt; $x++){
      $xx = $x+1;
      echo '<option value='.$x.'>'.$xx.'</option>';
    }
    echo '</select>';
    echo '</td>';
    echo '<td style="width:33%;"> Type<br/> <input style="height:35px; width:100%;" value="'.$transaction_type.'" type="text" name="transaction_type" placeholder="e.g 2" /></td>';
    echo '<tr>';
    echo '</table>';

    echo '<table style="width:100%;">';
    echo '<tr style="width:100%;">';
    echo '<td style="width:75%;"> Search: <input style="width:100%; height:35px;" type="text" value="'.$searchdata.'" name="searchdata" placeholder="Search By Email | Username | Transaction Type | Amount | API Provider | Date Completed | Recipient |" /></td>';
    echo '<td style="width:25%;"> <br/> <button style="width:100%; height:35px; background-color:royalblue; color:white; cursor:pointer; border:none; height:35px;">Search</button> </td>';
    echo '<tr>';
    echo '</table>';
    echo '</form>';
    echo '<hr/>';

    echo '<div class="table-responsive">';
    echo '<table class="table table-striped">';
    echo '<thead>';
    echo '<tr>';
    echo '<th class="tdscroll">S/N</th>';
    echo '<th class="tdscroll">Username <br/> Email  <br/> Recipient <br/> Network <br/> Plan Type</th>';
    echo '<th class="tdscroll">Status <br/> Transaction Type <br/> Quantity <br/> Plan <br/> API Provider </th>';
    echo '<th class="tdscroll">Amount(Fee/Discount) <br/> Initial Balance <br/> Final Balance <br/> Currency <br/> Transaction Ref</th>';
    echo '<th class="tdscroll">Date Initiated <br/> Date Completed <br/> Payment Method <br/> Payment Gateway <br/> Payment Ref</th>';
    echo '<th class="tdscroll"> API Message <br/> Our Response</th>';
    echo '</tr>';
    echo '</thead>';
    $sn = 1;
    for($i = 0; $i < count($thePlans); $i++){
        $plan = $thePlans[$i];

        $jsArgs = [
            json_encode($plan["tableId"]),
            json_encode($plan["email"]),
            json_encode($plan["userName"]),
            json_encode($plan["transactionType"]),
            json_encode($plan["amountTransacted"]),
            json_encode($plan["transactionFee"]),
            json_encode($plan["transactionReference"]),
            json_encode($plan["paymentReference"]),
            json_encode($plan["transactionStatus"]),
            json_encode($plan["paymentMethod"]),
            json_encode($plan["paymentGateway"]),
            json_encode($plan["currency"]),
            json_encode($plan["dateInitiated"]),
            json_encode($plan["dateCompleted"]),
            json_encode($plan["planType"]),
            json_encode($plan["message"]),
            json_encode($plan["recipient"]),
            json_encode($plan["initialBalance"]),
            json_encode($plan["finalBalance"]),
            json_encode($plan["networkTransacted"]),
            json_encode($plan["quantityTransacted"]),
            json_encode($plan["plan"]),
            json_encode($plan["apiName"]),
            json_encode($plan["response"])
        ];

        // Implode the arguments into a single JS argument list string
        $jsArgString = implode(', ', $jsArgs);

        // Echo the row with onclick
        echo '<tr style="cursor:pointer;" onclick=\'editDataTypeModal(' . $jsArgString . ')\'>'; // notice the single quotes around onclick

        $cacl = $cpage * $dpp;
        $incsnn = $sn++;
        $snn = $cacl + $incsnn;

        echo '<td class="tdscroll">' .$snn . '</td>';
        echo '<td class="tdscroll">
        ' . htmlspecialchars($plan["userName"]) . ' <br/>
        ' . htmlspecialchars($plan["email"]) . ' <br/>
        ' . htmlspecialchars($plan["recipient"]) . ' <br/>
        ' . htmlspecialchars($plan["networkTransacted"]) . ' <br/>
        ' . htmlspecialchars($plan["planType"]) . '
        </td>';
        echo '<td class="tdscroll">';
        if(strtolower(htmlspecialchars($plan["transactionStatus"])) ==='success' || strtolower(htmlspecialchars($plan["transactionStatus"])) ==='successful' || strtolower(htmlspecialchars($plan["transactionStatus"])) ==='done' || strtolower(htmlspecialchars($plan["transactionStatus"])) ==='delivered' || strtolower(htmlspecialchars($plan["transactionStatus"])) ==='paid' || strtolower(htmlspecialchars($plan["transactionStatus"])) ==='proccessed'){
          echo '<button style="background-color:lightgreen; border:none; border-radius:5px;">';
          echo htmlspecialchars($plan["transactionStatus"]);
          echo '</button>';
        }
        elseif(strtolower(htmlspecialchars($plan["transactionStatus"])) ==='pending' || strtolower(htmlspecialchars($plan["transactionStatus"])) ==='loading' || strtolower(htmlspecialchars($plan["transactionStatus"])) ==='processing' || strtolower(htmlspecialchars($plan["transactionStatus"])) ==='waiting' || strtolower(htmlspecialchars($plan["transactionStatus"])) ==='pend' || strtolower(htmlspecialchars($plan["transactionStatus"])) ==='delivering'){
          echo '<button style="background-color:gold; border:none; border-radius:5px;">';
          echo htmlspecialchars($plan["transactionStatus"]);
          echo '</button>';
        }
        elseif(strtolower(htmlspecialchars($plan["transactionStatus"])) ==='failing' || strtolower(htmlspecialchars($plan["transactionStatus"])) ==='failed' || strtolower(htmlspecialchars($plan["transactionStatus"])) ==='failure' || strtolower(htmlspecialchars($plan["transactionStatus"])) ==='fail' || strtolower(htmlspecialchars($plan["transactionStatus"])) ==='not successful' || strtolower(htmlspecialchars($plan["transactionStatus"])) ==='not delivered'){
          echo '<button style="background-color:red; color:white; border:none; border-radius:5px;">';
          echo htmlspecialchars($plan["transactionStatus"]);
          echo '</button>';
        }
        elseif(strtolower(htmlspecialchars($plan["transactionStatus"])) ==='' || strtolower(htmlspecialchars($plan["transactionStatus"])) ===' ' || strtolower(htmlspecialchars($plan["transactionStatus"])) =='' || strtolower(htmlspecialchars($plan["transactionStatus"])) ==' '){
          echo '<button style="background-color:black; color:white; border:none; border-radius:5px;">';
          echo 'No response';
          echo '</button>';
        }
        echo '<br/>
        ' . htmlspecialchars($plan["transactionType"]) . ' <br/>
        ' . htmlspecialchars($plan["quantityTransacted"]) . ' <br/>
        ' . htmlspecialchars($plan["plan"]) . ' <br/>
        ' . htmlspecialchars($plan["apiName"]) . '
        </td>';
        echo '<td class="tdscroll">
        ' . htmlspecialchars($plan["amountTransacted"]) . '(
        ' . htmlspecialchars($plan["transactionFee"]) . ') <br/>
        ' . htmlspecialchars($plan["initialBalance"]) . ' <br/>
        ' . htmlspecialchars($plan["finalBalance"]) . ' <br/>
        ' . htmlspecialchars($plan["currency"]) . ' <br/>
        ' . htmlspecialchars($plan["transactionReference"]) . '
        </td>';
        echo '<td class="tdscroll">';
        // Convert using Carbon
        $theTimeInPHP = htmlspecialchars($plan["dateInitiated"]);
        $theTimeInPHP2 = htmlspecialchars($plan["dateCompleted"]);
        echo date('d/M/Y H:i:s', $theTimeInPHP);
        echo '<br/>';
        echo date('d/M/Y H:i:s', $theTimeInPHP2);
        echo ' <br/>
        ' . htmlspecialchars($plan["paymentMethod"]) . ' <br/>
        ' . htmlspecialchars($plan["paymentGateway"]) . ' <br/>
        ' . htmlspecialchars($plan["paymentReference"]) . '
        </td>';
        echo '<td class="tdscroll">
        <textarea style="height:50px; width:100%;">' . htmlspecialchars($plan["message"]) . '</textarea> <br/>
        <textarea style="height:50px; width:100%;">' . htmlspecialchars($plan["response"]) . '</textarea>
        </td>';
        echo '</tr>';
    }
    echo '</table>';
    echo '</div>';


    echo '<div class="table-responsive" style="margin-top:10px;">';
    echo '<table class="table table-striped">';
    echo '<tr style="width:100%;">';
    $totalPages = ceil($allRows/$pageNumberSearch);

    echo '<td>';
    echo '<a href="?currentpage=0">';
    echo '<button class="btn" style="text-align:center; cursor:pointer;">';
    echo 'First Page';
    echo '</button>';
    echo '</a>';
    echo '</td>';
    for($p=0; $p<$totalPages; $p++){
        echo '<td>';
        if($cpage === $p){
            echo '<a href="?currentpage='.$p.'">';
            echo '<button class="btn" style="text-align:center; cursor:pointer; background-color:royalblue; color:white;">';
            echo $p+1;
            echo '</button>';
            echo '</a>';
            echo '</td>';
        }
        else{
            echo '<a href="?currentpage='.$p.'">';
            echo '<button class="btn" style="text-align:center; cursor:pointer;">';
            echo $p+1;
            echo '</button>';
            echo '</a>';
            echo '</td>';
        }
    }
    echo '<td>';
    $lastPage = (int) $totalPages - 1;
    echo '<a href="?currentpage='.$lastPage.'">';
    echo '<button class="btn" style="text-align:center; cursor:pointer;">';
    echo 'Last Page';
    echo '</button>';
    echo '</a>';
    echo '</td>';
    echo '</tr>';
    echo '</table>';
    echo '</div>';
  }
  else{
    echo $allAirtime["reason"];
    echo '<br />';
    echo 'This means no History is found. <br />';
  }
?>