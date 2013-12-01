<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>" />
    <title><?php bloginfo('name'); ?> | <?php is_home() ? bloginfo('description') : wp_title(''); ?></title>
    <link rel="profile" href="http://gmpg.org/xfn/11" />
    <link href="//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css" rel="stylesheet">
    <link rel="stylesheet" href="<? bloginfo('template_directory');?>/css/bootstrap.min.css" />        
    <link rel="stylesheet" href="<?php echo get_stylesheet_uri(); ?>" type="text/css" media="screen" />
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
    <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
    <?php if ( is_singular() && get_option( 'thread_comments' ) ) wp_enqueue_script( 'comment-reply' ); ?>
    <?php wp_head(); ?>
</head>
<header class="navbar navbar-inverse navbar-fixed-top aries-navbar">
    <div class="container">
        <div class="aries-navbar-logo"><a href="<? echo home_url(); ?>"><img src="<? bloginfo('template_directory');?>/images/logo.png" /></a></div>
        <div class="aries-navbar-items">
            <?php wp_nav_menu(); ?>
        </div>
        <div class="aries-navbar-right">
            <form role="search" method="get" id="searchform" action="<? echo home_url(); ?>">
                <input type="text" name="s" placeholder="Search..." />
            </form>
        </div>
    </div>
</header>
<body>
<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_US/all.js#xfbml=1&appId=522539724475340";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>
<div id="wrap">
