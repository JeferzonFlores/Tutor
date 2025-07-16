function calificar() {
    var form = document.getElementById('quizForm');
    var questions = {!!json_encode($questions) !! };
    var respuestasCorrectas = 0;

    questions.forEach((question, index) => {
        var respuestaSeleccionada = form.elements['q' + (index + 1)].value;
        if (respuestaSeleccionada === question.answer) {
            respuestasCorrectas++;
        }
    });

    var resultadoHTML = "<h2>Resultado:</h2>";
    resultadoHTML += "<p>Respuestas correctas: " + respuestasCorrectas + "</p>";
    resultadoHTML += "<p>Respuestas incorrectas: " + (questions.length - respuestasCorrectas) + "</p>";

    document.getElementById("resultado").innerHTML = resultadoHTML;
}