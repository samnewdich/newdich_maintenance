function truncateToTwoDecimals(num) {
    const truncated = Math.floor(num * 100) / 100;
    return truncated.toLocaleString(undefined, { minimumFractionDigits: 2, maximumFractionDigits: 2 });
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