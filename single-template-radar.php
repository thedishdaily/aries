<div class="aries-body aries-radar">
	<div class="container">
		<div class="row">
			<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
			<div class="col-xs-2">
				<div class="aries-post-authorbar aries-radar-authorbar">
					<div class="aries-post-avatar"><?php echo get_avatar($post->post_author, 110); ?></div>
					<div class="aries-post-author"><?php the_author_posts_link() ?></div>
					<div class="aries-post-publishdate"><? the_time('F jS, Y'); ?></div>
				</div>
			</div>
			<div class="col-xs-8">
				<div class="aries-post aries-radar-post <?php if(is_home() && $post==$posts[0] && !is_paged()) echo ' firstpost';?>">
					<?php if (has_post_thumbnail( $post->ID ) ): ?>
					<?php $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'single-post-thumbnail' ); ?>
					<div class="aries-post-image"><img src="<? echo $image[0]; ?>" /></div>
					<?php endif; ?>
					<div class="aries-post-title">On The Radar: <? the_title(); ?></div>
					<div class="aries-post-content"><?php the_content(__('Read more'));?></div>
				</div> <!-- aries-post -->
			</div>
			<div class="col-xs-2">
				<div class="aries-post-relatedbar aries-radar-relatedbar">
					Related stories
				</div>
			</div>
			<?php endwhile; else: ?>
			<p> <?php _e('Sorry, no posts matched your criteria.'); ?> </p>
			<?php endif; ?>
		</div>
	</div>
</div>
