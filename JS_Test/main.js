//acces au dom

//Selectionner un element par son ID
let elementByid1 = document.getElementById('section2');

//Selectionner un element par sa classe

let elementByClass1 = document.getElementsByClassName('section1');

//Selectionner un element a partir de son tag html (balise)

let elementByTag1 = document.getElementsByTagName('h1');

//Manipuler du contenu en JavaScript

elementByid1.textContent = "Nouveau Text";
elementByid1.innerHTML = '<strong>Hello</strong>';

//Ajouter un écouter d'événement
elementByid1.addEventListener('click', function(){
    alert("Clique sur l'élément");
});

//Modification du style css d'un element
elementByid1.style.color  = 'red';


function calculate() {
    var valueA = parseFloat(document.getElementById('inputA').value);
    var operator = document.getElementById('inputOpe').value;
    var valueB = parseFloat(document.getElementById('inputB').value);

    if (isNaN(valueA) || isNaN(valueB)) {
        document.getElementById('section3').innerText = "Veuillez saisir des nombres valides.";
        return;
    }

    var result;
    switch (operator) {
        case '+':
            result = valueA + valueB;
            break;
        case '-':
            result = valueA - valueB;
            break;
        case '*':
            result = valueA * valueB;
            break;
        case '/':
            if (valueB === 0) {
                result = "Division par zéro impossible.";
            } else {
                result = valueA / valueB;
            }
            break;
        default:
            result = "Opérateur invalide.";
    }

    document.getElementById('section3').innerText = "Résultat : " + result;
}