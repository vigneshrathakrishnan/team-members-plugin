<?php
/**
 * Template for single Team Member
 */

if (!defined('ABSPATH')) {
    exit;
}

get_header();

while (have_posts()) :
    the_post();

    $role = get_post_meta(get_the_ID(), '_ts_role', true);
    $short_bio = get_post_meta(get_the_ID(), '_ts_short_bio', true);
?>

<main class="team-member-wrapper">

    <article <?php post_class('team-member-card'); ?>>

        <header class="team-member-header">
            <h1 class="team-member-name"><?php the_title(); ?></h1>

            <?php if ($role) : ?>
                <p class="team-member-role">
                    <?php echo esc_html($role); ?>
                </p>
            <?php endif; ?>
        </header>

        <?php if (has_post_thumbnail()) : ?>
            <div class="team-member-image">
                <?php the_post_thumbnail('large'); ?>
            </div>
        <?php endif; ?>

        <section class="team-member-bio">

            <?php if ($short_bio) : ?>
                <p class="team-member-short-bio">
                    <?php echo esc_html($short_bio); ?>
                </p>
            <?php endif; ?>

            <div class="team-member-full-bio" id="full-bio">
                <?php the_content(); ?>
            </div>

            <button class="toggle-bio-btn" id="toggleBio">
                Read More
            </button>

        </section>

    </article>

</main>

<?php
endwhile;

get_footer();