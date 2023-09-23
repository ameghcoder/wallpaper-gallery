let number_of_request = 0;
let ad_loaded_json = "";
// pointing tag
let body = document.querySelector('body');
let h1_tag = document.querySelector('h1');
let main = document.querySelector('main');
let inputFileArea = false, textContainerArea = false;
document.querySelector('.text-container')?textContainerArea = document.querySelector('.text-container'):0;
document.querySelector('.input-file-area')?inputFileArea = document.querySelector('.input-file-area'):0;

// let script_src = "https://code.jquery.com/jquery-3.6.3.slim.min.js";
// let script_src = "https://securepubads.g.doubleclick.net/tag/js/gpt.js";
// const wait_Script = async (src) =>{
//     const p = new Promise((resolve, reject)=>{
//         fetch(src)
//         .then((r)=>{
//             return r;
//         })
//         .then(()=>{
//             resolve(true);
//         })
//         .catch(()=>{
//             reject(false);
//         })
//     })
//     let a_wait = await p;
//     return a_wait;
// }
// const testing = (src) => {
//     let respond = wait_Script(src);
//     respond
//     .then(()=>{
//         getAd("/script/_code.json");
//     })
//     .catch(()=>{
//         console.error("Something Went Wrong, in testing()");
//         if(number_of_request < 5){
//             number_of_request++;
//             testing(script_src);
//         }
//     })
// }
const getAd = (path)=>{
    fetch(path)
    .then((r)=>{return r.json();})
    .then((json)=>{
        ad_loaded_json = json;
        putAd();
    })
    .catch(()=>{
        if(number_of_request < 5){
            console.error("Something Went Wrong, in getAd()");
            number_of_request++;
            testing(script_src);
        }
    });
}
const putAd = ()=>{
    let wdw_width = width_checker();
    if(wdw_width > 1450){
        sky_crappers();
    }
    if(wdw_width > 730){
        desktop_ads();
    }
    mobile_ads();
}

// function for skycrappers
const sky_crappers = () => {
    if(document.querySelector('.left-sky-crapper-set') == null){
        let div01 = div_element_creator();
        let div02 = div_element_creator();
        div01.setAttribute('class', 'ico-sky-crappers-right left-sky-crapper-set');
        div01.innerHTML = ad_loaded_json['sky']['left'];
        div02.setAttribute('class', 'ico-sky-crappers-left');
        div02.innerHTML = ad_loaded_json['sky']['right'];
        body.append(div02);
        body.append(div01);
    }
}
// function for desktop ads
const desktop_ads = () => {
    let curr_wid = width_checker();
    let _div01 = div_element_creator();
    _div01.setAttribute('class', 'ico-long-ads-box desktop-ad-730px');
    _div01.innerHTML = ad_loaded_json['desktop']['728px'];

    if(curr_wid >= 730 && curr_wid <= 970) {
        if(document.querySelector('.desktop-ad-730px') == null){
            main.insertAdjacentElement('beforebegin', _div01);
        }
    } else if(curr_wid > 970){
        let _div04 = div_element_creator();
        _div04.setAttribute('class', 'ico-long-ads-box desktop-ad-970px');
        _div04.innerHTML = ad_loaded_json['desktop']['970px'];

        if(document.querySelector('.desktop-ad-970px') == null){
            main.insertAdjacentElement('beforebegin', _div04);
            if(inputFileArea != false){
                inputFileArea.insertAdjacentElement('beforebegin', _div01);
            }
        }
    }
}
// function for mobile ads
const mobile_ads = () => {
    let curr_wid = width_checker();
    if(curr_wid < 970){
        if(document.querySelector('.mobile-ad-01') == null){
            let _div0 = div_element_creator();
            let _div1 = div_element_creator();
            _div0.setAttribute('style', 'display : flex; flex-wrap : wrap; width : 100%; align-items : center; margin : 10px 0px;');
            _div1.setAttribute('style', 'display : flex; flex-wrap : wrap; width : 100%; align-items : center; margin : 10px 0px;');

            for(let i = 0; i < 4; i++){
                let _div = div_element_creator();
                _div.setAttribute('class', 'mobile-ico-ads-box mobile-ad-01');
                _div.innerHTML = ad_loaded_json['mobile'][i];
                if(i < 2){
                    _div0.append(_div);
                } else{
                    _div1.append(_div);
                }
            }        
            if(inputFileArea != false){
                inputFileArea.insertAdjacentElement('afterend', _div0);
                inputFileArea.insertAdjacentElement('beforebegin', _div1);
            }
        }
    }else if(curr_wid >= 970){
        // two ads only
        if(document.querySelector('.mobile-ad-01') == null){
            let _div0 = div_element_creator();
            _div0.setAttribute('style', 'display : flex; flex-wrap : wrap; width : 100%; align-items : center; margin : 10px 0px;');
            for(let i = 0; i < 2; i++){
                let _div = div_element_creator();
                _div.setAttribute('class', 'mobile-ico-ads-box mobile-ad-01');
                _div.innerHTML = ad_loaded_json['mobile'][i];
                _div0.append(_div);
            }        
            if(inputFileArea != false){
                inputFileArea.insertAdjacentElement('afterend', _div0);
            }
        }
    }
}   
const width_checker = () => {
    return window.innerWidth;
}
window.onresize = () => {
    putAd();
}
const div_element_creator = () => {
    return document.createElement('div');
}
width_checker();
// testing(script_src);
getAd("/script/_code.json");