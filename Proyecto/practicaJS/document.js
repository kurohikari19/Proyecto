var p = document.querySelector("#id");
var d = document.querySelector(".d");
var con = document.querySelector(".con");
console.log(d);

d.innerHTML = "Holi desde Js";
d.style.color = "blue";
d.style.backgroundColor = "pink";

var nParrafo = document.createElement("p");
nParrafo.textContent = "Hola soy el nuevo parrafo";
document.body.appendChild(nParrafo);

var nDiv = document.createElement("p");
nDiv.textContent = "Hola soy el nuevo div";
con.appendChild(nDiv);

var boton = document.createElement("button");
boton.textContent = "Boton";
boton.style.color = "white";
boton.style.width = "120px";
boton.style.height = "40px";
boton.style.backgroundColor = "black";
boton.style.position = "fixed";
boton.style.top = "50%";
boton.style.left = "50%";
document.body.appendChild(boton);

var boton2 = document.createElement("button");
boton2.addEventListener("click", function() {
    alert("Haz hecho click en el boton");
});
boton2.textContent = "Boton2";
boton2.style.color = "white";
boton2.style.width = "120px";
boton2.style.height = "40px";
boton2.style.backgroundColor = "black";
boton2.style.position = "fixed";
boton2.style.top = "60%";
boton2.style.left = "50%";
document.body.appendChild(boton2);

var botondbl = document.createElement("button");
botondbl.addEventListener("dblclick", function() {
    alert("Haz hecho doble click en el botondbl");
});
botondbl.textContent = "Botondbl";
botondbl.style.color = "white";
botondbl.style.width = "120px";
botondbl.style.height = "40px";
botondbl.style.backgroundColor = "black";
botondbl.style.position = "fixed";
botondbl.style.top = "70%";
botondbl.style.left = "50%";
document.body.appendChild(botondbl);