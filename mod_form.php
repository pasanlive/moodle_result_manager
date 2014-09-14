<?php

/**
 * The main pasanliveresultmanager configuration form
 *
 * author : Pasan Buddhika Weerathunga
 * email : me@pasanlive.com
 *
 * @package    mod_pasanliveresultmanager
 */

defined('MOODLE_INTERNAL') || die();

require_once($CFG->dirroot.'/course/moodleform_mod.php');

/**
 * Module instance settings form
 */
class mod_resultmanager_mod_form extends moodleform_mod {

    /**
     * Defines forms elements
     */
    public function definition() {

        $mform = $this->_form;

        //-------------------------------------------------------------------------------
        // Adding the "general" fieldset, where all the common settings are showed
        $mform->addElement('header', 'general', get_string('general', 'form'));

        // Adding the standard "name" field
        $mform->addElement('text', 'name', get_string('pasanliveresultmanagername', 'pasanliveresultmanager'), array('size'=>'64'));
        if (!empty($CFG->formatstringstriptags)) {
            $mform->setType('name', PARAM_TEXT);
        } else {
            $mform->setType('name', PARAM_CLEAN);
        }
        $mform->addRule('name', null, 'required', null, 'client');
        $mform->addRule('name', get_string('maximumchars', '', 255), 'maxlength', 255, 'client');
        $mform->addHelpButton('name', 'pasanliveresultmanagername', 'pasanliveresultmanager');

        // Adding the standard "intro" and "introformat" fields
        $this->add_intro_editor();

        //-------------------------------------------------------------------------------
        // Adding the rest of pasanliveresultmanager settings, spreeading all them into this fieldset
        // or adding more fieldsets ('header' elements) if needed for better logic
        $mform->addElement('static', 'label1', 'pasanliveresultmanagersetting1', 'Your pasanliveresultmanager fields go here. Replace me!');

        $mform->addElement('header', 'pasanliveresultmanagerfieldset', get_string('pasanliveresultmanagerfieldset', 'pasanliveresultmanager'));
        $mform->addElement('static', 'label2', 'pasanliveresultmanagersetting2', 'Your pasanliveresultmanager fields go here. Replace me!');

        //-------------------------------------------------------------------------------
        // add standard elements, common to all modules
        $this->standard_coursemodule_elements();
        //-------------------------------------------------------------------------------
        // add standard buttons, common to all modules
        $this->add_action_buttons();
    }
}
