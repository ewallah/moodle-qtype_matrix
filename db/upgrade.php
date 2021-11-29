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

function xmldb_qtype_matrix_upgrade($oldversion) {

    global $CFG, $DB;

    $dbman = $DB->get_manager();
    if ($oldversion < 2014040800) {

        // Define table matrix to be created.
        $table = new xmldb_table('question_matrix');

        // Adding fields to table matrix.
        $newfield = $table->add_field('shuffleanswers', XMLDB_TYPE_INTEGER, '2', null, XMLDB_NOTNULL, null, '1');
        $dbman->add_field($table, $newfield);

        upgrade_plugin_savepoint(true, 2014040800, 'qtype', 'matrix');
    }

    if ($oldversion < 2015070100) {

        // Define table matrix to be created.
        $table = new xmldb_table('question_matrix');

        // Adding fields to table matrix.
        $newfield = $table->add_field('use_dnd_ui', XMLDB_TYPE_INTEGER, '2', null, XMLDB_NOTNULL, null, '0');
        $dbman->add_field($table, $newfield);

        upgrade_plugin_savepoint(true, 2015070100, 'qtype', 'matrix');
    }
    return true;
}
