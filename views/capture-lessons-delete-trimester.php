<?php
$trimesters_controller = new TrimestersController();

if ($_POST['r'] == 'capture-lessons-delete-trimester' && $_SESSION['role'] == 'admin' && !isset($_POST['crud'])) {

	$trimester = $trimesters_controller->get($_POST['trimester_title']);

	if (empty($trimester)) {
		$template = '
			<div class="container">
				<p class="item  error">No existe el trimestre <b>%s</b></p>
			</div>
			<script>
				window.onload = function (){
					reloadPage("capture-lessons")
				}
			</script>
		';

		printf($template, $_POST['trimester']);
	} else {
		$template_trimester = '
			<h2 class="">Eliminar trimestre</h2>
			<form method="POST" class="">
				<div class="">
					¿Estas seguro de eliminar el trimestre: 
					<mark class="">%s</mark>?
				</div>
				<div class="">
					<input  class="" type="submit" value="SI">
					<input class="" type="button" value="NO" onclick="history.back()">
					<input type="hidden" name="trimester_title" value="%s">
					<input type="hidden" name="r" value="capture-lessons-delete-trimester">
					<input type="hidden" name="crud" value="del">
				</div>
			</form>
		';

		printf(
			$template_trimester,
			$trimester[0]['trimester_title'],
			$trimester[0]['trimester_title']
		);
	}
} else if ($_POST['r'] == 'capture-lessons-delete-trimester' && $_SESSION['role'] == 'admin' && $_POST['crud'] == 'del') {

	$trimester = $trimesters_controller->del($_POST['trimester_title']);

	$template = '
		<div class="container">
			<p class="item  delete">Trimestre <b>%s</b> eliminado</p>
		</div>
		<script>
			window.onload = function () {
				reloadPage("capture-lessons")
			}
		</script>
	';

	printf($template, $_POST['trimester_title']);
} else {
	$controller = new ViewController();
	$controller->load_view('error401');
}