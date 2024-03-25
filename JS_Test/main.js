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
    var inputA = parseFloat(document.getElementById('inputA').value);
    var inputB = parseFloat(document.getElementById('inputB').value);
    
    if (!isNaN(inputA) && !isNaN(inputB)) {
      var result = inputA + inputB;
      document.getElementById('section3').innerText = 'Le résultat de l\'addition est : ' + result;
      alert(result);
    } else {
      document.getElementById('section3').innerText = 'Veuillez entrer des nombres valides.';
    }
  }


let elementByClass2 = document.getElementsByClassName('section3')

