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





function calcularIMC() {
   
var pesos = document.getElementById(peso);
alert(pesos);
   
var peso = document.formimc.peso.value;
alert(peso);
var alt = document.formim.altaura.value;
var alt2 = alt / 100;
var IMC = peso / (alt2 * alt2);


document.formimc.massacor.value= custRound(IMC, 1);
if (document.formimc.massacor.value <18.5);
document.formimc.comment.value = "Você está abaixo do peso";
if (document.formimc.massacor.value >=18.5 && document.form.massacor.value <=24.9)
document.formimc.comment.value = "Você está no peso ideal";
if (document.formimc.massacor.value >=25 && document.form.massacor.value <=29.9)
document.formimc.comment.value = "Você está acima do peso";
if (document.formimc.massacor.value >=30 && document.form.massacor.value <=34.9)
document.formimc.comment.value = "Obesidade Tipo I";
if (document.formimc.massacor.value >=35 && document.form.massacor.value <=39.9)
document.formimc.comment.value = "Obesidade Tipo I";
if (document.formimc.massacor.value >=40 && document.form.massacor.value <=49.9)
document.formimc.comment.value = "Obesidade Mórbida";
if (document.formimc.massacor.value >50)
document.formimc.comment.value = "Obesidade Extrema";
}

function custRound(x, places) {
return (Math.round(x * Math.pow(10,places)))/Math.pow(10,places)
}

