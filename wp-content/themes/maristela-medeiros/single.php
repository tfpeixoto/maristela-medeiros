<?php get_header(); ?>

	<!--BANNER-->
	<div class="jumbotron">
		<div class="container">
		<div class="row d-flex justify-content-center">
			<div class="col-7">
				<h2 class="h1 color-white font-weight-bold text-center">Blog</h2>
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
				<div class="col-12 col-md-8">
					<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

						<div class="imagem-post">
							<?php the_post_thumbnail( 'img-post-wide' ); ?>
						</div>
						
						<h1 class="my-3"><?php the_title(); ?></h1>

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