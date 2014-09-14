<?php
/**
 * Definition of log events
 *
 * author : Pasan Buddhika Weerathunga
 * email : me@pasanlive.com
 * 
 * @package    mod_pasanlive_result_manager
 */

defined('MOODLE_INTERNAL') || die();

global $DB;

$logs = array(
    array('module'=>'pasanlive_result_manager', 'action'=>'add', 'mtable'=>'pasanlive_result_manager', 'field'=>'name'),
    array('module'=>'pasanlive_result_manager', 'action'=>'update', 'mtable'=>'pasanlive_result_manager', 'field'=>'name'),
    array('module'=>'pasanlive_result_manager', 'action'=>'view', 'mtable'=>'pasanlive_result_manager', 'field'=>'name'),
    array('module'=>'pasanlive_result_manager', 'action'=>'view all', 'mtable'=>'pasanlive_result_manager', 'field'=>'name')
);
