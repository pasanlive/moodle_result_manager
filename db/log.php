<?php
/**
 * Definition of log events
 *
 * author : Pasan Buddhika Weerathunga
 * email : me@pasanlive.com
 * 
 * @package    mod_pasanliveresultmanager
 */

defined('MOODLE_INTERNAL') || die();

global $DB;

$logs = array(
    array('module'=>'resultmanager', 'action'=>'add', 'mtable'=>'resultmanager', 'field'=>'name'),
    array('module'=>'resultmanager', 'action'=>'update', 'mtable'=>'resultmanager', 'field'=>'name'),
    array('module'=>'resultmanager', 'action'=>'view', 'mtable'=>'resultmanager', 'field'=>'name'),
    array('module'=>'resultmanager', 'action'=>'view all', 'mtable'=>'resultmanager', 'field'=>'name')
);
