<?php get_header();

if (has_term('On The Radar', 'category', $post)) {
  // use template file single-template-radar.php
  get_template_part('single-template', 'radar');
} else {
  // use default template file single-template.php
  get_template_part('single-template');
}

get_footer(); ?>