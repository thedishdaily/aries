<?php get_header(); ?>
<?php 
$curauth = (isset($_GET['author_name'])) ? get_user_by('slug', $author_name) : get_userdata(intval($author));
?>
<div class="aries-body">
	<div class="container">
		<div class="row">
			<div class="col-xs-3">
				<div class="aries-author-info">
					<? echo get_avatar($curauth->ID, 300); ?>
					<div class="aries-author-info-firstname"><? echo $curauth->first_name;?></div>
					<div class="aries-author-info-lastname"><? echo $curauth->last_name; ?></div>
					<div class="aries-author-info-biography"><? echo get_the_author_meta('description', $curauth->id); ?></div>
				</div>
			</div>
			<div class="col-xs-9">
				<div class="aries-author-stories">
				<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
				<div class="aries-author-story">
				<a href="<?php the_permalink() ?>" rel="bookmark">
					<?php $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'single-post-thumbnail' ); ?>
					<div class="aries-author-story-image"><img src="<? echo $image[0]; ?>" /></div>
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
