import hiddenSoothe from '../Functions/hiddenSoothe';
const alerts = document.getElementsByClassName('remove-paren-when-click') as HTMLCollectionOf<Element>;
for (var i = 0; i < alerts.length; i++) {
    alerts[i].addEventListener('click',(event) => {
        hiddenAlert((event.target as HTMLDivElement).parentElement);
    });
}

const speedHidden = 25; // as millisecond
const hiddenAlert = (element?:HTMLElement|null|undefined) => {
    if (!element || element === undefined) return;
        if (!/remove-paren-when-click/.test(element.className))
            return hiddenAlert(element.parentElement);
    element = element.parentElement!;
    hiddenSoothe(element,speedHidden,()=>setTimeout(() => element.remove(),speedHidden / 2));
};
