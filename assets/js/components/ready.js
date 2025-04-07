export function ready(callback){
    if(document.readyState != 'loading') callback();

    else if (document.addEventListener) document.addEventListener('DOMContentLoaded', callback);
    else document.attachEvent('onreadystatechange', function(){
        if(document.readyState == 'complete') callback()
    })
}

ready(function(){
    console.log('DOM loaded from assets/js/components/ready.js');
    
})