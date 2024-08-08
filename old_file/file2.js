let myDict = {
    "Hughes Network Systems, LLC":
    {
        "data":
        {
            "bundle":
            ["Download speed of up to 25Mbps", "More than 200+ channels with Free HD options", "Select from a variety of local and regional channels"],
            "internet_points":
            ["Download speed of up to 25Mbps \u0026 Upload speed of up to 3Mbps", "Flexible data cap for internet plans", "Contract for 24-months"],
            "tv_points":
            ["More than 200+ channels including FOX Business, Discovery HD, Disney Junior and more", "Select from a variety of local and regional channels", "24/7 customer support available"]
        },
        "download_speed": 25, "index": 4
    },
    "ViaSat, Inc.":
    {
        "data":
        {
            "bundle":
            ["Download speed of up to 300Mbps", "More than 200+ channels with Free HD options", "Select from a variety of local and regional channels"],
            "internet_points":
            ["High-speed internet plans ", "Smooth online streaming", "Best for work/ school from home"],
            "tv_points":
            ["More than 200+ channels including FOX Business, Discovery HD, Disney Junior and more", "Select from a variety of local and regional channels", "24/7 customer support available"]
        },
        "download_speed": 35, "index": 5
    }
    "AT\u0026T Inc.":
    {
        "data":
        {
            "bundle":
            ["Download speed of up to 25Mbps", "More than 200+ channels with Free HD options", "Select from a variety of local and regional channels"],
            "internet_points":
            ["High upload and download speeds", "Unlimited internet data plans", "Modem with WiFi included"],
            "tv_points":
            ["More than 200+ channels including FOX Business, Discovery HD, Disney Junior and more", "Select from a variety of local and regional channels", "24/7 customer support available"]
        },
        "download_speed": 6, "index": 13
    },
    "T-Mobile USA, Inc.":
    {
        "data":
        {
            "bundle":
            ["Download speed of up to 25Mbps", "More than 200+ channels with Free HD options", "Select from a variety of local and regional channels"],
            "internet_points":
            ["Unlimited Gaming, Streaming, Video Calls And More", "No Data Caps", "Wi \u2013 Fi that supports the entire house"],
            "tv_points":
            ["More than 200+ channels including FOX Business, Discovery HD, Disney Junior and more", "Select from a variety of local and regional channels", "24/7 customer support available"]
        },
        "download_speed": 25, "index": 14
    },
};
let names = $('#internetPagePackagesLOBPackageTiles').children().map(function() {
    return $(this).data('name');
}).get();

function internetLOB(){
    for (let key in myDict){
        $("*[data-name='"+key+"']").find('.providerPackageTileKeyPointDescription').eq(0).text(myDict[key]['data']['internet_points'][0]);
        $("*[data-name='"+key+"']").find('.providerPackageTileKeyPointDescription').eq(1).text(myDict[key]['data']['internet_points'][1]);
        $("*[data-name='"+key+"']").find('.providerPackageTileKeyPointDescription').eq(2).text(myDict[key]['data']['internet_points'][2]);
    }
}
function tvLOB(){
    for (let key in myDict){
        $("*[data-name='"+key+"']").find('.providerPackageTileKeyPointDescription').eq(0).text(myDict[key]['data']['tv_points'][0]);
        $("*[data-name='"+key+"']").find('.providerPackageTileKeyPointDescription').eq(1).text(myDict[key]['data']['tv_points'][1]);
        $("*[data-name='"+key+"']").find('.providerPackageTileKeyPointDescription').eq(2).text(myDict[key]['data']['tv_points'][2]);
    }
}
function bundleLOB(){
    for (let key in myDict){
        $("*[data-name='"+key+"']").find('.providerPackageTileKeyPointDescription').eq(0).text(myDict[key]['data']['bundle'][0]);
        $("*[data-name='"+key+"']").find('.providerPackageTileKeyPointDescription').eq(1).text(myDict[key]['data']['bundle'][1]);
        $("*[data-name='"+key+"']").find('.providerPackageTileKeyPointDescription').eq(2).text(myDict[key]['data']['bundle'][2]);
    }
}