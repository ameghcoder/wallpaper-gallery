// message printer
const showMessage = () => { $('.floating-message').style.right = '10px'; setTimeout(() => { $('.floating-message').style.right = '-300px'; $('span.message').innerHTML = ''; $('.message-type').style.innerHTML = ''; }, 3000) }
const printMessage = (msg, tag) => { $('span.message').innerHTML = msg; (tag == 's') ? ($('div.floating-message').style.background = "var(--success-background)") : ($('div.floating-message').style.background = 'var(--error-background)'); (tag == 's') ? ($('i.message-type').innerHTML = '✔️') : ($('i.message-type').innerHTML = '❌'); showMessage(); }
// message printer
let iFile;
let CompressionRatioValueEle = document.getElementById('compression-precent');
let CompressionRatioValue = 75;
let selectExt = document.getElementById('format');
let ConvertTo = 'jpeg';
function AddImgData(e) { 
    iFile = e.target.files[0]; 
    display(e); 
    if((e.target.files[0]['type']).split('/')[1] == 'wbmp' || (e.target.files[0]['type']).split('/')[1] == 'xbm' || (e.target.files[0]['type']).split('/')[1] == 'bmp'){
        let hideEle = document.querySelectorAll('.compression-ratio-box');
        for(let i = 0; i < hideEle.length; i++){
            hideEle[i].style.display = 'none';
        }
    }
}

// parse data 
function parseData(resp) {
    let respParse = JSON.parse(resp);
    if (respParse['flag'] == 'e' || respParse['flag'] == 'w') {
        printMessage(respParse['msg'], 'e');
    } else if (respParse['flag'] == 's') {
        printMessage(respParse['msg'], 's');
    } else if (respParse['flag'] == 'url' && respParse['msg'] != '') {
        $(".additional-info").classList.add('newDimension-img-process-box');
        $('.img-execution-link').setAttribute('href', respParse['msg']);
        $('.img-before-size').innerText = respParse['psize'];
        $('.img-after-size').innerText = respParse['csize'];
        const psize = stringtoKB(respParse['psize']);
        const csize = stringtoKB(respParse['csize']);
        console.log(psize);
        console.log(csize);
        if(csize > psize){
            let precent = -((((psize - csize)/psize) * 100)).toFixed(2) + "%";
            precent = precent + " Bigger";        
            $('.img-compression-ratio').innerText = precent;
        } else{
            let precent = ((((psize - csize)/psize) * 100)).toFixed(2) + "%";
            precent = precent + " Lower";        
            $('.img-compression-ratio').innerText = precent;
        }    
        printMessage('Task Done !', 's');
    }
}
function stringtoKB(data){
    let tempString = data.toString();
    console.log(tempString);
    if(tempString.lastIndexOf("MB") > 0){
        return (parseFloat(tempString) * 1000);
    } else{
        return parseFloat(tempString);
    }
}
const setCompressionsRatio = (e) => {
    CompressionRatioValue = e.target.value;
    CompressionRatioValueEle.innerText = e.target.value + "%";
}
let inputRangeThumb = document.querySelector('input[type="range"]');
inputRangeThumb?inputRangeThumb.addEventListener('input', setCompressionsRatio):0;

