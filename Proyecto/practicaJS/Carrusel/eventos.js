var boton = document.createElement("button");
boton.addEventListener("mousedown", function() {
    boton.textContent = "mousedown";
    boton.style.backgroundColor = "red";
    boton.style.color = "black";
});
boton.textContent = "boton1";
boton.style.color = "white";
boton.style.width = "120px";
boton.style.height = "40px";
boton.style.backgroundColor = "black";
boton.style.position = "fixed";
boton.style.top = "70%";
boton.style.left = "10%";
document.body.appendChild(boton);

///////////////////////////////////////////////////////////////////////////

var boton2 = document.createElement("button");
boton2.addEventListener("mouseup", function() {
    boton2.textContent = "mouseup";
    boton2.style.backgroundColor = "blue";
    boton2.style.color = "black";
});
boton2.textContent = "boton2";
boton2.style.color = "white";
boton2.style.width = "120px";
boton2.style.height = "40px";
boton2.style.backgroundColor = "black";
boton2.style.position = "fixed";
boton2.style.top = "70%";
boton2.style.left = "20%";
document.body.appendChild(boton2);

///////////////////////////////////////////////////////////////////////////

var boton3 = document.createElement("button");
boton3.addEventListener("contextmenu", function() {
    boton3.textContent = "contextmenu";
    boton3.style.backgroundColor = "yellow";
    boton3.style.color = "black";
});
boton3.textContent = "boton3";
boton3.style.color = "white";
boton3.style.width = "120px";
boton3.style.height = "40px";
boton3.style.backgroundColor = "black";
boton3.style.position = "fixed";
boton3.style.top = "70%";
boton3.style.left = "30%";
document.body.appendChild(boton3);

///////////////////////////////////////////////////////////////////////////

var boton4 = document.createElement("button");
boton4.addEventListener("mouseleave", function() {
    boton4.textContent = "mouseleave";
    boton4.style.backgroundColor = "violet";
    boton4.style.color = "black";
});
boton4.textContent = "boton4";
boton4.style.color = "white";
boton4.style.width = "120px";
boton4.style.height = "40px";
boton4.style.backgroundColor = "black";
boton4.style.position = "fixed";
boton4.style.top = "70%";
boton4.style.left = "40%";
document.body.appendChild(boton4);

///////////////////////////////////////////////////////////////////////////

var boton5 = document.createElement("button");
boton5.addEventListener("mouseenter", function() {
    boton5.textContent = "mouseenter";
    boton5.style.backgroundColor = "green";
    boton5.style.color = "black";
});
boton5.textContent = "boton5";
boton5.style.color = "white";
boton5.style.width = "120px";
boton5.style.height = "40px";
boton5.style.backgroundColor = "black";
boton5.style.position = "fixed";
boton5.style.top = "70%";
boton5.style.left = "50%";
document.body.appendChild(boton5);

///////////////////////////////////////////////////////////////////////////

var boton6 = document.createElement("button");
boton6.addEventListener("mouseup", function() {
    boton6.textContent = "mouseup";
    boton6.style.backgroundColor = "orange";
    boton6.style.color = "black";
});
boton6.textContent = "boton6";
boton6.style.color = "white";
boton6.style.width = "120px";
boton6.style.height = "40px";
boton6.style.backgroundColor = "black";
boton6.style.position = "fixed";
boton6.style.top = "70%";
boton6.style.left = "60%";
document.body.appendChild(boton6);

///////////////////////////////////////////////////////////////////////////

var boton7 = document.createElement("button");
boton7.addEventListener("keydown", function(event) {
    if (event.key === "1") { 
        boton7.textContent = "keydown";
        boton7.style.backgroundColor = "gray";
        boton7.style.color = "black";
    }
});
boton7.textContent = "boton7";
boton7.style.color = "white";
boton7.style.width = "120px";
boton7.style.height = "40px";
boton7.style.backgroundColor = "black";
boton7.style.position = "fixed";
boton7.style.top = "80%";
boton7.style.left = "10%";
document.body.appendChild(boton7);

///////////////////////////////////////////////////////////////////////////

var boton8 = document.createElement("button");
boton8.addEventListener("keyup", function(event) {
    if (event.key === "2") { 
        boton8.textContent = "keyup";
        boton8.style.backgroundColor = "purple";
        boton8.style.color = "black";
    }
});
boton8.textContent = "boton8";
boton8.style.color = "white";
boton8.style.width = "120px";
boton8.style.height = "40px";
boton8.style.backgroundColor = "black";
boton8.style.position = "fixed";
boton8.style.top = "80%";
boton8.style.left = "20%";
document.body.appendChild(boton8);

///////////////////////////////////////////////////////////////////////////

var boton9 = document.createElement("button");
boton9.addEventListener("keypress", function() {
    boton9.textContent = "keypress";
    boton9.style.backgroundColor = "aqua";
    boton9.style.color = "black";
});
boton9.textContent = "boton9";
boton9.style.color = "white";
boton9.style.width = "120px";
boton9.style.height = "40px";
boton9.style.backgroundColor = "black";
boton9.style.position = "fixed";
boton9.style.top = "80%";
boton9.style.left = "30%";
document.body.appendChild(boton9);

///////////////////////////////////////////////////////////////////////////