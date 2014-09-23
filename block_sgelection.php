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
 * Student government election block
 * @package    block_sgelection
 * @copyright  2014 onwards Louisiana State University (http://www.lsu.edu)
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
require_once ($CFG->dirroot . '/blocks/sgelection/lib.php');
require_once ($CFG->dirroot . '/enrol/ues/publiclib.php');
require_once ($CFG->dirroot . '/blocks/sgelection/classes/voter.php');

ues::require_daos();

class block_sgelection extends block_list {
    /**
     * Block initialization
     */
    public function init() {
        $this->title = get_string('sgelection', 'block_sgelection');
    }

    /**
     * Allow the block to have a configuration page
     *
     * @return boolean
     */
    public function has_config() {
        return true;
    }

    /**
     * Locations where block can be displayed
     *
     * @return array
     */
    public function applicable_formats() {
        return array('site' => true, 'my-index' => true, 'course' => false);
    }

    /**
     * Return contents of the sgelection block
     *
     * @return stdClass contents of block
     */
    public function get_content() {
        global $USER, $CFG, $COURSE, $OUTPUT, $DB;

        $voter = new voter($USER->id);

        // See if this user should be allowed to view the block at all.
        if(!isloggedin() || ($voter->courseload() == voter::VOTER_NO_TIME && !$voter->is_privileged_user())){
            return $this->content;
        }

        $this->content = new stdClass;
        $this->content->items = array();
        $this->content->icons = array();

        $icon_class = array('class' => 'icon');

        foreach(election::get_active() as $ae){

                $semester = $ae->shortname();
                $numberOfVotesTotal = $DB->count_records('block_sgelection_voted', array('election_id'=>$ae->id));
                $numberOfVotesTotalString =  html_writer::tag('p', 'votes cast so far ' . $numberOfVotesTotal);
                if(!$voter->already_voted($ae)){
                    $this->content->items[] = html_writer::link( new moodle_url('/blocks/sgelection/ballot.php', array('election_id' => $ae->id)), 'Ballot for ' . $semester ) . ' ' . $numberOfVotesTotalString;
                    $this->content->icons[] = $OUTPUT->pix_icon('t/check', 'admin', 'moodle', $icon_class);
                }
                else{
                    $this->content->items[] = html_writer::tag('p','Ballot for ' . $semester . ' ' . $numberOfVotesTotalString);
                    $this->content->icons[] = $OUTPUT->pix_icon('t/check', 'admin', 'moodle', $icon_class);

                }

        }

        $issgadmin = $voter->is_faculty_advisor() || is_siteadmin();
        if($issgadmin){
            $administrate = html_writer::link(new moodle_url('/blocks/sgelection/admin.php', array('blockid' => $this->instance->id, 'courseid' => $COURSE->id)), get_string('configure', 'block_sgelection'));
            $this->content->items[] = $administrate;
            $this->content->icons[] = $OUTPUT->pix_icon('t/edit', 'admin', 'moodle', $icon_class);
        }

        $caneditelections = $voter->is_commissioner() || $voter->is_faculty_advisor() || is_siteadmin();
        if($caneditelections){
            $commissioner = html_writer::link(new moodle_url('/blocks/sgelection/commissioner.php'), get_string('create_election', 'block_sgelection'));
            $this->content->items[] = $commissioner;
            $this->content->icons[] = $OUTPUT->pix_icon('t/edit', 'admin', 'moodle', $icon_class);
        }


        return $this->content;
    }

    /**
     * Can we load multiple instances of the block on a single page?
     *
     * @return array
     */
    public function instance_allow_multiple() {
        return false;
    }

    /**
     * @TODO add some logic to ensure that this only runs in the week before the election.
     * @global type $DB
     * @return boolean
     */
    public function cron() {
        global $DB;

        // Iterate over each semester which is ready for eligibility calculation
        // creating block_sgelection_hours rows for each student enrolled.
        foreach(sge::semesters_eligible_for_census() as $s){

            // If any hours rows exist for this semester, remove them- we want fresh data.
            $DB->delete_records('block_sgelection_hours', array('semesterid' => $s->id));

            // Get user enrolled hours for the given semester.
            $hours = sge::calculate_all_enrolled_hours_for_semester($s);

            // If we get no results (should never happen, provided
            // ues users are enrolled), continue to the next one.
            if(false === $hours){
                continue;
            }

            // Insert each row.
            // @TODO consider doing this using with a moodle batch
            // insert or a transaction (include the delete too...)
            foreach($hours as $row){
                $DB->insert_record('block_sgelection_hours', $row);
            }
        }

        $elections = Election::get_active();
        if(count($elections) > 0){
            foreach($elections as $election){
                $election->message_admins();
            }
        }
    return true;
    }
}
