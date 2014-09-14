<?php

/**
 * This is a one-line short description of the file
 *
 * author : Pasan Buddhika Weerathunga
 * email : me@pasanlive.com
 *
 * @package    mod_pasanlive_result_manager
 */

/// Replace pasanlive_result_manager with the name of your module and remove this line

require_once(dirname(dirname(dirname(__FILE__))).'/config.php');
require_once(dirname(__FILE__).'/lib.php');

$id = required_param('id', PARAM_INT);   // course

$course = $DB->get_record('course', array('id' => $id), '*', MUST_EXIST);

require_course_login($course);

add_to_log($course->id, 'pasanlive_result_manager', 'view all', 'index.php?id='.$course->id, '');

$coursecontext = context_course::instance($course->id);

$PAGE->set_url('/mod/pasanlive_result_manager/index.php', array('id' => $id));
$PAGE->set_title(format_string($course->fullname));
$PAGE->set_heading(format_string($course->fullname));
$PAGE->set_context($coursecontext);

echo $OUTPUT->header();

if (! $pasanlive_result_managers = get_all_instances_in_course('pasanlive_result_manager', $course)) {
    notice(get_string('nopasanlive_result_managers', 'pasanlive_result_manager'), new moodle_url('/course/view.php', array('id' => $course->id)));
}

$table = new html_table();
if ($course->format == 'weeks') {
    $table->head  = array(get_string('week'), get_string('name'));
    $table->align = array('center', 'left');
} else if ($course->format == 'topics') {
    $table->head  = array(get_string('topic'), get_string('name'));
    $table->align = array('center', 'left', 'left', 'left');
} else {
    $table->head  = array(get_string('name'));
    $table->align = array('left', 'left', 'left');
}

foreach ($pasanlive_result_managers as $pasanlive_result_manager) {
    if (!$pasanlive_result_manager->visible) {
        $link = html_writer::link(
            new moodle_url('/mod/pasanlive_result_manager.php', array('id' => $pasanlive_result_manager->coursemodule)),
            format_string($pasanlive_result_manager->name, true),
            array('class' => 'dimmed'));
    } else {
        $link = html_writer::link(
            new moodle_url('/mod/pasanlive_result_manager.php', array('id' => $pasanlive_result_manager->coursemodule)),
            format_string($pasanlive_result_manager->name, true));
    }

    if ($course->format == 'weeks' or $course->format == 'topics') {
        $table->data[] = array($pasanlive_result_manager->section, $link);
    } else {
        $table->data[] = array($link);
    }
}

echo $OUTPUT->heading(get_string('modulenameplural', 'pasanlive_result_manager'), 2);
echo html_writer::table($table);
echo $OUTPUT->footer();
