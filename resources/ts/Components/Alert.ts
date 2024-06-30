const alerts = document.getElementsByClassName('remove-paren-when-click') as HTMLCollectionOf<Element>;
for (var i = 0; i < alerts.length; i++) {
    alerts[i].addEventListener('click',(event) => {
        hiddenAlert((event.target as HTMLDivElement).parentElement);
    });
}

const speedHidden = 25; // as millisecond
const hiddenAlert = (element?:HTMLElement|null|undefined) => {
    let opcity = 100;
    if (!element || element === undefined) return;
        if (!/remove-paren-when-click/.test(element.className))
            return hiddenAlert(element.parentElement);
    element = element.parentElement!;
    let timmer = setInterval(() => {
        if (opcity === 10) {
            element.style.opacity = "0";
            setTimeout(() => element.remove(),speedHidden / 2);
            clearInterval(timmer);
        } else {
            opcity -= 10;
            element.style.opacity = `${opcity}%`;
        }
    },speedHidden);
};
