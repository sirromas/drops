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
 * The mod_bigbluebuttonbn recording edited event.
 *
 * @package   mod_bigbluebuttonbn
 * @copyright 2010-2017 Blindside Networks Inc
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v2 or later
 * @author    Jesus Federico  (jesus [at] blindsidenetworks [dt] com)
 */

namespace mod_bigbluebuttonbn\event;

defined('MOODLE_INTERNAL') || die();

/**
 * The mod_bigbluebuttonbn recording edited event (triggered when a recording is updated).
 *
 * @copyright 2010-2017 Blindside Networks Inc
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v2 or later
 */
class bigbluebuttonbn_recording_edited extends base
{
    /**
     * Init method.
     */
    protected function init() {
        parent::init();
        $this->description = "The user with id '$this->userid' has edited a recording with id ".
            "'$this->other' in the course id '$this->contextinstanceid'.";
    }

    /**
     * Return localised event name.
     *
     * @return string
     */
    public static function get_name() {
        return 'Recording edited';
    }

    /**
     * Return objectid mapping.
     *
     * @return string
     */
    public static function get_objectid_mapping() {
        return array('db' => 'bigbluebuttonbn', 'restore' => 'bigbluebuttonbn');
    }
}
