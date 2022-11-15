<?php get_header(); ?>

	<!--BANNER-->
	<div class="jumbotron">
		<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

		<div class="container">
			<div class="row d-flex justify-content-center">
				<div class="col-12 col-md-7">
					<h2 class="h1 color-white font-weight-bold text-center"><?php the_title(); ?></h2>
				</div>
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
				<div class="col-11 col-md-5 imagem-post mb-3">
					<?php the_post_thumbnail( 'img-post-wide' ); ?>
				</div>

				<div class="col-11 col-md-7">
						<div class="content">
							<?php the_content(); ?>
						</div>
					</div>

					<?php endwhile; endif; ?>
				</div>
			</div>
		</div>
	</div>

<?php get_footer(); ?>