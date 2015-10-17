<?php
/**
 * The template for displaying project content in the single-project.php template
 */
?>


<article id="project-<?php the_ID(); ?>" <?php post_class(); ?>>

<?php
	/**
	 * display thumbnail & excerpt
	 * @see template-tags.php
	 */
	do_action( 'before_content' );
?>

	<div class="entry-content">

	<h1 class="entry-title"><?php the_title(); ?></h1>

		<?php
			/**
			 * projects_single_project_summary hook
		 	 * see theme functions
			 * @hooked projects_template_single_gallery - 10
			 * @hooked projects_template_single_description - 20
			 */
			do_action( 'projects_single_project_summary' );

		?>

	<?php
		/**
		 * projects_after_single_project_summary hook
		 * projects_after_single_project hook
		 */
		do_action( 'projects_after_single_project_summary' );
		do_action( 'projects_after_single_project' );
	?>

	</div><!-- .entry-content -->

</article>