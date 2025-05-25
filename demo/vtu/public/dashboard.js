function getUserName(){
    try{
        let lis = localStorage.getItem("dataSessioned");
        if(lis === null || lis === undefined && lis =='' && lis ==='')
        return;
        
        let mysess = JSON.parse(lis);
        let myUserName = mysess.data.userName;
        return myUserName;
    }
    catch(erro){
        console.error(erro.message);
    }
}




function getEmail(){
    try{
        let lis = localStorage.getItem("dataSessioned");
        if(lis === null || lis === undefined && lis =='' && lis ==='')
        return;
        
        let mysess = JSON.parse(lis);
        let myEmail = mysess.data.email;
        return myEmail;
    }
    catch(erro){
        console.error(erro.message);
    }
}




function getFullName(){
    try{
        let lis = localStorage.getItem("dataSessioned");
        if(lis === null || lis === undefined && lis =='' && lis ==='')
        return;
        
        let mysess = JSON.parse(lis);
        let myFname = mysess.data.fullName;
        return myFname;
    }
    catch(erro){
        console.error(erro.message);
    }
}




function getPhone(){
    try{
        let lis = localStorage.getItem("dataSessioned");
        if(lis === null || lis === undefined && lis =='' && lis ==='')
        return;
        
        let mysess = JSON.parse(lis);
        let myPhone = mysess.data.phone;
        return myPhone;
    }
    catch(erro){
        console.error(erro.message);
    }
}




function getStatus(){
    try{
        let lis = localStorage.getItem("dataSessioned");
        if(lis === null || lis === undefined && lis =='' && lis ==='')
        return;
        
        let mysess = JSON.parse(lis);
        let myStatus = mysess.data.status;
        return myStatus;
    }
    catch(erro){
        console.error(erro.message);
    }
}




function getAccountType(){
    try{
        let lis = localStorage.getItem("dataSessioned");
        if(lis === null || lis === undefined && lis =='' && lis ==='')
        return;
        
        let mysess = JSON.parse(lis);
        let myAccountType = mysess.data.accountType;
        return myAccountType;
    }
    catch(erro){
        console.error(erro.message);
    }
}




function getTokenStatus(){
    try{
        let lis = localStorage.getItem("dataSessioned");
        if(lis === null || lis === undefined && lis =='' && lis ==='')
        return;
        
        let mysess = JSON.parse(lis);
        let myTokenStatus = mysess.data.ttokenStatus;
        return myTokenStatus;
    }
    catch(erro){
        console.error(erro.message);
    }
}


function getOtpVerify(){
    try{
        let lis = localStorage.getItem("dataSessioned");
        if(lis === null || lis === undefined && lis =='' && lis ==='')
        return;
        
        let mysess = JSON.parse(lis);
        let myotpVerify = mysess.data.otpVerify;
        return myotpVerify;
    }
    catch(erro){
        console.error(erro.message);
    }
}




function checkLogged(){
    try{
        if(localStorage.getItem("dataSessioned") !==null && localStorage.getItem("dataSessioned") !==undefined && localStorage.getItem("dataSessioned") !=='' && localStorage.getItem("dataSessioned") !=''){
            console.log("logged in");
        }
        else{
            return window.location="/login";
        }
    }
    catch(error){
        console.error(error.message);
    }
}
//call the checkLogged to see if he is logged in
checkLogged();



//for balance check
function truncateToTwoDecimals(num) {
    return Math.floor(num * 100) / 100;
}
//Balance
function userWalletBalance(){
    let userEmail = getEmail();
    let userCurrency ="NGN";
    let dataWallet =`email=${userEmail}&currency=${userCurrency}`;
    $.ajax({
        url:"/Controller/UserWalletBalance.php",
        method:"POST",
        dataType:"html",
        data:dataWallet,
        cache:false,
        beforeSend:function(){
            document.getElementById("avalibaloopen").innerHTML=`<font style="font-size:8px; color:royalblue;">loading...</font>`;
        },
        success:function(balres){
            try{
                if(balres !==null && balres !==undefined && balres !==''){
                    let decBalRes = JSON.parse(balres);
                    if(decBalRes["statusret"] ==="success"){
                        let walletBalance = decBalRes["data"]["walletBalance"];
                        let truncatedPrice = truncateToTwoDecimals(walletBalance);
                        document.getElementById("avalibaloopen").innerHTML=`${userCurrency}${truncatedPrice.toFixed(2)}`;
                    }
                    else{
                        document.getElementById("avalibaloopen").innerHTML=`${userCurrency}0.00`;
                    }
                }
                else{
                    document.getElementById("avalibaloopen").innerHTML=`0.00`;
                }
            }
            catch(error){
                console.error(error.message);
            }
        }
    });
}

//function to capitalize
function capitalizeString(data){
    let firstValueOfData = data.substr(0,1);
    let otherValueofData = data.substr(1);
    let firstValueOfDataToUpper = firstValueOfData.toUpperCase();
    let otherValueofDataToLower = otherValueofData.toLowerCase();
    //concatenate
    return `${firstValueOfDataToUpper}${otherValueofDataToLower}`;
}

