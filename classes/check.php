<?php
namespace block_configurable_reports;
use core\check\check;
use core\check\result;

class sqlsecuritycheck extends check {

    public function get_action_link(): ?\action_link {
        return new \action_link(
            new \moodle_url('/admin/settings.php?section=blocksettingconfigurable_reports'),
            get_string('pluginname', 'block_configurable_reports'));
    }

    public function get_result() : result {
        global $CFG;

        $status = result::OK;
        $summary = get_string('check_sqlsecurity_ok', 'block_configurable_reports');

        if ($CFG->forced_plugin_settings['block_configurable_reports']['sqlsecurity'] != '1') {
            $status = result::WARNING;
            $summary = get_string('check_sqlsecurity_warning', 'block_configurable_reports');
            if (!get_config('block_configurable_reports', 'sqlsecurity')) {
                $status = result::CRITICAL;
                $summary = get_string('check_sqlsecurity_critical', 'block_configurable_reports');
            }
        }

        $details = get_string('check_details', 'block_configurable_reports');
        return new result($status, $summary, $details);
    }
}
