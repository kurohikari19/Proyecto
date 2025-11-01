console.log("Hola")
console.error("Error")
console.warn("Advertencia")

function nomfuncion(){
    var n = 5//global
    console.log(n)
    if(true){
        var n = 7
        console.log(n)
    }
    console.log(n)
}

nomfuncion()

function nombre(){
    let nombre = 'Rosa'
    console.log("Mi nombre es: ", nombre)
    if (true) {
        let nombre = 'Ari'//local (solo funciona dentro del "Bloque")
        console.log("Mi nombre es: ", nombre)        
    }
    console.log(nombre, ":O")
}

nombre()

var edad = 30
console.log(typeof edad)

var genero = true
console.log(typeof genero)

var costo = 0.1587
console.log(typeof costo)

var nombre1 = prompt("Cual es tu nombre?")
alert("Hola", nombre)
confirm("Deseas salir?")

function suma(num1, num2){
    var pregunta1 = prompt("Que operacion desea hacer?")
    var pregunta2 = parseInt(prompt("Ingrese un numero"))
    
}