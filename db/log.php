<?php
/**
 * Definition of log events
 *
 * author : Pasan Buddhika Weerathunga
 * email : me@pasanlive.com
 * 
 * @package    mod_pasanliveResultManager
 */

defined('MOODLE_INTERNAL') || die();

global $DB;

$logs = array(
    array('module'=>'pasanliveResultManager', 'action'=>'add', 'mtable'=>'pasanliveResultManager', 'field'=>'name'),
    array('module'=>'pasanliveResultManager', 'action'=>'update', 'mtable'=>'pasanliveResultManager', 'field'=>'name'),
    array('module'=>'pasanliveResultManager', 'action'=>'view', 'mtable'=>'pasanliveResultManager', 'field'=>'name'),
    array('module'=>'pasanliveResultManager', 'action'=>'view all', 'mtable'=>'pasanliveResultManager', 'field'=>'name')
);
