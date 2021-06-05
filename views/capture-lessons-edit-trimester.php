<?php
$tm_controller = new TrimestersController();

if ($_POST['r'] == 'capture-lessons-edit-trimester' && $_SESSION['role'] == 'admin' && !isset($_POST['crud'])) {

	$tm = $tm_controller->get($_POST['trimester_title']);

	if (empty($tm)) {
		$template = '
			<div class="">
				<p class="">No existe el trimester <b>%s</b></p>
			</div>
			<script>
				window.onload = function (){
					reloadPage("capture-lessons")
				}
			</script>
		';

		printf($template, $_POST['trimester_title']);
	} else {

		$year_controller = new YearsController();
		$year = $year_controller->get();
		$year_select = '';
		for ($a = 0; $a < count($year); $a++) {
			$selected = ($tm[0]['year'] == $year[$a]['year']) ? 'selected' : '';
			$year_select .= '<option value="' . $year[$a]['id_year'] . '"' . $selected . '>' . $year[$a]['year'] . '</option>';
		}

		$template_tm = '
			<h2 class="">Editar trimester</h2>
			<form method="POST" class="">
				<div class="">
					<input type="text" placeholder="id_trimester" value="%s" disabled required>
					<input type="hidden" name="id_trimester" value="%s">
				</div>
				<div class="">
					<input type="text" name="trimester_number" placeholder="Número de trimestre" value="%s" required>
				</div>
				<div class="">
					<input type="text" name="trimester_title" placeholder="Título de trimestre" value="%s" required>
				</div>
				<div class="">
					<select name="year" placeholder="year" required>
						<option value="">year</option>
						%s
					</select>
				</div>
				<div class="p_25">
					<input  class="button  edit" type="submit" value="Editar">
					<input type="hidden" name="r" value="capture-lessons-edit-trimester">
					<input type="hidden" name="crud" value="set">
				</div>
			</form>
		';

		printf(
			$template_tm,
			$tm[0]['id_trimester'],
			$tm[0]['id_trimester'],
			$tm[0]['trimester_number'],
			$tm[0]['trimester_title'],
			$year_select,
		);
	}
} else if ($_POST['r'] == 'capture-lessons-edit-trimester' && $_SESSION['role'] == 'admin' && $_POST['crud'] == 'set') {

	$save_tm = array(
		'id_trimester' =>  $_POST['id_trimester'],
		'trimester_number' =>  $_POST['trimester_number'],
		'trimester_title' =>  $_POST['trimester_title'],
		'year' =>  $_POST['year'],
	);

	$tm = $tm_controller->set($save_tm);

	$template = '
		<div class="container">
			<p class="item  edit">Trimestre <b>%s</b> salvado</p>
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