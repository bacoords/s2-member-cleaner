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

$max_users = $this->max_users;
$timeline = $this->timeline;

$args = array(
  'role' => 'subscriber',
  'number' => $max_users,
  'fields' => 'ID',
  'date_query'    => array(
     array(
         'before'     => $timeline,
         'inclusive' => true,
     ),
  ),
);
$user_query = new WP_User_Query($args);


// Get/Set cron task jobs
$s2mc_schedule_cron_orig = get_option('s2mc_schedule_cron');

if( isset( $_POST['s2mc_schedule_cron'] ) ){
  update_option('s2mc_schedule_cron', $_POST['s2mc_schedule_cron'] );
}
$s2mc_schedule_cron = get_option('s2mc_schedule_cron');

if($s2mc_schedule_cron_orig !== $s2mc_schedule_cron ){
  // Remove current cron job
  wp_clear_scheduled_hook( 's2_member_cleaner_schedule' );
  if( $s2mc_schedule_cron != 'off' ) {
    wp_schedule_event( time(), $s2mc_schedule_cron, 's2_member_cleaner_schedule', array() );
    echo "<div class='notice notice-success is-dismissible'><p><strong>Updated!</strong> S2 Member Cleaner is <strong>currently scheduled $s2mc_schedule_cron</strong>.</p></div>";
  } else {
    echo "<div class='notice notice-success is-dismissible'><p><strong>Updated!</strong> S2 Member Cleaner is <strong>not currently scheduled</strong>.</p></div>";
  }
}

?>

<div id="s2mc-loading">
  <div class="s2mc-spinner">
    <div class="rect1"></div>
    <div class="rect2"></div>
    <div class="rect3"></div>
    <div class="rect4"></div>
    <div class="rect5"></div>
  </div>
</div>

<div class="wrap">
  <h2>S2 Member Cleaner</h2>
  <div id="poststuff">

    <form class="" action="" method="post">

      <div class="postbox">
        <h2>
          <span>
            Settings
          </span>
        </h2>

        <div class="inside">
          <label for="s2mc_schedule_cron">Check for expired users and delete:</label>
          <select name="s2mc_schedule_cron" id="s2mc_schedule_cron">
            <option value="off" <?php if($s2mc_schedule_cron == 'off') echo 'selected'; ?>>Manual Only</option>
            <option value="hourly" <?php if($s2mc_schedule_cron == 'hourly') echo 'selected'; ?>>Hourly</option>
            <option value="daily" <?php if($s2mc_schedule_cron == 'daily') echo 'selected'; ?>>Daily</option>
            <option value="twicedaily" <?php if($s2mc_schedule_cron == 'twicedaily') echo 'selected'; ?>>Twice Daily</option>
          </select>
        </div>

        <div class="inside s2mc-footer">
          <input type="submit" class="button button-primary" value="Save Changes">
        </div>

      </div>


      <div class="postbox">
        <h2>
          <span>
            Manual Delete
          </span>
        </h2>

        <div class="inside">
          <p>Here's a list of free users who haven't logged in since <?php echo date("F j Y", strtotime($timeline)); ?> (max <?php echo $max_users; ?>).</p>
          <div class="s2mc-users-list">
            <ol>
              <?php if ( ! empty( $user_query->get_results() ) ) {
              	foreach ( $user_query->get_results() as $user ) {
                  if( s2member_last_login_time($user) <= strtotime($timeline) ){
                    $echo =  "<li><a href='". get_edit_user_link( $user ) . "'>User ID: $user</a>, Role: ". get_user_field ("s2member_access_role", $user) .", level ". get_user_field ("s2member_access_level", $user) .", created their account on " . date("F j, Y", s2member_registration_time($user) );
                    $last_login = date("F j, Y", s2member_last_login_time($user) );
                    if( $last_login == 0 ){
                      $echo .= " and never logged in.</li>";
                    } else {
                      $echo .= " and last logged in on $last_login.</li>";
                    }
                    echo $echo;
                  }
              	}
              } else {
              	echo 'No users found.';
              } ?>
            </ol>
          </div>
        </div>

        <div class="inside s2mc-footer">
          <input type="hidden" name="s2mc-delete-batch-ajax-nonce" id="s2mc-delete-batch-ajax-nonce" value="<?php echo wp_create_nonce( 's2mc-delete-batch-ajax-nonce' ); ?>" />
          <a href="#" id="s2mc-delete-batch-btn" class="button button-secondary">Delete a batch now.</a>
        </div>

      </div>


    </form>
  </div>
</div>
