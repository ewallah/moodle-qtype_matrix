<?php

// This file keeps track of upgrades to
// the match qtype plugin
//
// Sometimes, changes between versions involve
// alterations to database structures and other
// major things that may break installations.
//
// The upgrade function in this file will attempt
// to perform all the necessary actions to upgrade
// your older installation to the current version.
//
// If there's something it cannot do itself, it
// will tell you what you need to do.
//
// The commands in here will all be database-neutral,
// using the methods of database_manager class
//
// Please do not forget to use upgrade_set_timeout()
// before any action that may take longer time to finish.

function xmldb_qtype_matrix_upgrade($oldversion) {

    global $CFG, $DB;

    $dbman = $DB->get_manager();
    if ($oldversion < 2014040800) {

        // Define table matrix to be created
        $table = new xmldb_table('question_matrix');

        // Adding fields to table matrix
        $newField = $table->add_field('shuffleanswers', XMLDB_TYPE_INTEGER, '2', null, XMLDB_NOTNULL, null, '1');
        $dbman->add_field($table, $newField);

        upgrade_plugin_savepoint(true, 2014040800, 'qtype', 'matrix');
    }

    // mod_ND : BEGIN
    if ($oldversion < 2015070100) {

        // Define table matrix to be created
        $table = new xmldb_table('question_matrix');

        // Adding fields to table matrix
        $newField = $table->add_field('use_dnd_ui', XMLDB_TYPE_INTEGER, '2', null, XMLDB_NOTNULL, null, '0');
        $dbman->add_field($table, $newField);

        upgrade_plugin_savepoint(true, 2015070100, 'qtype', 'matrix');
    }
    // mod_ND : END

    return true;
}
