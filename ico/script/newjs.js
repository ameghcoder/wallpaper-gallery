// message printer
const showMessage = () => { $('.floating-message').style.right = '10px'; setTimeout(() => { $('.floating-message').style.right = '-300px'; $('span.message').innerHTML = ''; $('.message-type').style.innerHTML = ''; }, 3000) }
const printMessage = (msg, tag) => { $('span.message').innerHTML = msg; (tag == 's') ? ($('div.floating-message').style.background = "var(--success-background)") : ($('div.floating-message').style.background = 'var(--error-background)'); (tag == 's') ? ($('i.message-type').innerHTML = '✔️') : ($('i.message-type').innerHTML = '❌'); showMessage(); }
// message printer
let iFile;
function AddImgData(e) { 
    iFile = '';
    console.log(e.target.files.length);
    // for(let i = 0; i < e.target.files.length; i++){
    //     // iFile = e.target.files[0] + e.target.files[1]; 
    //     console.log(e.target.files[i]);
    // }
    // console.log(iFile); 
    display(e); 
}
const app = () => {
    // check file input
    const inputFile = (e) => { (Array.from(e.target.files).length > 5) ? (printMessage('You have only 5 Image limits at a time', 'e')) : (printMessage('Image uploaded successfully', 's')); AddImgData(e); };
    $('input[type="file"]') ? $('input[type="file"]').addEventListener('change', inputFile) : 1;
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
        let compressionRatio = ((parseInt(respParse['psize']) - parseInt(respParse['csize']))/parseInt(respParse['psize'])).toFixed(2) * 100;
        if(compressionRatio < 0){
            compressionRatio = -compressionRatio;
            compressionRatio = compressionRatio.toFixed(2) + "%" + " Bigger";
        } else{
            compressionRatio = compressionRatio.toFixed(2) + "%" + " Lower";
        }
        $('.img-compression-ratio').innerText = compressionRatio;
        printMessage('Task Done !', 's');
    }
}
// parse data
const tool = () => {
    let form = new FormData();
    form.append('token', '9FAB1FA1B95D13F1118C36BC6A79A');
    form.append('file', iFile);
    form.append('tool', 'res');
    form.append('imgWid', $('.new-Width').value);
    form.append('imgHei', $('.new-Height').value);
    resAjax(form).then((data) => {
        parseData(data);
    }).catch((er) => {
        printMessage(er, 'e');
    });

}
// progress bar
let startT, BlinkTid, tempStartValue = 0, startProgress;
const progress = (end, start = startT, callback = false) => {
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

    // startProgress = setInterval(()=>{
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
    // }, 10)
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
    let gridImgBoxInside = document.querySelector('.grid-img-box-inside');
    if ($('.input-file-area')) {
        $('.input-file-area').classList.add('hide-click-area');
    }
    for(let i = 0; i < e.target.files.length; i++){
        console.log('function start');
        let image = e.target.files[i];
        console.log(image);
        if (image == undefined || image.length == 0) { printMessage("This image is not a valid image or Try Again.", "e"); return 0; };
        const DimImg = new Image();
        const reader = new FileReader();
        reader.readAsDataURL(image);
        reader.onload = function (event) {
            DimImg.src = event.target.result;
            const img = document.createElement('img');
            const div = document.createElement('div');
            const strong = document.createElement('strong');
            const em = document.createElement('em');
            img.src = event.target.result;
            img.setAttribute('class', 'uploaded-img');
            em.setAttribute('id', 'original-width-height');
            em.style.textDecoration = 'underline';
            DimImg.onload = () => {
                let setWidth = $('#original-width-height');
                if (setWidth != null) {
                    OriginalWidth = DimImg.width;
                    OriginalHeight = DimImg.height;

                    em.innerText = DimImg.width + '×' + DimImg.height;
                    strong.insertAdjacentHTML('afterbegin', "Dimension : " + em);
                    div.insertAdjacentHTML('beforeend', img);
                    div.insertAdjacentHTML('beforeend', strong);
                    gridImgBoxInside.append(div);
                }
            }
        }
        reader.onerror = function (event) {
            printMessage("Image loading failed.", 'e');
        }
        console.log('function end');
    }
    $('.sb-dimension').classList.add('newDimension-box');
}
// click btn
$('.start-btn').addEventListener('click', tool);
// click btn
function displayInfo() {

}

// request sender
function resAjax(form) {
    $('.img-process').classList.add('newDimension-img-process-box');
    $('.bar-0-100').style.width = "0%";
    $('.pb-count').innerHTML = 0;
    return new Promise((resolve, reject) => {
        const xhttp = new XMLHttpRequest();
        xhttp.open('POST', '/api/api_xyz', true);
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
$('.new-Width').addEventListener('input', ratioForWidth);
$('.new-Height').addEventListener('input', ratioForHeight);
$('input[type=number]').addEventListener('change', invalid);
document.addEventListener('DOMContentLoaded', app)