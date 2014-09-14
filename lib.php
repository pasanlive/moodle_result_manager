<?php

/**
 * Library of interface functions and constants for module pasanlive_result_manager
 *
 * All the core Moodle functions, neeeded to allow the module to work
 * integrated in Moodle should be placed here.
 * All the pasanlive_result_manager specific functions, needed to implement all the module
 * logic, should go to locallib.php. This will help to save some memory when
 * Moodle is performing actions across all modules.
 *
 * author : Pasan Buddhika Weerathunga
 * email : me@pasanlive.com
 * 
 * @package    mod_pasanlive_result_manager
 */

defined('MOODLE_INTERNAL') || die();

/** example constant */
//define('NEWMODULE_ULTIMATE_ANSWER', 42);

////////////////////////////////////////////////////////////////////////////////
// Moodle core API                                                            //
////////////////////////////////////////////////////////////////////////////////

/**
 * Returns the information on whether the module supports a feature
 *
 * @see plugin_supports() in lib/moodlelib.php
 * @param string $feature FEATURE_xx constant for requested feature
 * @return mixed true if the feature is supported, null if unknown
 */
function pasanlive_result_manager_supports($feature) {
    switch($feature) {
        case FEATURE_MOD_INTRO:         return true;
        case FEATURE_SHOW_DESCRIPTION:  return true;

        default:                        return null;
    }
}

/**
 * Saves a new instance of the pasanlive_result_manager into the database
 *
 * Given an object containing all the necessary data,
 * (defined by the form in mod_form.php) this function
 * will create a new instance and return the id number
 * of the new instance.
 *
 * @param object $pasanlive_result_manager An object from the form in mod_form.php
 * @param mod_pasanlive_result_manager_mod_form $mform
 * @return int The id of the newly inserted pasanlive_result_manager record
 */
function pasanlive_result_manager_add_instance(stdClass $pasanlive_result_manager, mod_pasanlive_result_manager_mod_form $mform = null) {
    global $DB;

    $pasanlive_result_manager->timecreated = time();

    # You may have to add extra stuff in here #

    return $DB->insert_record('pasanlive_result_manager', $pasanlive_result_manager);
}

/**
 * Updates an instance of the pasanlive_result_manager in the database
 *
 * Given an object containing all the necessary data,
 * (defined by the form in mod_form.php) this function
 * will update an existing instance with new data.
 *
 * @param object $pasanlive_result_manager An object from the form in mod_form.php
 * @param mod_pasanlive_result_manager_mod_form $mform
 * @return boolean Success/Fail
 */
function pasanlive_result_manager_update_instance(stdClass $pasanlive_result_manager, mod_pasanlive_result_manager_mod_form $mform = null) {
    global $DB;

    $pasanlive_result_manager->timemodified = time();
    $pasanlive_result_manager->id = $pasanlive_result_manager->instance;

    # You may have to add extra stuff in here #

    return $DB->update_record('pasanlive_result_manager', $pasanlive_result_manager);
}

/**
 * Removes an instance of the pasanlive_result_manager from the database
 *
 * Given an ID of an instance of this module,
 * this function will permanently delete the instance
 * and any data that depends on it.
 *
 * @param int $id Id of the module instance
 * @return boolean Success/Failure
 */
function pasanlive_result_manager_delete_instance($id) {
    global $DB;

    if (! $pasanlive_result_manager = $DB->get_record('pasanlive_result_manager', array('id' => $id))) {
        return false;
    }

    # Delete any dependent records here #

    $DB->delete_records('pasanlive_result_manager', array('id' => $pasanlive_result_manager->id));

    return true;
}

/**
 * Returns a small object with summary information about what a
 * user has done with a given particular instance of this module
 * Used for user activity reports.
 * $return->time = the time they did it
 * $return->info = a short text description
 *
 * @return stdClass|null
 */
function pasanlive_result_manager_user_outline($course, $user, $mod, $pasanlive_result_manager) {

    $return = new stdClass();
    $return->time = 0;
    $return->info = '';
    return $return;
}

/**
 * Prints a detailed representation of what a user has done with
 * a given particular instance of this module, for user activity reports.
 *
 * @param stdClass $course the current course record
 * @param stdClass $user the record of the user we are generating report for
 * @param cm_info $mod course module info
 * @param stdClass $pasanlive_result_manager the module instance record
 * @return void, is supposed to echp directly
 */
