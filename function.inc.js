var colors = ["#FF5733", "#33FF57", "#3357FF", "#F3FF33", "#FF33F3", "crimson", "cyan", "gold", "#ff0000", "#9f00ff", "#16ff00", "#00ffac", "#949c9a", "#ffffff"];
var index = 0;
function fondGamble() {
    document.documentElement.style.setProperty('background-color',colors[index]);
    index = (index + 1) % colors.length; // Passer à la couleur suivante (cycle)
}
setInterval(fondGamble, 3000);