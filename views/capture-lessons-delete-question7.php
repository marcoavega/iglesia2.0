<?php
$qc_controller = new QuestionsController1();

if ($_POST['r'] == 'capture-lessons-delete-question7' && $_SESSION['role'] == 'admin' && !isset($_POST['crud'])) {

	$question7 = $qc_controller->get7($_POST['question7']);

	if (empty($question7)) {
		$template = '
			<div class="container">
				<p class="item  error">No existen preguntas <b>%s</b></p>
			</div>
			<script>
				window.onload = function (){
					reloadPage("capture-lessons")
				}
			</script>
		';

		printf($template, $_POST['question7']);
	} else {
		$template_question7 = '
			<h2 class="">Eliminar pregunta</h2>
			<form method="POST" class="">
				<div class="">
					¿Estas seguro de eliminar pregunta: 
					<mark class="">%s</mark>?
				</div>
				<div class="">
					<input  class="" type="submit" value="SI">
					<input class="" type="button" value="NO" onclick="history.back()">
					<input type="hidden" name="question7" value="%s">
					<input type="hidden" name="r" value="capture-lessons-delete-question7">
					<input type="hidden" name="crud" value="del">
				</div>
			</form>
		';

		printf(
			$template_question7,
			$question7[0]['question7'],
			$question7[0]['question7']
		);
	}
} else if ($_POST['r'] == 'capture-lessons-delete-question7' && $_SESSION['role'] == 'admin' && $_POST['crud'] == 'del') {

	$question7 = $qc_controller->del7($_POST['question7']);

	$template = '
		<div class="container">
			<p class="item  delete">Pregunta <b>%s</b> eliminada</p>
		</div>
		<script>
			window.onload = function () {
				reloadPage("capture-lessons")
			}
		</script>
	';

	printf($template, $_POST['question7']);
} else {
	$controller = new ViewController();
	$controller->load_view('error401');
}