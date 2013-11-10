<?php
add_theme_support('post-thumbnails');
add_theme_support('post-formats');
add_theme_support('menus');
add_filter('show_admin_bar', '__return_false');

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
    if (isset($_POST['frontpost_on_page']) || isset($_POST['frontpost'])) {
        $option_value = array(
            'on_page' => (int) $_POST['frontpost_on_page'],
            'frontposts' => $_POST['frontpost']
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
                    alert('max 5 posts');
                    return false;
                }
            });
        });
    </script>
    <div class="icon32 icon32-posts-post" id="icon-edit"><br></div>
    <h2>Home page options</h2>
    <h4>Show posts on home page</h4>
    <form action="" method="POST">
        <div class="frontpost-wrapp">
            <ul>
                <?php
                $fivesdrafts = $wpdb->get_results("SELECT * FROM `" . $wpdb->prefix . "posts` WHERE `post_type`='post' AND `post_status`='publish' ORDER BY `post_date` DESC");
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
            <label>Posts on home page: <input type="text" name="frontpost_on_page" value="<?php echo $home_page_options["on_page"]; ?>"> </label>
        </p>
        <p>
            <input type="submit" value="Save" class="button button-primary button-large">
        </p>
    </form>
    <?php
}
?>
