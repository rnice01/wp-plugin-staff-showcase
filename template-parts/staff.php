<?php
defined('ABSPATH') or die();
?>

<?php if ($staff->have_posts()) : ?>
    <?php while($staff->have_posts()) : $staff->the_post(); ?>
        <div>
            <img src="<?php echo get_the_post_thumbnail_url($staff->post->ID) ?>" />
            <h1><?php echo get_post_meta($staff->post->ID, 'name', true); ?></h1>
        </div>
    <?php endwhile; ?>
<?php endif; ?>
