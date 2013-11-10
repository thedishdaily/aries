<?

add_theme_support( 'post-thumbnails' ); 
add_theme_support( 'post-formats' );
add_theme_support( 'menus' );
add_filter('show_admin_bar', '__return_false');

function theme_front_page_settings() {  
?>

<div class="wrap">
	<? screen_icon('themes'); ?><h2>Front Page</h2>
	<? if (isset($_POST['update_settings'])) {
		update_option('main_feature_id', $_POST['main_feature_id']);	
	?>
    <div id="message" class="updated"><p>Settings saved</p></div>  
	<? } ?>

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

		<? submit_button(); ?>

	</form>
</div>

<? } ?>
<?

function setup_theme_admin_menus() {  
    add_submenu_page('themes.php',   
        'Front Page Elements', 'Front Page', 'manage_options',   
        'front-page-elements', 'theme_front_page_settings');   
}

add_action("admin_menu", "setup_theme_admin_menus"); 

?>
