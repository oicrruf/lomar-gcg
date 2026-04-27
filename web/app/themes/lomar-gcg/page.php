<?php  ?>
<?php get_template_part( 'template-parts/header' ); ?>

<section class="section page-content" aria-labelledby="page-title">
  <div class="container" style="max-width: 860px;">
    <?php while ( have_posts() ) : the_post(); ?>
      <h1 id="page-title" class="fade-in"><?php the_title(); ?></h1>
      <div class="page-body fade-in" style="margin-top: var(--sp-6); color: var(--ink-2); font-size: var(--fs-md); line-height: 1.7;">
        <?php the_content(); ?>
      </div>
    <?php endwhile; ?>
  </div>
</section>

<?php get_template_part( 'template-parts/footer' ); ?>
