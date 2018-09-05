<?php
require 'settings.php';
require 'steamauth/steamauth.php';



// MYSQLI CREATE
$conn = mysqli_connect($mysqli_server, $mysqli_user, $mysqli_key, $mysqli_db);
if (!$conn) {
  die("Database Connection failed: " . mysqli_connect_error());
}
mysqli_set_charset($conn, $mysqli_charset);

// Set timezone
date_default_timezone_set($timezone);

// Configure current page
if (isset($_GET['page'])) {

  switch ($_GET['page']) {

    case "secure":
      $page = "secure";
      break;

    default:
      $page = "index";
  }
} else {
  $page = "index";
}



// FUNCTIONS
function redirect($location = null)
{
  if (isset($location)) {
    header("Location: " . $location);
  } else {
    header("Location: " . $_SERVER['REQUEST_URI']);
  }
  exit();
}

function check_steamgroup_xml($id) // Retrieves user's Steam page to check if they are currently in the Steam group
{
  $profilelink = "http://steamcommunity.com/profiles/" . $_SESSION['steamid'] . "?xml=1";
  //$profilelink = "http://steamcommunity.com/profiles/76561197968657644?xml=1"; // demo user who is NOT part of the steam group
  $profile = simplexml_load_file($profilelink);

  foreach ($profile->groups->group as $groups) {
    $groupIDs[] = floatval($groups->groupID64);
  }

  $steamgroupvalid = false;
  foreach ($groupIDs as $groupID) {
    if ($groupID == $id) {
      $steamgroupvalid = true;
    }
  }

  return $steamgroupvalid;
}

function check_registered() // Checks if user has a DB entry
{
  global $conn;

  $query = 'SELECT 1
            FROM user
            WHERE steamID64 = "' . $_SESSION['steamid'] . '"';

  $result = mysqli_query($conn, $query);

  if (mysqli_num_rows($result) > 0) {
    $user_registered = true;
  } else {
    $user_registered = false;
  }

  return $user_registered;
}

function check_is_in_group() // Checks 'is_in_group' attribute
{
  global $conn;

  $query = 'SELECT is_in_group
            FROM user
            WHERE steamID64 = "' . $_SESSION['steamid'] . '"';

  $result = mysqli_query($conn, $query);

  if (mysqli_num_rows($result) > 0) {
    $user_is_in_group = mysqli_fetch_row($result);
    $user_is_in_group = $user_is_in_group[0];
  } else {
    return "Error: User profile corrupt or user does not exist!";
  }
  return $user_is_in_group;
}

function check_is_active() // Checks 'is_active' attribute
{
  global $conn;

  $query = 'SELECT is_active
            FROM user
            WHERE steamID64 = "' . $_SESSION['steamid'] . '"';

  $result = mysqli_query($conn, $query);

  if (mysqli_num_rows($result) > 0) {
    $user_is_active = mysqli_fetch_row($result);
    $user_is_active = $user_is_active[0];
  } else {
    return "Error: User profile corrupt or user does not exist!";
  }
  return $user_is_active;
}

function get_dates() // Retrieve dates from DB
{
  global $conn;

  $query = 'SELECT attribute, value
            FROM var
            WHERE attribute LIKE "date.%"';

  $result = mysqli_query($conn, $query);

  if (!mysqli_num_rows($result) > 0) {
    return "Error: Dates are not setup correctly.";

  } else {

    while ($row = mysqli_fetch_assoc($result)) {
      $dates[$row["attribute"]] = $row["value"];
    }
  }
  return $dates;
}

function display_date($dates, $type) // Returns correctly formatted date for display (format can be set in settings.php)
{
  global $dateformat;

  if (!($type == "register" || $type == "gifts" || $type == "end")) {
    return "Invalid date type.";

  } else {
    $time = strtotime($dates["date." . $type]);
    $display_date = date($dateformat, $time);

    return $display_date;
  }
}

function get_gamestate($dates) // Get current gamestate (Registration open = 0; Preparing gifts: 1; Game ended: 2)
{
  // end date
  $checked_date = new DateTime($dates["date.end"]);
  $current_date = new DateTime();
  if ($checked_date < $current_date) {
    return 3; // end date has passed
  }

  // gifts date
  $checked_date = new DateTime($dates["date.gifts"]);
  $current_date = new DateTime();
  if ($checked_date < $current_date) {
    return 2; // gift preparation date has passed
  }

  // register date
  $checked_date = new DateTime($dates["date.register"]);
  $current_date = new DateTime();
  if ($checked_date < $current_date) {
    return 1; // registration date has passed
  }
  return 0; // registration is still open
}

