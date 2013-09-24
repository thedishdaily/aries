<?php get_header(); ?>
<div class="aries-body">
	<div class="container">
		<div class="aries-features">
			<div class="row">
				<div class="col-xs-8">
					<? $post = get_post(get_option('main_feature_id')); ?>
					<a href="<? echo $post->post_url; ?>">
					<div class="aries-main">
						<? echo get_the_post_thumbnail($post->ID); ?>
						<div class="aries-main-featured">FEATURED</div>
						<div class="aries-main-title"><? echo $post->post_title; ?></div>
					</div>
					</a>
				</div>
				<div class="col-xs-4">
					<div class="aries-sidebar">
						<div class="aries-sidebar-item">
							<div class="aries-sidebar-item-title">Draper Business Plan Competition Comes to Smith</div>
							<img src="http://placehold.it/80x80" />
						</div>
						<div class="aries-sidebar-item">
							<div class="aries-sidebar-item-title">Draper Business Plan Competition Comes to Smith</div>
							<img src="http://placehold.it/80x80" />
						</div>
						<div class="aries-sidebar-item">
							<div class="aries-sidebar-item-title">Draper Business Plan Competition Comes to Smith</div>
							<img src="http://placehold.it/80x80" />
						</div>
						<div class="aries-sidebar-item">
							<div class="aries-sidebar-item-title">Draper Business Plan Competition Comes to Smith</div>
							<img src="http://placehold.it/80x80" />
						</div>
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
			<a href="<?php the_permalink() ?>" rel="bookmark">
			<div class="aries-secondary-feature">
				<?php $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'single-post-thumbnail' ); ?>
				<div class="aries-secondary-feature-image"><img src="<? echo $image[0]; ?>" /></div>
				<div class="aries-secondary-feature-title"><?php the_title(); ?></div>
			</div>
			</a>
			<?php endwhile; else: ?>
			<?php _e('Sorry, no posts matched your criteria.'); ?></p><?php endif; ?>
		</div>
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