// parse data
const tool = (toolid) => {
    let form = new FormData();
    form.append('token', '2AFF268FA3F9FEE4DC1BD71F48691');
    form.append('file', iFile);
    form.append('tool', toolid);
    if(toolid == 'res'){
        form.append('compress', CompressionRatioValue);
        form.append('imgWid', $('.new-Width').value);
        form.append('imgHei', $('.new-Height').value);
        resAjax(form).then((data) => {
            parseData(data);
        }).catch((er) => {
            printMessage(er, 'e');
        });
    } else if(toolid == 'com'){
        form.append('compress', CompressionRatioValue);
        resAjax(form).then((data) => {
            parseData(data);
        }).catch((er) => {
            printMessage(er, 'e');
        });
    } else if(toolid == 'con'){
        form.append('convertto', ConvertTo);
        form.append('compress', CompressionRatioValue);
        resAjax(form).then((data) => {
            parseData(data);
        }).catch((er) => {
            printMessage(er, 'e');
        });
    }
}
// progress bar
let startT, BlinkTid, tempStartValue = 0, startProgress;
function  progress(end, start = startT, callback = false){
    if(startProgress){
        clearInterval(startProgress);
    }
    end = parseInt(end);
    start = parseInt(start);
    startT = end;
    if(end > 100) {
        end = 100;
    }
    tempStartValue = start;
    
    for(let i = start; i <= end; i++){
        $('.bar-0-100').style.width = i + "%";
        $('.pb-count').innerHTML = i + "%";
        if(i == end || i == 100 || i > 100){
            clearInterval(startProgress);   
            if(end != 100 || i < 100){
                $('.pb-count').innerHTML = i + "%" + ' Wait ...';
                if(!callback){
                    console.log(true);
                } else{
                    startBlink('.pb-inside');
                    setTimeout(stopBlink(BlinkTid), 5000);
                }
            }
        }  else if(end == 100){
            $('.pb-count').innerHTML = 100 + "%";
            clearInterval(startProgress);
        }
    }
}
function startBlink(id){
    BlinkTid = setInterval(()=>{
        document.querySelector(id).classList.toggle('change-back');
    }, 500);
}
const stopBlink = (id) => {
    clearInterval(id);
}
// display
let OriginalHeight, OriginalWidth;
function display(e) {
    let image = e.target.files[0];
    if (image == undefined || image.length == 0) { printMessage("This image is not a valid image or Try Again.", "e"); return 0; };
    if ($('.input-file-area')) {
        $('.input-file-area').classList.add('hide-click-area');
    }
    let DimImg = new Image();
    let reader = new FileReader();
    reader.readAsDataURL(image);
    reader.onload = function (event) {
        DimImg.src = event.target.result;
        document.querySelector('.uploaded-img').setAttribute('src', event.target.result);
        // image box
        $('.grid-img-box').style.display = 'flex';
        DimImg.onload = () => {
            let setWidth = $('#original-width-height');
            if (setWidth != null) {
                OriginalWidth = DimImg.width;
                OriginalHeight = DimImg.height;
                $('#original-width-height').innerHTML = DimImg.width + '×' + DimImg.height;
                $('.sb-dimension').classList.add('newDimension-box');
                // $('.img-process').classList.add('newDimension-box');
            }
        }
    }
    reader.onerror = function (event) {
        printMessage("Image loading failed.", 'e');
    }
}
// click btn
let toolStartBtn =  $('.start-btn');
toolStartBtn?$('.start-btn').addEventListener('click', (e)=>{
    e.preventDefault();
    if(selectExt){
        ConvertTo = selectExt.value;
        console.log(ConvertTo);
    }
    tool(toolStartBtn.dataset.tool);
}):0;
// click btn
// Select Convert Ext
// request sender
function resAjax(form) {
    $('.img-process').classList.add('newDimension-img-process-box');
    $('.bar-0-100').style.width = "0%";
    $('.pb-count').innerHTML = 0;
    let begin = Date.now();
    return new Promise((resolve, reject) => {
        const xhttp = new XMLHttpRequest();
        xhttp.open('POST', '/ico/api/api_xyz', true);
        xhttp.setRequestHeader("Cache-Control", "no-cache, no-store, must-revalidate");
        progress(25, 1, startBlink);
        xhttp.onreadystatechange = function () {
            if(this.readyState == 2){
                progress(50, 26, startBlink);
            } else if(this.readyState == 3){
                progress(75, 50, startBlink);
            } else if (this.readyState == 4) {
                progress(100, 76);
                if (this.status == 200) {
                    let end = Date.now();
                    let totalTime = (end - begin)/1000 + ' secs';
                    $('.img-time-of-exe').innerText = totalTime;
                    resolve(this.responseText);
                } else {
                    mb('An error occurred', 'e');
                    reject(this.statusText);
                }
            }
        }
        xhttp.send(form);
    })
}
// request sender

// onenter width and height change them in corresponding original values of width and height
const ratioForWidth = (e) => {
    (e.target.value > 15000) ? (e.target.style.background = 'var(--error-background)') : (e.target.style.background = 'var(--b-u-clr)'); 
    $('#newHeight').value = parseInt((OriginalHeight/OriginalWidth) * e.target.value);
}
const ratioForHeight = (e) => {
    (e.target.value > 15000)?(e.target.style.background='var(--error-background)'):(e.target.style.background='var(--b-u-clr)'); 
    $('#newWidth').value = parseInt((OriginalWidth/OriginalHeight) * e.target.value);
}
// for invalide input value change background color
const invalid = (e) => {
    (e.target.value > 15000)?(e.target.style.background='var(--error-background)'):(e.target.style.background='var(--b-u-clr)');
}
$('.new-Width')?$('.new-Width').addEventListener('input', ratioForWidth):0;
$('.new-Height')?$('.new-Height').addEventListener('input', ratioForHeight):0;
$('input[type=number]')?$('input[type=number]').addEventListener('change', invalid):0;
const app = () => {
    // check file input
    const inputFile = (e) => { (Array.from(e.target.files).length > 5) ? (printMessage('You have only 5 Image limits at a time', 'e')) : (printMessage('Image uploaded successfully', 's')); AddImgData(e); };
    $('input[type="file"]') ? $('input[type="file"]').addEventListener('change', inputFile) : 1;
}
document.addEventListener('DOMContentLoaded', app)