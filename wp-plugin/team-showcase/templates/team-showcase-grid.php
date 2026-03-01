<div class="ts-grid">
<?php while ($query->have_posts()) : $query->the_post(); ?>
    <div class="ts-card">
        <div class="ts-image">
            <?php if (has_post_thumbnail()) {
                the_post_thumbnail('medium');
            } ?>
        </div>
        <h3><?php the_title(); ?></h3>
        <p class="ts-role">
            <?php echo esc_html(get_post_meta(get_the_ID(), '_ts_role', true)); ?>
        </p>
        <div class="ts-bio">
            <?php echo esc_html(get_post_meta(get_the_ID(), '_ts_short_bio', true)); ?>
        </div>
    </div>
<?php endwhile; ?>
</div>