function calculadora(num1, num2){

    while (true) {
    var pregunta1 = prompt("Que operacion desea hacer?")
    var num1 = parseInt(prompt("Ingrese un numero"))
    var num2 = parseInt(prompt("Ingrese otro numero"))
    switch (pregunta1) {
        case 'suma':
            resultado =  num1 + num2
            alert("El resultado es: " + resultado)
            break;
        case 'resta':
            resultado = num1 - num2
            alert("El resultado es: " + resultado)
            break;
        case 'mult':
            resultado = num1 * num2
            alert("El resultado es: " + resultado)
            break;
        case 'div':
            resultado = num1 / num2
            alert("El resultado es: " + resultado)
            break;
        case 'modulo':
            resultado = num1 % num2
            alert("El resultado es: " + resultado)
            break;
        case 'potencia':
            resultado = Math.pow(num1, num2);
            alert("El resultado es: " + resultado);
            break;
        case 'raiz':
            resultado = Math.pow(num1, 1 / num2);
            alert("El resultado es: " + resultado);
            break;
        default:
            break;
    }    
    }
    
}

calculadora()