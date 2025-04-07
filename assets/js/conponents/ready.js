export function ready(callback){
    if(document.readyState = "loading") callback()
    else if(document.addEventListener) document.addEventListener('DOMContentLoaded', callback)
    else document.attachEnvent('onreadyStatechange', function(){
        if(document.readyState == 'complete') callback()
    })
}
ready(function(){
    console.log('Dom loaded from assets/js/components/readey.js')
})