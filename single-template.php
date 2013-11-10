<div class="aries-body <? echo implode(" ",get_post_class()); ?>">
	<div class="container">
		<div class="row">
			<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
			<div class="col-xs-2">
				<div class="aries-post-authorbar">
					<div class="aries-post-avatar"><?php echo get_avatar($post->post_author, 110); ?></div>
					<div class="aries-post-author"><?php the_author_posts_link() ?></div>
					<div class="aries-post-publishdate"><? the_time('F jS, Y'); ?></div>
				</div>
			</div>
			<div class="col-xs-8">
				<div class="aries-post <?php if(is_home() && $post==$posts[0] && !is_paged()) echo ' firstpost';?>">
					<div class="aries-post-title"><? the_title(); ?></div>
					<div class="aries-post-subtitle"><? the_subtitle(); ?></div>
					<?php if (has_post_thumbnail( $post->ID ) ): ?>
					<?php $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'single-post-thumbnail' ); ?>
					<div class="aries-post-image"><img src="<? echo $image[0]; ?>" /></div>
					<?php endif; ?>
					<div class="aries-post-content"><?php the_content(__('Read more'));?></div>
				</div> <!-- aries-post -->
			</div>
			<div class="col-xs-2">
				<div class="aries-post-relatedbar">
					Related stories
				</div>
			</div>
			<?php endwhile; else: ?>
			<p> <?php _e('Sorry, no posts matched your criteria.'); ?> </p>
			<?php endif; ?>
		</div>
	</div>
</div>
