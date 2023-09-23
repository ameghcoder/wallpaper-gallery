document.addEventListener('DOMContentLoaded', ()=>{
    function $(e){
        return document.querySelector(e);
    }
    // 
    const imgShareBtn = document.querySelector('.img-share-btn');
    const closeImgShareBtn = document.querySelector('.share-box-inside > button');
    imgShareBtn 
    ? imgShareBtn.addEventListener('click', ()=>{
        document.querySelector(".share-box").classList.add("zoom-in");document.querySelector(".share-box").classList.remove("zoom-out");
    })
    : 0;
    closeImgShareBtn
    ? closeImgShareBtn.addEventListener('click', ()=>{
        document.querySelector(".share-box").classList.add("zoom-out");document.querySelector(".share-box").classList.remove("zoom-in");
    })
    : 0;
    $('#preview-img')   
        ? $('#preview-img').addEventListener('click',() => {
            $('body').classList.add('disable-scrolling');
            if($('.model-img-url').hasAttribute('src')){
                $('.model-img').style.display = 'block';
                if ($('.model-img').requestFullscreen) {
                    $('.model-img').requestFullscreen();
                } else if ($('.model-img').webkitRequestFullscreen) { /* Safari */
                    $('.model-img').webkitRequestFullscreen();
                } else if ($('.model-img').msRequestFullscreen) { /* IE11 */
                    $('.model-img').msRequestFullscreen();
                }
            } else{
                $('.model-img-url').setAttribute('src', $('#img-heading').getAttribute('value'));
                $('.model-img').style.display = 'block';
                if ($('.model-img').requestFullscreen) {
                    $('.model-img').requestFullscreen();
                } else if ($('.model-img').webkitRequestFullscreen) { /* Safari */
                    $('.model-img').webkitRequestFullscreen();
                } else if ($('.model-img').msRequestFullscreen) { /* IE11 */
                    $('.model-img').msRequestFullscreen();
                }
            }
        })
        : 0;
    $('.close-model').addEventListener('click', ()=>{
        if (document.exitFullscreen) {
            document.exitFullscreen();
        } else if (document.webkitExitFullscreen) { /* Safari */
            document.webkitExitFullscreen();
        } else if (document.msExitFullscreen) { /* IE11 */
            document.msExitFullscreen();
        }
        document.querySelector('.model-img').style.display='none';
        document.querySelector('body').classList.remove('disable-scrolling');
    })
    if($('.copy-link')){      
        $('.copy-link').addEventListener('click', ()=>{
            var temp = document.createElement('input');
            $("body").append(temp);
            // temp.value = window.location.href;
            temp.value = document.querySelector("input.pageURL").value;
            /* Select the text field */
            temp.select();
            temp.setSelectionRange(0, 99999); /* For mobile devices */
            
            /* Copy the text inside the text field */
            navigator.clipboard.writeText(temp.value);
            $('.copy-link').innerHTML = "Copied &#10003;";
            setTimeout(()=>{$('.copy-link').innerHTML = "Copy Link";}, 2000)
            temp.remove();
        })
    }

    // Packed Code
    // Load On Scrolls
        
        const Update = (id, flag)=> {
            const v_url = "/api/update?id=" + id + "&flag=" + flag;
            return new Promise((resolve, reject) => {
                var xhttp = new XMLHttpRequest();
                xhttp.onreadystatechange = function () {
                    if (this.readyState == 4) {
                        if (this.status == 200) {
                            resolve(this.responseText);
                        } else {
                            reject(this.statusText);
                        }
                    }
                }
                xhttp.open('GET', v_url, true);
                xhttp.send();
            })
        }
        if(document.getElementById('data-id-of-img')){
            const id_u = document.getElementById('data-id-of-img').dataset['id'];
            setTimeout(() => {
                Update(id_u, "v").then((val)=>{
                    document.getElementById('number-of-view').innerText = val;
                }).catch((err) => {
                    console.error(err);
                })
            }, 3000);

            document.getElementById('img-download-btn').addEventListener('click', ()=>{
                Update(id_u, "d").then((val)=>{
                    document.getElementById('number-of-downloads').innerText = val;
                }).catch((err) => {
                    console.error(err);
                })
            })
            const setViewDown = () => {
                fetch(`/api/get_d?id=${id_u}`).then(val=>val.json()).then((ex_val)=>{
                    document.getElementById('number-of-downloads').innerText = ex_val["down"];
                    document.getElementById('number-of-view').innerText = ex_val["view"];
                }).catch((err)=>{
                    console.error(err);
                })
            }
            setViewDown();
        }
        
        const loading = (id, type, keywords)=> {
            let surl = "";
            if(keywords == null){
                surl = "/api/send?id=" + id + "&type=" + type;
            } else {
                surl = "/api/send?id=" + id + "&type=" + type + "&keywords=" + keywords;
            }
            return new Promise((resolve, reject) => {
                var xhttp = new XMLHttpRequest();
                xhttp.onreadystatechange = function () {
                    if (this.readyState == 4) {
                        if (this.status == 200) {
                            resolve(this.responseText);
                        } else {
                            reject(this.statusText);
                        }
                    }
                }
                xhttp.open('GET', surl, true);
                xhttp.send();
            })
        }

        function urlFormatter(){
            let curl0 = window.location.pathname;
            let curl2 = window.location.hostname;
            if(curl2 == "www.wallpaper-access.com" || curl2 == "wallpaper-access.com"){
                curl0 = curl0.split('/');
                if(curl0[0] == "" && curl0[1] == ""){
                    return curl0[1];
                } else if(curl0[0] == "" && (curl0[1] == "search" || curl0[1] == "w")){
                    return curl0[1];                    
                } else if(curl0[0] == "" && curl0[1] == "category"){
                    return curl0[1];
                }
            }
        }

        let divLoader = document.createElement('div');
        divLoader.setAttribute("class", "loader");
        divLoader.setAttribute("style", "text-align : center;");
        
        let imgLoader = document.createElement('img');
        imgLoader.setAttribute("src", "/assets/loader.gif");
        
        divLoader.append(imgLoader);
        
        let html = '<div class="loader" style="text-align : center;"><img src="/assets/loader.gif" /></div>' ;
        function checkEnd() {
            const cbox = document.querySelector("div.psric-btm");
            let observer = new IntersectionObserver((entries, observer) => {
                entries.forEach(entry => {
                    if (!entry.isIntersecting) return;
                    // get id
                    let id = document.querySelectorAll('.img-anchor');
                    id = id[id.length - 1].getAttribute('data-id');
                    // get type
                    let keywords = null;
                    let sType = urlFormatter();
                    if(sType == ""){
                        sType = "index";
                    } else if(sType == "search"){
                        keywords = decodeURI(window.location.search.split("wallpaper=")[1]).toLowerCase();
                        sType = "sr";
                    } else if(sType == "w"){
                        keywords = decodeURI(window.location.pathname.split('/')[2]).toLowerCase();
                        sType = "sr";
                    } else if(sType == "category"){
                        sType = "category";
                        keywords = decodeURI(window.location.pathname.split("/")[2]).toLowerCase();
                    }
                    // loader gif
                    let appendWhere = document.querySelector('.img-section');
                    
                    appendWhere.append(divLoader);
                    // send and get
                    loading(id, sType, keywords).then((val)=>{
                        setTimeout(()=>{
                            if(val == false){
                                appendWhere.innerHTML +=  "No more wallpaper in this category.";
                                document.querySelector('.loader').remove();
                            } else{
                                const appendHere = document.querySelector('.img-box');
                                appendHere.insertAdjacentHTML("beforeend", val);
                                document.querySelector('.loader').remove();
                                checkEnd();
                            }
                        }, 2000)
                    }).catch((err)=>{
                        document.querySelector('.loader').remove();
                        appendWhere.innerHTML += err;
                    })
                    observer.unobserve(cbox);
                });
            });

            observer.observe(cbox);
        }
        checkEnd();
    // Packed Code
})