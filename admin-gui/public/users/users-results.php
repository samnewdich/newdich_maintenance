<?php
echo '<p>Filter By :</p>';
echo '<form action="" method="GET" enctype="multipart/form-data">';
echo '<table style="width:100%;">';
echo '<tr style="width:100%;">';
echo '<td style="width:33%;"> Reg Date:<br/> <input type="date" id="startfrom" name="startfrom" value="'.$startFrom.'" style="height:35px; width:100%;" /></td>';
echo '<td style="width:33%;">Last Seen:<br/> <input type="date" id="endto" name="endto" value="'.$endTo.'" style="height:35px; width:100%;" /></td>';
echo '<td style="width:33%;">Status:<br/>';
echo '<select name="status" style="width:100%; height:35px;">';
echo '<option value="'.$status.'">'.$status.'</option>';
echo '<option value="">All</option>';
echo '<option value="active">Active</option>';
echo '<option value="inactive">Inactive</option>';
echo '<option value="suspended">Suspended</option>';
echo '</select>';
echo '</td>';
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
echo '<td style="width:33%;">Type:<br/>
<select style="height:35px; width:100%;" name="account_type">
<option value="'.$account_type.'">'.$account_type.'</option>
<option value="">All</option>
<option value="smart_earner">Smart Earners</option>
<option value="top_user">Top Users</option>
<option value="reseller">Resellers</option>
<option value="affiliate">Affiliates</option>
<option value="api">API Users</option>
</select>';
echo '<tr>';
echo '</table>';

echo '<table style="width:100%;">';
echo '<tr style="width:100%;">';
echo '<td style="width:75%;"> Search: <input style="width:100%; height:35px;" type="text" value="'.$searchdata.'" name="searchdata" placeholder="Search By Email | Username | Name | Phone | Referer Code| Login Token | OTP | API Key |" /></td>';
echo '<td style="width:25%;"> <br/> <button style="width:100%; height:35px; background-color:royalblue; color:white; cursor:pointer; border:none; height:35px;">Search</button> </td>';
echo '<tr>';
echo '</table>';
echo '</form>';
echo '<hr/>';


if($allAirtime["statusret"] ==="success"){
    $thePlans = $allAirtime["data"];
    $allRows = $allAirtime["totalRows"];
    $nextp = $allAirtime["nextPage"];
    $dpp = (int) $allAirtime["displayPerPage"];
    echo '<p>Total : '.$allRows.' </p> ';
    
    echo '<div class="table-responsive">';
    echo '<table class="table table-striped">';
    echo '<thead>';
    echo '<tr>';
    echo '<th class="tdscroll">S/N</th>';
    echo '<th class="tdscroll">Username <br/> Full Name  <br/> Email <br/> Account Type <br/> Wallet Balance </th>';
    echo '<th class="tdscroll">Phone<br/> Country <br/> Status <br/> API Key </th>';
    echo '<th class="tdscroll">Reg Date <br/> Last Seen <br/> OTP <br/> OTP/Email Verify</th>';
    echo '<th class="tdscroll">Refer By <br/> Referrer Code<br/> Login Token <br/> Transaction Token Set ?</th>';
    echo '</tr>';
    echo '</thead>';
    $sn = 1;
    for($i = 0; $i < count($thePlans); $i++){
        $plan = $thePlans[$i];

        $jsArgs = [
            json_encode($plan["tableId"]),
            json_encode($plan["userName"]),
            json_encode($plan["fullName"]),
            json_encode($plan["email"]),
            json_encode($plan["phone"]),
            json_encode($plan["country"]),
            json_encode($plan["regDate"]),
            json_encode($plan["lastSeen"]),
            json_encode($plan["status"]),
            json_encode($plan["earn"]),
            json_encode($plan["referCode"]),
            json_encode($plan["referBy"]),
            json_encode($plan["loginToken"]),
            json_encode($plan["otp"]),
            json_encode($plan["otpVerify"]),
            json_encode($plan["accountType"]),
            json_encode($plan["tToken"]),
            json_encode($plan["apiKey"])
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
        ' . htmlspecialchars($plan["fullName"]) . ' <br/>
        ' . htmlspecialchars($plan["email"]) . ' <br/>
        ' . htmlspecialchars($plan["accountType"]) . ' <br/>
        <font style="font-size:14px; font-weight:bolder;">NGN' . htmlspecialchars($plan["walletBalance"]) . '</font>
        </td>';
        echo '<td class="tdscroll">';
        echo htmlspecialchars($plan["phone"]);
        echo '<br/>';
        echo htmlspecialchars($plan["country"]);
        echo '<br/>';
        if(strtolower(htmlspecialchars($plan["status"])) ==='active' || strtolower(htmlspecialchars($plan["status"])) ==='' || strtolower(htmlspecialchars($plan["transactionStatus"])) ===' '){
          echo '<button style="background-color:lightgreen; border:none; border-radius:5px;">';
          echo htmlspecialchars($plan["status"]);
          echo '</button>';
        }
        elseif(strtolower(htmlspecialchars($plan["status"])) !=='actuve' && strtolower(htmlspecialchars($plan["status"])) !=='' && strtolower(htmlspecialchars($plan["status"])) !==' '){
          echo '<button style="background-color:red; color:white; border:none; border-radius:5px;">';
          echo htmlspecialchars($plan["transactionStatus"]);
          echo '</button>';
        }
        echo '<br/>
        ' . htmlspecialchars($plan["apiKey"]) . '
        </td>';
        
        echo '<td class="tdscroll">';
        $theTimeInPHP = (int) htmlspecialchars($plan["regDate"]);
        $theTimeInPHP2 = (int) htmlspecialchars($plan["lastSeen"]);
        echo date('d/M/Y H:i:s', $theTimeInPHP);
        echo '<br/>';
        echo date('d/M/Y H:i:s', $theTimeInPHP2);
        echo '<br/>';
        echo htmlspecialchars($plan["otp"]);
        echo '<br/>';
        if(strtolower(htmlspecialchars($plan["otpVerify"])) ==='yes' || strtolower(htmlspecialchars($plan["otpVerify"])) !==''){
            echo '<font style="color:green;">';
            echo 'Email Verified';
            echo '</font>';
        }
        elseif(strtolower(htmlspecialchars($plan["otpVerify"])) !=='yes' || strtolower(htmlspecialchars($plan["otpVerify"])) ===''){
            echo '<font style="color:red;">';
            echo 'Email Unverified';
            echo '</font>';
        }
        echo '</td>';

        echo '<td class="tdscroll">';
        echo ' <br/>
        ' . htmlspecialchars($plan["referBy"]) . ' <br/>
        ' . htmlspecialchars($plan["referCode"]) . ' <br/>
        ' . htmlspecialchars($plan["loginToken"]) . '<br/>';
        if(htmlspecialchars($plan["tToken"]) !==''){
            echo '<font style="color:green;">Transacton Token Set</font>';
        }
        elseif(htmlspecialchars($plan["tToken"]) ===''){
            echo '<font style="color:red;">Transacton Token Not Set</font>';
        }
        echo '</td>';
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
    echo 'This means no User is found. <br />';
  }
?>