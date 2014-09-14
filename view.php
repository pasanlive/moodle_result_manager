<?php
/**
 * Prints a particular instance of pasanliveResultManager
 *
 * author : Pasan Buddhika Weerathunga
 * email : me@pasanlive.com
 *
 * @package    mod_pasanliveResultManager
 */
require_once (dirname ( dirname ( dirname ( __FILE__ ) ) ) . '/config.php');
require_once (dirname ( __FILE__ ) . '/lib.php');

$id = optional_param ( 'id', 0, PARAM_INT ); // course_module ID, or
$n = optional_param ( 'n', 0, PARAM_INT ); // pasanliveResultManager instance ID - it should be named as the first character of the module

if ($id) {
	$cm = get_coursemodule_from_id ( 'pasanliveResultManager', $id, 0, false, MUST_EXIST );
	$course = $DB->get_record ( 'course', array (
			'id' => $cm->course 
	), '*', MUST_EXIST );
	$pasanliveResultManager = $DB->get_record ( 'pasanliveResultManager', array (
			'id' => $cm->instance 
	), '*', MUST_EXIST );
} elseif ($n) {
	$pasanliveResultManager = $DB->get_record ( 'pasanliveResultManager', array (
			'id' => $n 
	), '*', MUST_EXIST );
	$course = $DB->get_record ( 'course', array (
			'id' => $pasanliveResultManager->course 
	), '*', MUST_EXIST );
	$cm = get_coursemodule_from_instance ( 'pasanliveResultManager', $pasanliveResultManager->id, $course->id, false, MUST_EXIST );
} else {
	print_error ( 'You must specify a course_module ID or an instance ID' );
}

require_login ( $course, true, $cm );
$context = context_module::instance ( $cm->id );

add_to_log ( $course->id, 'pasanliveResultManager', 'view', "view.php?id={$cm->id}", $pasanliveResultManager->name, $cm->id );

// / Print the page header

$PAGE->set_url ( '/mod/pasanliveResultManager/view.php', array (
		'id' => $cm->id 
) );
$PAGE->set_title ( format_string ( $pasanliveResultManager->name ) );
$PAGE->set_heading ( format_string ( $course->fullname ) );
$PAGE->set_context ( $context );

// other things you may want to set - remove if not needed
// $PAGE->set_cacheable(false);
// $PAGE->set_focuscontrol('some-html-id');
// $PAGE->add_body_class('pasanliveResultManager-'.$somevar);

// Output starts here
echo $OUTPUT->header ();

require_once ('result_publication_form.php');

$mform = new course_slection_form();

$mform->display();
// Finish the page

echo $OUTPUT->footer ();
