<?php
$string['pluginname'] = 'SGElection Block';
$string['sgelection'] = 'Student Gov\'t Election';
$string['sgelection:addinstance'] = 'Add a new Student Government Election block';
$string['sgelection:myaddinstance'] = 'Add a new Student Government Election to the My Moodle page';
$string['blockstring'] = 'What should the block say';
$string['vote'] = 'Vote!';
$string['textfields'] = 'Text Fields';
$string['admin_page_header'] = 'Student Gov\'t Admin Page';
$string['sgelectionsettings'] = 'SG Election Settings';
$string['editpage'] = 'Edit Page';
$string['blocktitle'] = 'Title of Block';
$string['pagetitle'] = 'Page Title';
$string['displayedhtml'] = 'Displayed HTML';
$string['picturefields'] = 'Picture Fields';
$string['displaypicture'] = "Display Picture";
$string['red'] = 'red';
$string['blue'] = 'blue';
$string['green'] = 'green';
$string['pictureselect'] = 'Picture Select';
$string['picturedesc'] = 'Picture Description';
$string['displaydate'] = 'Display Date';

//block_sge...
$string['create_election'] = 'Create Election';
$string['configure'] = 'Configure';

// Election
$string['election_fullname'] = '{$a->sem} [{$a->name}]';
$string['election_shortname'] = '{$a->sem} [{$a->name}]';
$string['create_election']    = 'Create new election';
$string['thanks_for_voting'] = 'Thanks for voting!';

// Candidates
$string['candidates_pagetitle'] = 'Add or Edit a Candidate';
$string['create_new_candidate'] = 'Create a New Candidate';
$string['paws_id_of_candidate'] = 'paws ID of Candidate';
$string['office_candidate_is_running_for'] = 'Office the Candidate is running for';
$string['affiliation'] = 'Affiliation';

// Ballot
$string['ballot_page_header'] = '{$a} Ballot';
$string['preview_ballot'] = 'Preview Ballot';
$string['preview'] = 'Preview';

// Resolutions
$string['abstain'] = 'Abstain';
$string['title_of_resolution'] = 'Title of Resolution';
$string['create_new_resolution'] = 'Create New Resolution';
$string['resolution_text'] = 'Resolution Text';
$string['resolution_page_header'] = 'Resolution Page';
$string['for'] = 'For';
$string['against'] = 'Against';
$string['resolution'] = 'Resolution';
$string['restrict_to_fulltime'] = 'Restrict to Full Time?';
$string['link_to_fulltext'] = 'Link to Full Text';

// Offices
$string['office_page_header'] = 'Office Page Header';
$string['create_new_office'] = 'Create New Office';
$string['title_of_office'] = 'Title of Office';
$string['number_of_openings'] = 'Number of Openings';
$string['limit_to_college'] = 'Limit to College';
$string['select_up_to'] = 'Select Up To ';
$string['weight'] = 'Weight';

// Candidate Table
$string['id'] = 'id';
$string['userid'] = 'userid';
$string['office'] = 'office';
$string['affiliation'] = 'affiliation/VP';
$string['election_id'] = 'election_id';

// Administration
$string['commissioner'] = 'Commissioner';
$string['fulltime'] = 'Full Time';
$string['parttime'] = 'Part Time';
$string['election_tool_administration'] = ' Election Tool Administration';
$string['excluded_curriculum_code'] = 'Excluded Curriculum Code';
// Commissioner Page / building election object
$string['start_date'] = 'Start Date';
$string['end_date'] = 'End Date';
$string['semester'] = 'Semester';
$string['name'] = 'Name';
$string['new_election_options'] = 'Create New Election';
$string['ballot'] ='ballot';
$string['hours_census_start'] = 'Census Start Time';
$string['hours_census_start_help'] = 'This time setting defines the first second in which Moodle may calculate enrollment eligibility (enrolled hours) for users.';

// errors
$string['err_user_nonexist'] = 'User {$a} does not exist.';
$string['err_user_nonunique'] = 'User {$a->username} already running for office {$a->office} in the {$a->semestername} election (election id {$a->eid}).';
$string['err_resolution_title_nonunique'] = 'A resolution with this title already exists.';
$string['err_election_nonunique'] = 'An election called <em>{$a}</em> already exists';
$string['err_start_end_disorder'] = 'Start date {$a->start} must occur before end date {$a->end}.';
$string['err_office_name_nonunique'] = "An Office with this name already exists";
$string['err_user_notfulltime'] = "Commissioner has to be fulltime";
$string['err_census_start_too_soon'] = 'Census start time must be set after the election earliest_start date ({$a->earliest}) and at least {$a->window} hours before election start time.';
$string['err_start_end_outofbounds'] = 'Election start and end dates must fall within the acceptable range as defined by the Moodle administrator. [{$a->earliest} - {$a->latest}]';
$string['err_election_future_start'] = 'In order to allow time for the enrollment census to run, election can be set to start no sooner than {$a}.';
$string['err_census_future_start']   = 'Census cannot start in the past.';

//results
$string['results_page_header'] = 'Results';

// voter
$string['ptorft'] = 'Part Time or Full Time';

//admin settings
$string['facadv'] = 'Faculty Advisor';
$string['facadv_desc'] = 'Username of the SG Faculty Advisor';
$string['earliest_start'] = '#days after semester start';
$string['earliest_start_desc'] = 'How many days after the semester starts is it ok to begin an election ?';
$string['latest_end'] = '#days before grades due';
$string['latest_end_desc'] = 'How many days before the semester ends is it ok to end an election ?';
$string['census_window'] = 'Census cron window';
$string['census_window_desc'] = 'How many hours before an election can we allow the census period to begin? NB that cron must have a chance to run between election census start and election start.';
