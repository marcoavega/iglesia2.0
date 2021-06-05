<?php
$dt_controller = new DatesController();

if ($_POST['r'] == 'capture-lessons-edit-date' && $_SESSION['role'] == 'admin' && !isset($_POST['crud'])) {

	$dt = $dt_controller->get($_POST['date']);

	if (empty($dt)) {
		$template = '
			<div class="">
				<p class="">No existe la fecha <b>%s</b></p>
			</div>
			<script>
				window.onload = function (){
					reloadPage("capture-lessons")
				}
			</script>
		';

		printf($template, $_POST['date']);
	} else {

		$year_controller = new YearsController();
		$year = $year_controller->get();
		$year_select = '';
		for ($a = 0; $a < count($year); $a++) {
			$selected = ($dt[0]['year'] == $year[$a]['year']) ? 'selected' : '';
			$year_select .= '<option value="' . $year[$a]['id_year'] . '"' . $selected . '>' . $year[$a]['year'] . '</option>';
		}

		$template_dt = '
			<h2 class="">Editar fecha</h2>
			<form method="POST" class="">
				<div class="">
					<input type="text" placeholder="id_date" value="%s" disabled required>
					<input type="hidden" name="id_date" value="%s">
				</div>
				<div class="">
					<input type="date" name="date" placeholder="Fecha" value="%s" required>
				</div>
				<div class="">
					<select name="year" placeholder="year" required>
						<option value="">year</option>
						%s
					</select>
				</div>
				<div class="p_25">
					<input  class="button  edit" type="submit" value="Editar">
					<input type="hidden" name="r" value="capture-lessons-edit-date">
					<input type="hidden" name="crud" value="set">
				</div>
			</form>
		';

		printf(
			$template_dt,
			$dt[0]['id_date'],
			$dt[0]['id_date'],
			$dt[0]['date'],
			$year_select,
		);
	}
} else if ($_POST['r'] == 'capture-lessons-edit-date' && $_SESSION['role'] == 'admin' && $_POST['crud'] == 'set') {

	$save_dt = array(
		'id_date' =>  $_POST['id_date'],
		'date_number' =>  $_POST['date'],
		'year' =>  $_POST['year'],
	);

	$dt = $dt_controller->set($save_dt);

	$template = '
		<div class="container">
			<p class="item  edit">Fecha <b>%s</b> salvada</p>
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