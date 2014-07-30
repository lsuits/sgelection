<?php
// This file is part of Moodle - http://moodle.org/
//
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// Moodle is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle.  If not, see <http://www.gnu.org/licenses/>.


/**
 * @package    block_sgelection
 * @copyright  2014 Louisiana State University
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
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