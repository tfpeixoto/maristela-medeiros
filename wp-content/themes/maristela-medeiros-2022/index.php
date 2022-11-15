<?php get_header(); ?>

	<!--BANNER-->
	<div class="jumbotron">
		<div class="container">
		<div class="row d-flex justify-content-center">
			<div class="col-7">
				<h1 class="font-weight-bold text-center">Blog</h1>
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
			<div class="row d-flex align-items-center">
				<div class="card-deck">
					<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

					<div class="col-12 col-sm-6 col-md-4">
						<div class="card">
							<?php the_post_thumbnail( 'img-post' ); ?>
						
							<div class="card-body">
								<h2 class="card-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
								<?php the_excerpt(); ?>
								<a href="<?php the_permalink(); ?>" class="link-mais" title="<?php the_title(); ?>">Ler mais ></a>
							</div>
						</div>
					</div>

					<?php endwhile; endif; ?>
				</div>
			</div>
		</div>
	</div>

<?php get_footer(); ?>