function user_set_active($new_value, $steamID64)
{
  global $conn;

  if ($new_value) {
    $new_value = "1";
  } else {
    $new_value = "0";
  }

  $query = 'UPDATE user
            SET is_active=' . $new_value . '
            WHERE steamID64 = "' . $steamID64 . '"';

  $result = mysqli_query($conn, $query);

  if (!$result) {
    echo "Could not make user participate.";
    exit;
  }
}

function get_participants()
{
  global $conn;

  $query = 'SELECT steamID64, name, avatar
            FROM user
            WHERE is_active = 1
            ORDER BY name ASC';

  $result = mysqli_query($conn, $query);

  if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
      $participants[] = array_map("htmlspecialchars", $row);
    }
  } else {
    $participants = false;
  }
  return $participants;
}

function get_players_matched()
{
  global $conn;

  $query = 'SELECT value
            FROM var
            WHERE attribute = "players.matched"';

  $result = mysqli_query($conn, $query);

  if (mysqli_num_rows($result) > 0) {
    $players_matched = mysqli_fetch_row($result);
    $players_matched = $players_matched[0];
  } else {
    return "Error: Can't retrieve player matching status.";
  }
  return $players_matched;
}

function match_players($allow_pairs = true, $max_pair_chance)
{
  global $conn;

  // GET ACTIVE PLAYERS
  $query = 'SELECT steamID64
            FROM user
            WHERE is_active = 1';

  $result = mysqli_query($conn, $query);

  while ($row = mysqli_fetch_row($result)) {
    $row = array_map("htmlspecialchars", $row);
    $players[] = $row[0];
  }

  $playercount = count($players);

  // MATCH PLAYERS
  if (!$allow_pairs) { // Don't generate pairs (creates "circle" of players)

    shuffle($players);

    $players_origin = $players; // player
    $players_match = $players; // player's match

    array_push($players_match, array_shift($players_match)); // array_shift removes the first value. array_push adds it to the end of the array

  } else { // Generate Pairs

    $pair_count = random_int(0, $playercount); // random number between 0 - amount of players
    $pair_count = $pair_count * 0.5 * $max_pair_chance; // 0.5 to get pairs, instead of individuals
    $pair_count = floor($pair_count);

    shuffle($players);

    for ($i = 1; $i <= $pair_count; $i++) { // creates pairs in different arrays
      $pairs_origin[] = $players[0];
      $pairs_origin[] = $players[1];
      $pairs_match[] = $players[1];
      $pairs_match[] = $players[0];
      array_shift($players);
      array_shift($players);
    }

    $players_origin = $players;
    $players_match = $players;

    if (!empty($players)) { // only shift array, if it isn't empty (happens when only pairs exist)
      array_push($players_match, array_shift($players_match)); // array_shift removes the first value. array_push adds it to the end of the array
    }

    if (isset($pairs_origin)) { // only merge with pairs array, if at least one pair was created
      $players_origin = array_merge($pairs_origin, $players_origin);
      $players_match = array_merge($pairs_match, $players_match);
    }
  }

  // DELETE OLD TABLE ROWS
  $query = 'TRUNCATE TABLE matches';

  $result = mysqli_query($conn, $query);
  if (mysqli_error($conn)) {
    echo "Could not truncate matches table.";
    exit;
  }

  // INSERT MATCHES INTO DB
  $query = 'INSERT INTO matches (steamID64_origin, steamID64_match)
            VALUES ';

  for ($i = 0; $i <= $playercount - 1; $i++) {
    $query .= '(' . $players_origin[$i] . ', ' . $players_match[$i] . '), ';
  }

  $query = substr($query, 0, -2);
  $query .= ';';

  $result = mysqli_query($conn, $query);
  if (mysqli_error($conn)) {
    echo "Could not add matched users to database.";
    exit;
  }

  // SET players.matched
  $query = 'UPDATE var
            SET value = "1"
            WHERE attribute = "players.matched"';

  $result = mysqli_query($conn, $query);
  if (mysqli_error($conn)) {
    echo "Could not update players.matched variable.";
    exit;
  }
}