function pasanlive_result_manager_user_complete($course, $user, $mod, $pasanlive_result_manager) {
}

/**
 * Given a course and a time, this module should find recent activity
 * that has occurred in pasanlive_result_manager activities and print it out.
 * Return true if there was output, or false is there was none.
 *
 * @return boolean
 */
function pasanlive_result_manager_print_recent_activity($course, $viewfullnames, $timestart) {
    return false;  //  True if anything was printed, otherwise false
}

/**
 * Prepares the recent activity data
 *
 * This callback function is supposed to populate the passed array with
 * custom activity records. These records are then rendered into HTML via
 * {@link pasanlive_result_manager_print_recent_mod_activity()}.
 *
 * @param array $activities sequentially indexed array of objects with the 'cmid' property
 * @param int $index the index in the $activities to use for the next record
 * @param int $timestart append activity since this time
 * @param int $courseid the id of the course we produce the report for
 * @param int $cmid course module id
 * @param int $userid check for a particular user's activity only, defaults to 0 (all users)
 * @param int $groupid check for a particular group's activity only, defaults to 0 (all groups)
 * @return void adds items into $activities and increases $index
 */
function pasanlive_result_manager_get_recent_mod_activity(&$activities, &$index, $timestart, $courseid, $cmid, $userid=0, $groupid=0) {
}

/**
 * Prints single activity item prepared by {@see pasanlive_result_manager_get_recent_mod_activity()}

 * @return void
 */
function pasanlive_result_manager_print_recent_mod_activity($activity, $courseid, $detail, $modnames, $viewfullnames) {
}

/**
 * Function to be run periodically according to the moodle cron
 * This function searches for things that need to be done, such
 * as sending out mail, toggling flags etc ...
 *
 * @return boolean
 * @todo Finish documenting this function
 **/
function pasanlive_result_manager_cron () {
    return true;
}

/**
 * Returns all other caps used in the module
 *
 * @example return array('moodle/site:accessallgroups');
 * @return array
 */
function pasanlive_result_manager_get_extra_capabilities() {
    return array();
}

////////////////////////////////////////////////////////////////////////////////
// Gradebook API                                                              //
////////////////////////////////////////////////////////////////////////////////

/**
 * Is a given scale used by the instance of pasanlive_result_manager?
 *
 * This function returns if a scale is being used by one pasanlive_result_manager
 * if it has support for grading and scales. Commented code should be
 * modified if necessary. See forum, glossary or journal modules
 * as reference.
 *
 * @param int $pasanlive_result_managerid ID of an instance of this module
 * @return bool true if the scale is used by the given pasanlive_result_manager instance
 */
function pasanlive_result_manager_scale_used($pasanlive_result_managerid, $scaleid) {
    global $DB;

    /** @example */
    if ($scaleid and $DB->record_exists('pasanlive_result_manager', array('id' => $pasanlive_result_managerid, 'grade' => -$scaleid))) {
        return true;
    } else {
        return false;
    }
}

/**
 * Checks if scale is being used by any instance of pasanlive_result_manager.
 *
 * This is used to find out if scale used anywhere.
 *
 * @param $scaleid int
 * @return boolean true if the scale is used by any pasanlive_result_manager instance
 */
function pasanlive_result_manager_scale_used_anywhere($scaleid) {
    global $DB;

    /** @example */
    if ($scaleid and $DB->record_exists('pasanlive_result_manager', array('grade' => -$scaleid))) {
        return true;
    } else {
        return false;
    }
}

/**
 * Creates or updates grade item for the give pasanlive_result_manager instance
 *
 * Needed by grade_update_mod_grades() in lib/gradelib.php
 *
 * @param stdClass $pasanlive_result_manager instance object with extra cmidnumber and modname property
 * @param mixed optional array/object of grade(s); 'reset' means reset grades in gradebook
 * @return void
 */