//function to format time to client timezone
function timeToClientZone(timestampInPHP){
    let timeStampinJs = parseInt(timestampInPHP) * 1000;

    const dateObj = new Date(timeStampinJs);
    const formatted = dateObj.toLocaleString('en-US', {
        month: 'short',    // "Oct"
        day: '2-digit',    // "23"
        year: 'numeric',   // "2024"
        hour: '2-digit',
        minute: '2-digit',
        hour12: true       // 12-hour format with AM/PM
    });

    // If you want to adjust formatting to "Oct 23 2024, 10:30PM" (remove comma before year)
    const parts = formatted.replace(',', '').split(',');
    const finalFormat = `${parts[0]},${parts[1].replace(' ', '')}`; // "Oct 23 2024,10:30PM"
    return finalFormat;
}

//For recent history
function recentHistory(){
    let emini = getEmail();
    let eminiuser = getUserName();
    let dataRecentHist =`email=${emini}&username=${eminiuser}`;
    $.ajax({
        url:"/Controller/RecentHistory.php",
        method:"POST",
        dataType:"html",
        data:dataRecentHist,
        cache:false,
        beforeSend:function(){
            document.getElementById("recento").innerHTML=`Loading..`;
        },
        success:function(datares){
            //console.log(datares);
            try{
                if(datares !== undefined && datares !== null && datares !==''){
                    let dataResponse = JSON.parse(datares);
                    let outputdisplay =`<table class="table-recent-activity">`;
                    for(let i = 0; i < dataResponse.length; i++){
                        let iyiloop = dataResponse[i];
                        let transactionType = iyiloop.transactionType;
                        let dateCompleted = iyiloop.dateCompleted;
                        let amountTransacted = iyiloop.amountTransacted;
                        let currency = iyiloop.currency;
                        let transactionStatus = iyiloop.transactionStatus;

                        //set icon
                        let histIcon ="";
                        if(transactionType.includes("airtime")){
                            histIcon ='<i class="bi bi-telephone-inbound-fill icon-size-bold icon-cover"></i>';
                        }
                        else if(transactionType.includes("data")){
                            histIcon ='<i class="bi bi-database-fill icon-size-bold icon-cover"></i>';
                        }
                        else if(transactionType.includes("cable")){
                            histIcon ='<i class="bi bi-tv-fill icon-size-bold icon-cover"></i>';
                        }
                        else if(transactionType.includes("electricity")){
                            histIcon ='<i class="bi bi-lightbulb-fill icon-size-bold icon-cover"></i>';
                        }
                        else if(transactionType.includes("result")){
                            histIcon ='<i class="bi bi-mortarboard-fill icon-size-bold icon-cover"></i>';
                        }
                        else if(transactionType.includes("sms")){
                            histIcon ='<i class="bi bi-envelope-fill icon-size-bold icon-cover"></i>';
                        }
                        else if(transactionType.includes("deposit")){
                            histIcon ='<i class="bi bi-credit-card-2-front-fill icon-size-bold icon-cover"></i>';
                        }
                        else if(transactionType.includes("credit")){
                            histIcon ='<i class="bi bi-credit-card-2-front-fill icon-size-bold icon-cover"></i>';
                        }
                        else if(transactionType.includes("debit")){
                            histIcon ='<i class="bi bi-credit-card-2-front-fill icon-size-bold icon-cover"></i>';
                        }
                        else{
                            histIcon ='<i class="bi bi-database-fill icon-size-bold icon-cover"></i>';
                        }

                        outputdisplay +=`
                            <tr>
                              <td class="trtd1">${histIcon}</td>
                              <td class="trtd2"><span class="actity-top-left">${capitalizeString(transactionType)}</span><br><span class="actity-down-left">${timeToClientZone(dateCompleted)}</span></td>
                              <td class="trtd3"><span class="actity-top-right">${currency.toUpperCase()}${truncateToTwoDecimals(amountTransacted).toFixed(2)}</span><br><span class="actity-down-right">${transactionStatus}</span></td>
                            </tr>
                        `;
                    }
                    outputdisplay +=`</table><div style="text-align:center;"><a href="/history" style="text-decoration:none; cursor:pointer;"><button class="btn">View All</button></a></div>`;

                    document.getElementById("recento").innerHTML=`${outputdisplay}`;
                }
                else{
                    document.getElementById("recento").innerHTML=`<font style="color:red; font-size:12px; font-weight:bold;">Oops!! something went wrong</font>`;
                }
            }
            catch(errti){
                console.error(errti.message);
            }
        }
    });
}








//JS FOR TEMPLATING
function closeBal(){
    document.getElementById("avalibaloopen").style.display="none";
    document.getElementById("avalibaloclose").style.display="inline-block";
    document.getElementById("closeBal").style.display="none";
    document.getElementById("openBal").style.display="inline-block";
}

function openBal(){
    document.getElementById("avalibaloopen").style.display="inline-block";
    document.getElementById("avalibaloclose").style.display="none";
    document.getElementById("closeBal").style.display="inline-block";
    document.getElementById("openBal").style.display="none";
}