function get_match()
{
  global $conn;

  $query = 'SELECT user.steamID64, user.name, user.avatar
            FROM matches
            INNER JOIN user ON matches.steamID64_match=user.steamID64
            WHERE matches.steamID64_origin = ' . $_SESSION['steamid'];

  $result = mysqli_query($conn, $query);

  if (mysqli_num_rows($result) > 0) {
    $match = mysqli_fetch_row($result);
  } else {
    return "Error: User profile corrupt or user does not exist!";
  }
  return $match;
}

function update_player_steamdata($steamID64)
{
  global $conn, $steamapikey;

  unset($_SESSION['steam_uptodate']);
  include 'steamauth/userInfo.php';

  $query = 'UPDATE user
            SET name="' . $_SESSION['steam_personaname'] . '", avatar="' . $_SESSION['steam_avatar'] . '"
            WHERE steamID64 = "' . $steamID64 . '"';

  $result = mysqli_query($conn, $query);
  if (mysqli_error($conn)) {
    echo "Could not update user's details.";
    exit;
  }
}

function check_steam_update_timeout()
{
  global $steam_updatetimeout;

  if (isset($_SESSION['last_steam_update']) && (time() - $_SESSION['last_steam_update'] < $steam_updatetimeout)) {
    // Still in Timeout
    return true;
  } else {
    // Has been long enough
    return false;
  }
}



// INDEX PAGE
if ($page == "index") { // index/landing page is open
  $dates = get_dates();
  $gamestate = get_gamestate($dates);
}

// SECURE PAGE
if ($page == "secure") { // secure page is open

  if (isset($_SESSION['steamid'])) { // user is signed into Steam
    include 'steamauth/userInfo.php';

    // Check if user is in the database. If not, register them.
    if (!check_registered()) {
      $query = 'INSERT INTO user (steamID64, name, avatar, is_active, is_in_group)
                VALUES (' . $_SESSION['steamid'] . ', "' . $steamprofile['personaname'] . '", "' . $steamprofile['avatar'] . '", 0, 0)';

      $result = mysqli_query($conn, $query);

      if (!$result) {
        echo "Could not register user.";
        exit;
      }
    }

    if (check_is_in_group()) {
      $secure_level = 2; // User is signed into Steam and part of the correct Steam Group

    } elseif (check_steamgroup_xml($steamgroupid)) { // check if user is in group via XML
      $query = 'UPDATE user
                SET is_in_group=1
                WHERE steamID64 = "' . $_SESSION['steamid'] . '"';

      $result = mysqli_query($conn, $query);

      if (!$result) {
        echo "Could not update user group.";
        exit;
      }

      $secure_level = 2;

    } else {
      $secure_level = 1; // User is signed into Steam but not in the correct Steam Group
      session_unset(); // Automatically sign out user if they cannot participate
      session_destroy();
    }
  } else {
    $secure_level = 0; // User is not signed into Steam
  }



  if ($secure_level == 2) {
    $dates = get_dates();
    $gamestate = get_gamestate($dates); // Valid Gamestates: 0 - Registration; 1 - Prepare Gifts; 2 - Distribute Gifts; 3 - Game Ended

    if (isset($_GET['update_steamdata'])) { // Handle steam profile update link
      if (!check_steam_update_timeout()) {
        update_player_steamdata($_SESSION['steamid']);
        $_SESSION['last_steam_update'] = time();
        redirect("./?page=secure");
      }
    }

    $participants = get_participants(); // get participants AFTER updating local player
    $is_active = check_is_active();

    if (isset($_POST['participate'])) { // Handle participation button

      if ($gamestate > 0) {
        echo "You can no longer participate.";
        exit();
      }

      if ($is_active) {
        user_set_active(false, $_SESSION['steamid']);
      } else {
        user_set_active(true, $_SESSION['steamid']);
      }
      redirect();
    }

    switch ($gamestate) {
      case 0: // Registration
        # ...
        break;

      case 1: // Prepare Gifts
        if (!get_players_matched()) {
          match_players($allow_pairs, $max_pair_chance);
        }
        $match = get_match();
        break;

      case 2: // Distribute Gifts
        if (!get_players_matched()) {
          match_players($allow_pairs, $max_pair_chance);
        }
        $match = get_match();
        break;

      case 3: // Game Ended
        # ...
        break;
    }
  }
}