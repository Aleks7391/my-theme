<?php
get_header();

$description = get_the_archive_description();
?>

<?php 

$args = array(
	'post_type'      => 'student',
	'posts_per_page' => 3,
	'paged'          => ( get_query_var('paged') ? get_query_var('paged') : 1 ),
);
$query = new WP_Query( $args );

if ( $query->have_posts() ) : ?>

	<header class="page-header alignwide">
		<?php the_archive_title( '<h1 class="page-title">', '</h1>' );
		if ( $description ) : ?>
			<div class="archive-description"><?php echo wp_kses_post( wpautop( $description ) ); ?></div>
		<?php endif; ?>
	</header>

	<?php while ( $query->have_posts() ) : $query->the_post(); 
	?>
	<header class="entry-header">
	<?php if ( is_singular() ) : 
		the_title( '<h1 class="entry-title default-max-width">', '</h1>' ); 
	else :
		the_title( sprintf( '<h2 class="entry-title default-max-width"><a href="%s">', esc_url( get_permalink() ) ), '</a></h2>' ); 
	endif;

	twenty_twenty_one_post_thumbnail(); ?>
	</header>

	<div class="entry-content">
	<?php
	the_excerpt();
	?>
	</div>
	<?php
	endwhile; 
	wp_reset_postdata();
	the_posts_pagination();
	?>

<?php else : ?>
	<?php get_template_part( 'template-parts/content/content-none' ); ?>
<?php endif; ?>

<?php get_footer(); ?>

