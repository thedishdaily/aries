<div class="aries-body <? echo implode(" ",get_post_class()); ?>">
	<div class="container">
		<div class="row">
			<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
			<div class="col-xs-2">
				<div class="aries-post-authorbar">
					<div class="aries-post-avatar"><?php echo get_avatar($post->post_author, 110); ?></div>
					<div class="aries-post-author"><?php the_author_posts_link() ?></div>
					<div class="aries-post-publishdate"><? the_time('F j, Y'); ?></div>
				</div>
			</div>
			<div class="col-xs-8">
				<div class="aries-post <?php if(is_home() && $post==$posts[0] && !is_paged()) echo ' firstpost';?>">
					<div class="aries-post-title"><? the_title(); ?></div>
					<div class="aries-post-subtitle"><? the_subtitle(); ?></div>
					<?php if (has_post_thumbnail( $post->ID ) ): ?>
					<?php $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'single-post-thumbnail' ); ?>
					<div class="aries-post-image" style="background-image: url('<? echo $image[0]; ?>');"></div>
					<?php endif; ?>
					<div class="aries-post-content"><?php the_content(__('Read more'));?></div>
					<div class="aries-post-readmore">
					<div class="aries-post-readmore-title">More from the Dish Daily</div>
					<?
						$featuredargs = array( 'posts_per_page' => 3, 'order'=> 'DESC', 'orderby' => 'rand' );
						$featuredlist = get_posts( $featuredargs );
						foreach ($featuredlist as $featured) { ?>
						<div class="aries-post-readmore-item">
							<a href="<? echo get_permalink($featured->ID); ?>">
							<?php
							$thumb = wp_get_attachment_image_src( get_post_thumbnail_id($featured->ID), 'thumbnail' );
							$url = $thumb['0'];
							?>
							<? if ($url == null) { ?>
								<div class="aries-post-readmore-item-thumbnail" style="background-image: url('<? bloginfo('template_directory');?>/images/placeholder.png');"></div>
							<? } else { ?> 
								<div class="aries-post-readmore-item-thumbnail" style="background-image: url('<? echo $url; ?>');"></div>
							<? } ?>
							<div class="aries-post-readmore-item-title"><? echo $featured->post_title; ?></div>
							</a>
						</div>
					<? } ?>	
					</div>
					<div class="aries-comments">
					<?php comments_template(); ?>
					</div>
				</div> <!-- aries-post -->
			</div>
			<div class="col-xs-2">
				<!--
				<div class="aries-post-relatedbar">
					<?
						$featuredargs = array( 'posts_per_page' => 3, 'order'=> 'DESC', 'orderby' => 'date' );
						$featuredlist = get_posts( $featuredargs );
						foreach ($featuredlist as $featured) { ?>
						<div class="aries-relatedbar-item">
							<a href="<? echo get_permalink($featured->ID); ?>">
							<?php
							$thumb = wp_get_attachment_image_src( get_post_thumbnail_id($featured->ID), 'thumbnail' );
							$url = $thumb['0'];
							?>
							<div class="aries-relatedbar-item-thumbnail" style="background-image: url('<? echo $url; ?>');"></div>
							<div class="aries-relatedbar-item-title"><? echo $featured->post_title; ?></div>
							</a>
						</div>
					<? } ?>
				</div>
				-->
			</div>
			<?php endwhile; else: ?>
			<p> <?php _e('Sorry, no posts matched your criteria.'); ?> </p>
			<?php endif; ?>
		</div>
	</div>
</div>
