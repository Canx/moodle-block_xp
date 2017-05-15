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
 * Block XP.
 *
 * @package    block_xp
 * @copyright  2014 Frédéric Massart
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace block_xp_upgradelib {

defined('MOODLE_INTERNAL') || die();

require_once($CFG->dirroot . '/blocks/xp/classes/static_filters.php');

/**
 * static_filters_v1 used to upgrade to 2017040901
 *
 * WARNING! We need to override this class if we make changes in block_static_filters!!!
*
* @package    block_xp
* @copyright  2017 Ruben Cancho
* @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
*/
    class static_filters_v1 extends block_xp_static_filters {

    }


}