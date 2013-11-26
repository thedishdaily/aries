<?php get_header(); ?>
<?php 
$curauth = (isset($_GET['author_name'])) ? get_user_by('slug', $author_name) : get_userdata(intval($author));
?>
<div class="aries-body">
	<div class="container">
		<div class="row">
			<div class="col-xs-3">
				<div class="aries-category-info">
					<div class="aries-category-title"><? echo $curauth->first_name;?></div>
					<div class="aries-category-description"><? echo category_description(); ?></div>
				</div>
			</div>
			<div class="col-xs-9">
				<div class="aries-author-stories">
				<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
				<div class="aries-author-story">
				<a href="<?php the_permalink() ?>" rel="bookmark">
					<?php $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'single-post-thumbnail' ); ?>
					<div class="aries-author-story-image" style="background-image: url('<? echo $image[0]; ?>');"></div>
					<div class="aries-author-story-title"><?php the_title(); ?></div>
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
