<?php

/**
 * Provide a admin area view for the plugin
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @link       https://briancoords.com
 * @since      1.0.0
 *
 * @package    S2_Member_Cleaner
 * @subpackage S2_Member_Cleaner/admin/partials
 */
$args = array(
  'role' => 'subscriber',
  'number' => 1000,
  'date_query'    => array(
   array(
       'before'     => '-6 months',
       'inclusive' => true,
   ),
),
);
$user_query = new WP_User_Query($args);

?>

<!-- This file should primarily consist of HTML with a little bit of PHP. -->
<div class="wrap">
  <h2>S2 Member Cleaner</h2>
  <div id="poststuff">


    <div class="postbox">
      <h2>
        <span>
          Users Test 1
        </span>
      </h2>
      <div class="inside">
        <p>Here's a list of free users who haven't logged in in 6+ months (max 1000).</p>
        <ol>
          <?php if ( ! empty( $user_query->get_results() ) ) {
          	foreach ( $user_query->get_results() as $user ) {
              if( s2member_last_login_time($user->ID) <= strtotime('-6 months') ){
                echo "<li><a href='". get_edit_user_link( $user->ID ) . "'>$user->display_name</a>, Role: ". get_user_field ("s2member_access_role", $user->ID) .", level ". get_user_field ("s2member_access_level", $user->ID) .", created their account on " . date("F j, Y", s2member_registration_time($user->ID) ) . " and last logged in on " . date("F j, Y", s2member_last_login_time($user->ID) ) ."</li>";
              }
          	}
          } else {
          	echo 'No users found.';
          } ?>
        </ol>
      </div>
    </div>


  </div>
</div>
