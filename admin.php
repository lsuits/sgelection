<?php

require_once('../../config.php');
require_once('admin_form.php');
require_once 'lib.php';

global $DB, $OUTPUT, $PAGE;
sge::prevent_voter_access();

$done    = optional_param('done', 0, PARAM_TEXT);
$selfurl = '/blocks/sgelection/admin.php';

$PAGE->requires->js('/blocks/sgelection/js/autouserlookup.js');

$PAGE->set_context(context_system::instance());
$PAGE->set_url($selfurl);
$PAGE->set_pagelayout('standard');
$PAGE->set_heading(get_string('admin_page_header', 'block_sgelection'));

require_login();

// Setup nav, depending on voter.
$voter    = new voter($USER->id);
$renderer = $PAGE->get_renderer('block_sgelection');
$renderer->set_nav(null, $voter);

$form = new sg_admin_form();

if($form->is_cancelled()){
    redirect('/');
} else if($fromform = $form->get_data()){
    //We need to add code to appropriately act on and store the submitted data
    set_config('commissioner', $fromform->commissioner, 'block_sgelection');
    set_config('fulltime', $fromform->fulltime, 'block_sgelection');
    set_config('parttime', $fromform->parttime, 'block_sgelection');
    // @TODO if excl_curr_codes is not set, we have a problem.
    // Probably, supply a default value here.
    // Alternatively, provide a 'none' option in the form that will need to be checked here.
    set_config('excluded_curr_codes', implode(',', $fromform->excluded_curr_codes), 'block_sgelection');

    redirect(new moodle_url($selfurl, array('done'=>'true')));
} else {
    $form->set_data(get_config('block_sgelection'));
    echo $OUTPUT->header();


    echo $done == true ? $OUTPUT->notification('changes saved', 'notifysuccess') : '';
    $form->display();
    $listofusers = sge::get_list_of_usernames();
    $PAGE->requires->js_init_call('autouserlookup', array($listofusers, '#id_commissioner'));

    echo $OUTPUT->footer();
}
