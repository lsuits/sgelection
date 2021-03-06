<?php
global $CFG, $PAGE;
require_once("{$CFG->libdir}/formslib.php");
require_once($CFG->dirroot.'/blocks/sgelection/lib.php');
require_once 'lib.php';
class lookupvoter_form extends moodleform {
    function definition() {
        global $DB, $PAGE;
        $mform =& $this->_form;
        $election = $this->_customdata['election'];
        
        $attributes = array('size' => '50', 'maxlength' => '100');
        $mform->addElement('text', 'username', sge::_str('paws_id_of_student'), $attributes);
        $mform->setType('username', PARAM_ALPHANUM);
        
        $buttons = array(
            $mform->createElement('submit', 'lookupuser', sge::_str('lookupuser')),
            $mform->createElement('cancel')
        );
        $mform->addGroup($buttons, 'buttons', 'actions', array(' '), false);

     }
}
