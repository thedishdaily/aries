<?php get_header(); ?>
<div class="aries-body">
	<div class="container">
		<div class="aries-features">
			<div class="row">
				<div class="col-xs-8">
					<? $homepage_options = get_option('home_page_options');
					$post = get_post($homepage_options['mainfeature']); ?>
					<a href="<? echo get_permalink($post->ID); ?>">
					<div class="aries-main">
						<? echo get_the_post_thumbnail($post->ID); ?>
						<div class="aries-main-featured">FEATURED</div>
						<div class="aries-main-title"><? echo $post->post_title; ?></div>
					</div>
					</a>
				</div>
				<div class="col-xs-4">
					<div class="aries-sidebar">
						<?
						foreach ($homepage_options['frontposts'] as $frontpost_id) { 
						$featured = get_post($frontpost_id);
						?>
						<div class="aries-sidebar-item">
							<a href="<? echo get_permalink($featured->ID); ?>">
							<div class="aries-sidebar-item-title"><? echo $featured->post_title; ?></div>
							<?php
							$thumb = wp_get_attachment_image_src( get_post_thumbnail_id($featured->ID), 'thumbnail' );
							$url = $thumb['0'];
							?>
							<div class="aries-sidebar-item-thumbnail" style="background-image: url('<? echo $url; ?>');">
							</div>
							</a>
						</div>
						<? } ?>
					</div>
				</div>
			</div>
		</div>
		<div class="aries-trending">
			Trending: 
			<ul>
				<?php 
				$tags = wp_tag_cloud('smallest=10&largest=10&format=array&number=8&orderby=count'); 
				foreach ($tags as $tag) { ?>
				<li><? echo $tag; ?></li>
				<? } ?>
			</ul>
		</div>
		<div class="row">
			<div class="col-xs-9">
				<div class="aries-secondary-features">
					<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
					<div class="aries-secondary-feature">
						<?php $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'single-post-thumbnail' ); ?>
						<a href="<?php the_permalink() ?>" rel="bookmark"><div class="aries-secondary-feature-title"><?php the_title(); ?></div></a>
						<? if ($image[0] == null) { ?>
							<div class="aries-secondary-feature-image" style="background-image: url('<? bloginfo('template_directory');?>/images/placeholder.png');"></div>
						<? } else { ?>
							<div class="aries-secondary-feature-image" style="background-image: url('<? echo $image[0]; ?>');"></div>
						<? } ?>
						<div class="aries-secondary-feature-subtitle"><?php the_subtitle(); ?></div>
					</div>
					<?php endwhile; ?>
					<? else: ?>
					<?php _e('Sorry, no posts matched your criteria.'); ?></p><?php endif; ?>
				</div>
			</div>
			<div class="col-xs-3">
				<div id="aries-sidebar-1">
				<?php if ( dynamic_sidebar('Home right sidebar') ) : else : endif; ?>
				</div>
				<div class="fb-like-box" data-href="https://www.facebook.com/TheDishDaily" data-height="320" data-colorscheme="light" data-show-faces="true" data-header="true" data-stream="false" data-show-border="true"></div>
			</div>
		</div>
		<? if (have_posts()) { ?>
			<div class="aries-secondary-showmore"><?php next_posts_link( 'Older stories' ); ?></div>
		<? } ?>
	</div>
</div>
<script src="<? bloginfo('template_directory');?>/js/masonry.min.js"></script>
<script>
var container = document.querySelector('.aries-secondary-features');
console.log(container.offsetWidth);
var msnry = new Masonry( container, {
  // options
  columnWidth: (container.offsetWidth - 30) / 3,
  gutter: 10,
  itemSelector: '.aries-secondary-feature'
});
</script>
<?php get_footer(); ?>