<?php
$dates_controller = new DatesController();

if ($_POST['r'] == 'capture-lessons-delete-date' && $_SESSION['role'] == 'admin' && !isset($_POST['crud'])) {

	$date = $dates_controller->get($_POST['date']);

	if (empty($date)) {
		$template = '
			<div class="container">
				<p class="item  error">No existe la fecha <b>%s</b></p>
			</div>
			<script>
				window.onload = function (){
					reloadPage("capture-lessons")
				}
			</script>
		';

		printf($template, $_POST['date']);
	} else {
		$template_date = '
			<h2 class="">Eliminar fecha</h2>
			<form method="POST" class="">
				<div class="">
					¿Estas seguro de eliminar la fecha: 
					<mark class="">%s</mark>?
				</div>
				<div class="">
					<input  class="" type="submit" value="SI">
					<input class="" type="button" value="NO" onclick="history.back()">
					<input type="hidden" name="date" value="%s">
					<input type="hidden" name="r" value="capture-lessons-delete-date">
					<input type="hidden" name="crud" value="del">
				</div>
			</form>
		';

		printf(
			$template_date,
			$date[0]['date'],
			$date[0]['date']
		);
	}
} else if ($_POST['r'] == 'capture-lessons-delete-date' && $_SESSION['role'] == 'admin' && $_POST['crud'] == 'del') {

	$date = $dates_controller->del($_POST['date']);

	$template = '
		<div class="container">
			<p class="item  delete">Fecha <b>%s</b> eliminado</p>
		</div>
		<script>
			window.onload = function () {
				reloadPage("capture-lessons")
			}
		</script>
	';

	printf($template, $_POST['date']);
} else {
	$controller = new ViewController();
	$controller->load_view('error401');
}
