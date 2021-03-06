<?php
add_theme_support('post-thumbnails');
add_theme_support('post-formats');
add_theme_support('menus');
add_filter('show_admin_bar', '__return_false');

function arphabet_widgets_init() {
    register_sidebar( array(
        'name' => 'Home right sidebar',
        'id' => 'aries-sidebar-1',
        'before_widget' => '<div>',
        'after_widget' => '</div>',
        'before_title' => '<div class="aries-widget-title">',
        'after_title' => '</div>',
    ) );
}
add_action( 'widgets_init', 'arphabet_widgets_init' );

/**
 * Retrieves social counts from a variety of social networks
 * TODO: Extract into a standalone plugin
 */
function retrieve_social_counts() {

    // Gets the number of likes for a URL on Facebook
    $fbUrl = 'https://www.facebook.com/TheDishDaily';
    $fbJson = file_get_contents('http://graph.facebook.com/?ids=' . $fbUrl);
    $fbObj = json_decode($fbJson);
    $fbLikes = $fbObj->$fbUrl->likes;

}

/**
 * Creates a setting menu for the frong page
 */
function theme_front_page_settings() {
    ?>

    <div class="wrap">
        <?php screen_icon('themes'); ?><h2>Front Page</h2>
        <?php
        if (isset($_POST['update_settings'])) {
            update_option('main_feature_id', $_POST['main_feature_id']);
            ?>
            <div id="message" class="updated"><p>Settings saved</p></div>  
        <?php } ?>

        <form method="POST" action="">

            <?php $posts = get_posts(); ?>  

            <label for="main_feature_id">Main Feature</label>  
            <select name="main_feature_id">  
                <?php foreach ($posts as $post) : ?>  
                    <option value="<?php echo $post->ID; ?>">  
                        <?php echo $post->post_title; ?>  
                    </option>  
                <?php endforeach; ?>  
            </select>
            <input type="hidden" name="update_settings" value="Y" />

            <?php submit_button(); ?>

        </form>
    </div>

<?php } ?>
<?php

function setup_theme_admin_menus() {
    add_submenu_page('themes.php', 'Front Page Elements', 'Front Page', 'manage_options', 'front-page-elements', 'theme_front_page_settings');
}

add_action("admin_menu", "setup_theme_admin_menus");

add_action('admin_menu', 'register_home_page_options');

function register_home_page_options() {
    add_menu_page('Home page options', 'Home page', 'manage_options', 'custompage', 'custom_menu_home_page_options', plugins_url('myplugin/images/icon.png'), 99);
}

function custom_menu_home_page_options() {
    global $wpdb;
    if (isset($_POST['frontpost'])) {
        $option_value = array(
            'frontposts' => $_POST['frontpost'],
            'mainfeature' => $_POST['mainfeature']
        );
        if (get_option('home_page_options') !== false) {
            update_option('home_page_options', $option_value);
        } else {
            add_option('home_page_options', $option_value);
        }
    }
    $home_page_options = get_option('home_page_options');
    ?>
    <style>
        .frontpost-wrapp{
            height: 300px;
            overflow-y: scroll;
        }
    </style>
    <script>
        jQuery(document).ready(function($) {
            $('.checkbox-frontpost').click(function() {
                if(jQuery(".checkbox-frontpost:checked").length > 5){
                    alert('Only five posts can be selected as secondary features');
                    return false;
                }
            });
        });
    </script>
    <div class="icon32 icon32-posts-post" id="icon-edit"><br></div>
    <h2>Home page options</h2>
    <form action="" method="POST">
        <h3>Main Feature</h3>
        <div class="mainfeature-wrap">
            <select name="mainfeature">
            <?php
            $fivesdrafts = $wpdb->get_results("SELECT * FROM `" . $wpdb->prefix . "posts` WHERE `post_type`='post' AND `post_status`='publish' ORDER BY `post_date` DESC");
            if ($fivesdrafts) {
                foreach ($fivesdrafts as $post) {
                    ?>
                    <option value="<? echo $post->ID; ?>"<? if ($post->ID == $home_page_options['mainfeature']) echo ' selected'; ?>><? echo $post->post_title; ?></option>
                <? }
            } ?>
            </select>
        </div>
        <h3>Secondary Features</h3>
        <div class="frontpost-wrapp">
            <ul>
                <?php
                if ($fivesdrafts) {
                    foreach ($fivesdrafts as $post) {
                        ?>
                        <li>
                            <label><input <?php
                        if ($home_page_options["frontposts"] !== null) {
                            if (in_array($post->ID, $home_page_options["frontposts"])) {
                                echo ' checked="checked" ';
                            }
                        }
                        ?> type="checkbox" class="checkbox-frontpost" name="frontpost[]" value="<?php echo $post->ID; ?>"> <?php echo $post->post_title; ?></label>
                        </li>
                        <?php
                    }
                }
                ?>
            </ul>
        </div>  
        <p>
            <input type="submit" value="Save" class="button button-primary button-large">
        </p>
    </form>
    <?php
}
?>