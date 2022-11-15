<?php get_header(); ?>

	<!--BANNER-->
	<div class="jumbotron">
		<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

		<div class="container">
		<div class="row d-flex justify-content-center">
			<div class="col-7">
				<h1 class="color-white font-weight-bold text-center"><?php the_title(); ?></h1>
			</div>
		</div>
	</div>

	<?php // endwhile; endif; ?>
</header>

<!--MODAL-->
<?php require_once("modal.php"); ?>

<main>
	<div class="py-5">
		<div class="container">
			<div class="row d-flex justify-content-center align-items-center">
				<div class="col-8">						
					<div class="content">
						<?php the_content(); ?>
					</div>					
				</div>
			</div>
		</div>
		
		<?php endwhile; endif; ?>
	</div>

<?php get_footer(); ?>