function noThing(){}
export default function hiddenSoothe(element:HTMLElement,speedHidden:number=25,functionAfterEnd:CallableFunction=noThing){
    let opacity = 100;
    let timer = setInterval(() => {
        if (opacity === 10) {
            element.style.opacity = "0";
            functionAfterEnd();
            clearInterval(timer);
        } else {
            opacity -= 10;
            element.style.opacity = `${opacity}%`;
        }
    },speedHidden);
}
