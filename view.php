<?php
/**
 * Prints a particular instance of pasanliveresultmanager
 *
 * author : Pasan Buddhika Weerathunga
 * email : me@pasanlive.com
 *
 * @package    mod_pasanliveresultmanager
 */
require_once (dirname ( dirname ( dirname ( __FILE__ ) ) ) . '/config.php');
require_once (dirname ( __FILE__ ) . '/lib.php');

$id = optional_param ( 'id', 0, PARAM_INT ); // course_module ID, or
$n = optional_param ( 'n', 0, PARAM_INT ); // pasanliveresultmanager instance ID - it should be named as the first character of the module

if ($id) {
	$cm = get_coursemodule_from_id ( 'pasanliveresultmanager', $id, 0, false, MUST_EXIST );
	$course = $DB->get_record ( 'course', array (
			'id' => $cm->course 
	), '*', MUST_EXIST );
	$pasanliveresultmanager = $DB->get_record ( 'pasanliveresultmanager', array (
			'id' => $cm->instance 
	), '*', MUST_EXIST );
} elseif ($n) {
	$pasanliveresultmanager = $DB->get_record ( 'pasanliveresultmanager', array (
			'id' => $n 
	), '*', MUST_EXIST );
	$course = $DB->get_record ( 'course', array (
			'id' => $pasanliveresultmanager->course 
	), '*', MUST_EXIST );
	$cm = get_coursemodule_from_instance ( 'pasanliveresultmanager', $pasanliveresultmanager->id, $course->id, false, MUST_EXIST );
} else {
	print_error ( 'You must specify a course_module ID or an instance ID' );
}

require_login ( $course, true, $cm );
$context = context_module::instance ( $cm->id );

add_to_log ( $course->id, 'pasanliveresultmanager', 'view', "view.php?id={$cm->id}", $pasanliveresultmanager->name, $cm->id );

// / Print the page header

$PAGE->set_url ( '/mod/pasanliveresultmanager/view.php', array (
		'id' => $cm->id 
) );
$PAGE->set_title ( format_string ( $pasanliveresultmanager->name ) );
$PAGE->set_heading ( format_string ( $course->fullname ) );
$PAGE->set_context ( $context );

// other things you may want to set - remove if not needed
// $PAGE->set_cacheable(false);
// $PAGE->set_focuscontrol('some-html-id');
// $PAGE->add_body_class('pasanliveresultmanager-'.$somevar);

// Output starts here
echo $OUTPUT->header ();

require_once ('result_publication_form.php');

$mform = new course_slection_form();

$mform->display();
// Finish the page

echo $OUTPUT->footer ();
