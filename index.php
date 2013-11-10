<?php get_header(); ?>
<div class="aries-body">
	<div class="container">
		<div class="aries-features">
			<div class="row">
				<div class="col-xs-8">
					<? $post = get_post(get_option('main_feature_id')); ?>
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
						$featuredargs = array( 'posts_per_page' => 5, 'order'=> 'DESC', 'orderby' => 'date' );
						$featuredlist = get_posts( $featuredargs );
						foreach ($featuredlist as $featured) { ?>
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
				<li>StartX</li>
				<li>TEDxStanford</li>
				<li>Google Glass</li>
				<li>BASES</li>
			</ul>
		</div>
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
		<? if (have_posts()) { ?>
			<div class="aries-secondary-showmore"><a href="#">Show more stories</a></div>
		<? } ?>
	</div>
</div>
<script src="<? bloginfo('template_directory');?>/js/masonry.min.js"></script>
<script>
var container = document.querySelector('.aries-secondary-features');
console.log(container.offsetWidth);
var msnry = new Masonry( container, {
  // options
  columnWidth: (container.offsetWidth - 80) / 4,
  gutter: 24,
  itemSelector: '.aries-secondary-feature'
});
</script>
<?php get_footer(); ?>