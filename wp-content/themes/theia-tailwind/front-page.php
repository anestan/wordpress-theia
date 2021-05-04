<?php get_header(); ?>
<!-- backup old tailwind jit configs + update tailwind jit -->
<!-- import/export posts to excel - https://artisansweb.net/export-posts-csv-wordpress/ https://www.sitepoint.com/wordpress-headless-cms-eleventy/ -->
<!-- vue apollo - https://apollo.vuejs.org/ -->
<?php get_template_part( 'template-parts/content', 'header-menu' ); ?>
<?php get_template_part( 'template-parts/content', 'videos' ); ?>
<?php get_template_part( 'template-parts/content', 'posts' ); ?>
<?php get_template_part( 'template-parts/content', 'footer-menu' ); ?>
<?php get_footer(); ?>
