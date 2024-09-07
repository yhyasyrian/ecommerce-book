import hiddenSoothe from "../Functions/hiddenSoothe";

let notification = document.querySelector('[data-alert-toggle]') as HTMLDivElement;
setInterval(() => {
    let attribute:boolean = notification.getAttribute('data-alert-toggle') == "1";
    if (attribute === true){
        hiddenSoothe(notification,25,() => {
            (notification.querySelector('.hidden.close') as HTMLSpanElement).click();
        });
    }
},5000);