function pasanlive_result_manager_grade_item_update(stdClass $pasanlive_result_manager, $grades=null) {
    global $CFG;
    require_once($CFG->libdir.'/gradelib.php');

    /** @example */
    $item = array();
    $item['itemname'] = clean_param($pasanlive_result_manager->name, PARAM_NOTAGS);
    $item['gradetype'] = GRADE_TYPE_VALUE;
    $item['grademax']  = $pasanlive_result_manager->grade;
    $item['grademin']  = 0;

    grade_update('mod/pasanlive_result_manager', $pasanlive_result_manager->course, 'mod', 'pasanlive_result_manager', $pasanlive_result_manager->id, 0, null, $item);
}

/**
 * Update pasanlive_result_manager grades in the gradebook
 *
 * Needed by grade_update_mod_grades() in lib/gradelib.php
 *
 * @param stdClass $pasanlive_result_manager instance object with extra cmidnumber and modname property
 * @param int $userid update grade of specific user only, 0 means all participants
 * @return void
 */
function pasanlive_result_manager_update_grades(stdClass $pasanlive_result_manager, $userid = 0) {
    global $CFG, $DB;
    require_once($CFG->libdir.'/gradelib.php');

    /** @example */
    $grades = array(); // populate array of grade objects indexed by userid

    grade_update('mod/pasanlive_result_manager', $pasanlive_result_manager->course, 'mod', 'pasanlive_result_manager', $pasanlive_result_manager->id, 0, $grades);
}

////////////////////////////////////////////////////////////////////////////////
// File API                                                                   //
////////////////////////////////////////////////////////////////////////////////

/**
 * Returns the lists of all browsable file areas within the given module context
 *
 * The file area 'intro' for the activity introduction field is added automatically
 * by {@link file_browser::get_file_info_context_module()}
 *
 * @param stdClass $course
 * @param stdClass $cm
 * @param stdClass $context
 * @return array of [(string)filearea] => (string)description
 */
function pasanlive_result_manager_get_file_areas($course, $cm, $context) {
    return array();
}

/**
 * File browsing support for pasanlive_result_manager file areas
 *
 * @package mod_pasanlive_result_manager
 * @category files
 *
 * @param file_browser $browser
 * @param array $areas
 * @param stdClass $course
 * @param stdClass $cm
 * @param stdClass $context
 * @param string $filearea
 * @param int $itemid
 * @param string $filepath
 * @param string $filename
 * @return file_info instance or null if not found
 */
function pasanlive_result_manager_get_file_info($browser, $areas, $course, $cm, $context, $filearea, $itemid, $filepath, $filename) {
    return null;
}

/**
 * Serves the files from the pasanlive_result_manager file areas
 *
 * @package mod_pasanlive_result_manager
 * @category files
 *
 * @param stdClass $course the course object
 * @param stdClass $cm the course module object
 * @param stdClass $context the pasanlive_result_manager's context
 * @param string $filearea the name of the file area
 * @param array $args extra arguments (itemid, path)
 * @param bool $forcedownload whether or not force download
 * @param array $options additional options affecting the file serving
 */
function pasanlive_result_manager_pluginfile($course, $cm, $context, $filearea, array $args, $forcedownload, array $options=array()) {
    global $DB, $CFG;

    if ($context->contextlevel != CONTEXT_MODULE) {
        send_file_not_found();
    }

    require_login($course, true, $cm);

    send_file_not_found();
}

////////////////////////////////////////////////////////////////////////////////
// Navigation API                                                             //
////////////////////////////////////////////////////////////////////////////////

/**
 * Extends the global navigation tree by adding pasanlive_result_manager nodes if there is a relevant content
 *
 * This can be called by an AJAX request so do not rely on $PAGE as it might not be set up properly.
 *
 * @param navigation_node $navref An object representing the navigation tree node of the pasanlive_result_manager module instance
 * @param stdClass $course
 * @param stdClass $module
 * @param cm_info $cm
 */
function pasanlive_result_manager_extend_navigation(navigation_node $navref, stdclass $course, stdclass $module, cm_info $cm) {
}

/**
 * Extends the settings navigation with the pasanlive_result_manager settings
 *
 * This function is called when the context for the page is a pasanlive_result_manager module. This is not called by AJAX
 * so it is safe to rely on the $PAGE.
 *
 * @param settings_navigation $settingsnav {@link settings_navigation}
 * @param navigation_node $pasanlive_result_managernode {@link navigation_node}
 */
function pasanlive_result_manager_extend_settings_navigation(settings_navigation $settingsnav, navigation_node $pasanlive_result_managernode=null) {
}
