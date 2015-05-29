function calcula_imc(){
var altura = document.imcForm.altura.value;
var peso = document.imcForm.peso.value;


var quadrado = peso/(altura * altura);
var calculo = quadrado.toFixed(2);

if(calculo<18.5){
alert("Você está abaixo do peso com esse indice: " + calculo);
}
else if(calculo>=18.5 && calculo<24.9){
alert("Você está no peso ideal com esse indice: " + calculo);
}

else if(calculo>=25 && calculo<29.9) {
alert("Você está com sobre peso com esse indice: " + calculo);
}
else if(calculo>=30 && calculo<39.9) {
alert("Você está com obesidade com esse indice: " + calculo);
}
else if (calculo>40)
alert("Você estácom obesidade grave com esse indice: " + calculo);
}


