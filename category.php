<?php get_header(); ?>
<div class="aries-body">
	<div class="container">
		<div class="row">
			<div class="col-xs-3">
				<div class="aries-listing-info">
					<div class="aries-listing-title"><?php echo ucfirst(single_cat_title('', false)); ?></div>
					<div class="aries-listing-description"><? echo category_description(); ?></div>
				</div>
			</div>
			<div class="col-xs-9">
				<div class="aries-listing-stories">
				<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
				<div class="aries-listing-story">
				<a href="<?php the_permalink() ?>" rel="bookmark">
					<?php $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'single-post-thumbnail' ); ?>
					<div class="aries-listing-story-image" style="background-image: url('<? echo $image[0]; ?>');"></div>
					<div class="aries-listing-story-title"><?php the_title(); ?></div>
				</div>
				</a>
				<?php endwhile; else: ?>
				<?php _e('Sorry, no posts matched your criteria.'); ?></p><?php endif; ?>
				</div>
			</div>
		</div>
	</div>
</div>
<?php get_footer(); ?>
