<?php
if (have_posts()) {
    ?>
    <div class="container px-4 mb-20 mx-auto">
        <?php
        while (have_posts()) {
            the_post();
            ?>
            <div class="py-4">
                <p><?php the_title() ?></p>
                <img loading="lazy" src="<?php get_the_post_thumbnail_url() ?>" alt="">
                <p><?php the_content() ?></p>
                <p><?php the_permalink() ?></p>
            </div>
            <?php
        }
        ?>
        <div class="py-4">
            <?php
            echo paginate_links(['prev_text' => '<', 'next_text' => '>']);
            ?>
        </div>
        <div class="py-4">
            <?php
            global $wp_query;
            echo paginate_links([
                'base'         => str_replace(999999999, '%#%', esc_url(get_pagenum_link(999999999))),
                'total'        => $wp_query->max_num_pages,
                'current'      => max(1, get_query_var('paged')),
                'format'       => '?paged=%#%',
                'show_all'     => false,
                'type'         => 'plain',
                'end_size'     => 2,
                'mid_size'     => 1,
                'prev_next'    => true,
                'prev_text'    => '<',
                'next_text'    => '>',
                'add_args'     => false,
                'add_fragment' => '',
            ])
            ?>
        </div>
    </div>
    <?php
}
?>
