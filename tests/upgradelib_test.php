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
 * Test upgradelib methods.
 *
 * @package    block_xp
 * @copyright  2017 Ruben Cancho
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

global $CFG, $DB;

class block_xp_upgradelib_testcase extends advanced_testcase {

    protected function setUp() {
        $this->resetAfterTest(true);
        block_xp_manager::purge_static_caches();
    }

    function test_add_static_filters_to_courses() {
        global $DB;

        // Generate course
        $course1 = $this->getDataGenerator()->create_course();
        $course2 = $this->getDataGenerator()->create_course();

        $this->assertSame(0, count($DB->get_records('block_xp_config', array('courseid'=> $course1->id))));
        $this->assertSame(0, count($DB->get_records('block_xp_config', array('courseid'=> $course2->id))));

        $manager1 = block_xp_manager::get($course1->id);
        $manager1->update_config(array('enabled' => true));

        $manager2 = block_xp_manager::get($course2->id);
        $manager2->update_config(array('enabled' => true));

        // A config record should be now associated to a course
        $this->assertSame(1, count($DB->get_records('block_xp_config', array('courseid'=> $course1->id))));

        // Courses should not have filters now
        $this->assertSame(0, count($DB->get_records('block_xp_filters', array('courseid'=> $course1->id))));
        $this->assertSame(0, count($DB->get_records('block_xp_filters', array('courseid'=> $course2->id))));

        block_xp_upgradelib::add_static_filters_to_courses();

        // By default a new course should have 5 default rules.
        $this->assertSame(5, count($DB->get_records('block_xp_filters', array('courseid'=> $course1->id))));
        $this->assertSame(5, count($DB->get_records('block_xp_filters', array('courseid'=> $course2->id))));


    }


    public function test_add_static_filters_to_empty_course() {
        global $DB;

        // Generate course
        $course1 = $this->getDataGenerator()->create_course();

        $this->assertSame(0, count($DB->get_records('block_xp_config', array('courseid'=> $course1->id))));

        $manager1 = block_xp_manager::get($course1->id);
        $manager1->update_config(array('enabled' => true));

        // Adding a block should add static filters.
        block_xp_upgradelib::add_static_filters_to_course($course1->id);

        $this->assertSame(5, count($DB->get_records('block_xp_filters', array('courseid'=> $course1->id))));

        // Readding a block should not add filters again.
        block_xp_upgradelib::add_static_filters_to_course($course1->id);

        $this->assertSame(5, count($DB->get_records('block_xp_filters', array('courseid'=> $course1->id))));
    }


    // TODO: test execute_as_transaction method rollback
    public function test_rollback() {
    }

}