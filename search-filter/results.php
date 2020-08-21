<?php
/**
 * Search & Filter Pro 
 *
 * Sample Results Template
 * 
 * @package   Search_Filter
 * @author    Ross Morsali
 * @link      https://searchandfilter.com
 * @copyright 2018 Search & Filter
 * 
 * Note: these templates are not full page templates, rather 
 * just an encaspulation of the your results loop which should
 * be inserted in to other pages by using a shortcode - think 
 * of it as a template part
 * 
 * This template is an absolute base example showing you what
 * you can do, for more customisation see the WordPress docs 
 * and using template tags - 
 * 
 * http://codex.wordpress.org/Template_Tags
 *
 */

// If this file is called directly, abort.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( $query->have_posts() )
{
	?>

	<p class="results-total"><?php echo $query->found_posts; ?></p>

	<?php
	while ( $query->have_posts() ) {
		$query->the_post();

		?>
		<div class="result">
			<?php 
				if ( has_post_thumbnail() ) {
					echo '<div class="result-thumbnail">';
					the_post_thumbnail('medium_large');
					echo '</div>';
				}
			?>
			<div class="result-body">
				<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
				<?php echo '<p class="result-excerpt">' . esc_html( get_the_excerpt() ) . '</p>'; ?>
				<?php echo get_the_term_list( $query->ID, 'category', '<p class="result-tags">', '', '</p>' ); ?>
			</div>
		</div>

		<?php
	}
	?>

	<div class="pagination">
		<div class="nav-previous"><?php next_posts_link( 'Older posts', $query->max_num_pages ); ?></div>
		<div class="current-page">Page <?php echo $query->query['paged']; ?> of <?php echo $query->max_num_pages; ?></div>
		<div class="nav-next"><?php previous_posts_link( 'Newer posts' ); ?></div>
	</div>

	<?php
}
else
{
	echo "No Results Found";
}
?>