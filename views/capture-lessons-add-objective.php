<?php
if ($_POST['r'] == 'capture-lessons-add-objective' && $_SESSION['role'] == 'admin' && !isset($_POST['crud'])) {

	$name_lessons_controller = new LessonsTitlesController();
	$name_lesson = $name_lessons_controller->get();
	$name_lesson_select = '';
	for ($n = 0; $n < count($name_lesson); $n++) {
		$name_lesson_select .= '<option value="' . $name_lesson[$n]['id_lesson_title'] . '">' . $name_lesson[$n]['name_lesson'] . '</option>';
	}

	printf('
	<div class="row container">
	<input class="btn btn-outline-dark col-sm-12 col-md-4 hymn particle button-return2" type="button" value="Regresar" onclick="history.back()">
</div>

<div class="container-fluid list div-himnos"><h2 class="p1">Agregar objetivo</h2></div>
<div class="container">

		<form method="POST" class="">
			<div class="">
				<input type="hidden" name="id_objective" value="0">
			</div>
			<div class="form-group">
			<textarea class="form-control" id="exampleFormControlTextarea1" rows="10" placeholder="Objetivo" name="objective"></textarea>
		  </div>
			<div class="">
				<select class="custom-select" name="name_lesson" placeholder="Nombre de lección" required>
					<option value="">Nombre de lección</option>
					%s
				</select>
			</div>
			<div class="">
				<input class="btn btn-outline-dark col-sm-12 col-md-3 hymn particle marginq" type="submit" value="Agregar">
				<input type="hidden" name="r" value="capture-lessons-add-objective">
				<input type="hidden" name="crud" value="set">
			</div>
		</form>

		</div>
		</div>
	', $name_lesson_select);
} else if ($_POST['r'] == 'capture-lessons-add-objective' && $_SESSION['role'] == 'admin' && $_POST['crud'] == 'set') {
	$ojt_controller = new ObjectivesController();

	$newojt = array(
		'id_objective' =>  $_POST['id_objective'],
		'objective' =>  $_POST['objective'],
		'name_lesson' =>  $_POST['name_lesson']
	);

	$ojt = $ojt_controller->set($newojt);

	$template = '
		<div class="container">
			<p class="item  add">Objetivo <b>%s</b> salvado</p>
		</div>
		<script>
			window.onload = function () {
				reloadPage("capture-lessons")
			}
		</script>
	';

	printf(
		$template,
		$_POST['objective'],
	);
} else {
	$controller = new ViewController();
	$controller->load_view('error401');
}
