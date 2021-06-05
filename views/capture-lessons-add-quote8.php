<?php
if ($_POST['r'] == 'capture-lessons-add-quote8' && $_SESSION['role'] == 'admin' && !isset($_POST['crud'])) {

	$name_lessons_controller = new LessonsTitlesController();
	$name_lesson = $name_lessons_controller->get();
	$name_lesson_select = '';
	for ($n = 0; $n < count($name_lesson); $n++) {
		$name_lesson_select .= '<option value="' . $name_lesson[$n]['id_lesson_title'] . '">' . $name_lesson[$n]['name_lesson'] . '</option>';
	}

	$number_question_controller = new NumberQuestionsController();
	$number_question = $number_question_controller->get();
	$number_question_select = '';
	for ($n = 0; $n < count($number_question); $n++) {
		$number_question_select .= '<option value="' . $number_question[$n]['id_number_question'] . '">' . $number_question[$n]['number_question'] . '</option>';
	}

	printf('
		<h2 class="">Agregar cita bíblica 8</h2>
		<form method="POST" class="">
			<div class="">
				<input type="hidden" name="id_title_bible_quote8" value="0">
			</div>
			<div class="">
				<input type="text" name="title_bible_quote8" placeholder="cita bíblica" required>
			</div>
			<div class="">
				<select name="name_lesson" placeholder="Nombre de lección" required>
					<option value="">name_lesson</option>
					%s
				</select>
			</div>
            <div class="">
				<select name="number_question" placeholder="Número de lección" required>
					<option value="">number_question</option>
					%s
				</select>
			</div>
			<div class="">
				<input  class="button  add" type="submit" value="Agregar">
				<input type="hidden" name="r" value="capture-lessons-add-quote8">
				<input type="hidden" name="crud" value="set">
			</div>
		</form>
	', $name_lesson_select, $number_question_select);
} else if ($_POST['r'] == 'capture-lessons-add-quote8' && $_SESSION['role'] == 'admin' && $_POST['crud'] == 'set') {
	$tbc_controller = new  TitlesBiblesQuotesController();

	$newtvc = array(
		'id_title_bible_quote8' =>  $_POST['id_title_bible_quote8'],
		'title_bible_quote8' =>  $_POST['title_bible_quote8'],
		'name_lesson' =>  $_POST['name_lesson'],
		'number_question' =>  $_POST['number_question'],
	);

	$tbc = $tbc_controller->set8($newtvc);

	$template = '
		<div class="container">
			<p class="item  add">cita bíblica <b>%s</b> salvada</p>
		</div>
		<script>
			window.onload = function () {
				reloadPage("capture-lessons")
			}
		</script>
	';

	printf(
		$template,
		$_POST['title_bible_quote8'],
	);
} else {
	$controller = new ViewController();
	$controller->load_view('error401');
}