<?php
require_once("{$CFG->libdir}/formslib.php");
require_once($CFG->dirroot.'/blocks/sgelection/lib.php');

class resolution_form extends moodleform {
    function definition() {
        global $DB;
        $mform =& $this->_form;
        // add resolution header
        
        $mform->addElement('header', 'displayinfo', get_string('create_new_resolution', 'block_sgelection'));

        $attributes = array('size' => '50', 'maxlength' => '100');
        $mform->addElement('text', 'title_of_resolution', get_string('title_of_resolution', 'block_sgelection'), $attributes);
        $mform->setType('title_of_resolution', PARAM_TEXT);
        
        $attributes = array('size' => '50', 'maxlength' => '100');
        $mform->addElement('textarea', 'resolution_text', get_string('resolution_text', 'block_sgelection'), $attributes);
        $mform->setType('resolution_text', PARAM_TEXT);        

        $buttons = array(
            $mform->createElement('submit', 'save_resolution', get_string('savechanges')),
            $mform->createElement('submit', 'delete', get_string('delete')),
            $mform->createElement('cancel')
        );
        $mform->addGroup($buttons, 'buttons', 'actions', array(' '), false);        
        
    }
}