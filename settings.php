<?php
// MySQL DATABASE
$mysqli_server          = NULL;
$mysqli_user            = '';
$mysqli_key             = '';

$mysqli_db              = '';
$mysqli_charset         = 'utf8';

// Steam
$steamapikey = '';
$steamgroupid = 103582791438651146; // [Default: 103582791438651146 (koalaSportsCSGO)]
$steam_updatetimeout = 60; // Time in seconds until steam account details (name/avatar) can be updated

// Other
$timezone = 'Europe/Berlin'; // Valid Timezones: http://php.net/manual/timezones.php
$dateformat = 'd.m.Y'; // Valid formatting options: http://php.net/manual/function.date.php

// Game Settings
$allow_pairs = true; // Allow the matching of 2 users with each other. [Default: true]
$max_pair_chance = 0.6; // Maximum amount of generated pairs (out of 100) [Default: 0.6]