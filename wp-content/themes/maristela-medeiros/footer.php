	<!--SABER MAIS-->
	<div id="saber-mais" class="py-5 bg-palha">
		<div class="container">
			<div class="row d-flex justify-content-center text-center text-md-left">
				<div class="col-12 col-md-6">
					<h2 class="text-primary">Quer saber mais?</h2>
					<p class="font-italic">Para saber mais sobre os serviços e investimentos preencha o formulário:</p>
				</div>

				<div class="col-10 col-md-2 align-self-center">
					<a role="button" href="#" class="btn btn-primary btn" data-toggle="modal" data-target="#SolicitaContato">Entre em contato</a>
				</div>
			</div>
		</div>
	</div>
</main>

<footer class="bg-cinza pt-5">
	<div class="container">
		<div class="row pb-5">
			<div class="col-12 col-md-4 d-flex align-items-center justify-content-start mb-3 mb-md-0">
				<a href="<?php echo site_url(); ?>" class="logo-rodape"><img src="<?php bloginfo("template_url"); ?>/images/marca.svg" width="132" height="72" alt="Maristela Medeiros Nutricionista" /></a>
			</div>

			<div class="col-12 col-md-4 d-flex align-items-center justify-content-center">				
				<!-- Begin Mailchimp Signup Form -->
				<div id="mc_embed_signup">
					<form action="https://maristelamedeiros.us3.list-manage.com/subscribe/post?u=1e6b485ce231f549069f1ab83&amp;id=b0d90307ae" method="post" id="mc-embedded-subscribe-form" name="mc-embedded-subscribe-form" class="validate form-inline" target="_blank" novalidate>
					
						<div class="form-row">
							<label for="mce-EMAIL" class="text-white mb-1">Cadastre-se e receba nossa newsletter</label>
						</div>
						<div class="form-group bg-white rounded w-100">							
							<input type="email" value="" name="EMAIL" placeholder="Digite seu e-mail" class="form-control required email border-0" id="mce-EMAIL" style="width: 80%">
							<input type="submit" value="Enviar" name="subscribe" id="mc-embedded-subscribe" class="btn btn-primary button" style="width: 20%">
						</div>
					
						<div id="mce-responses" class="clear">
							<div class="response" id="mce-error-response" style="display:none"></div>
							<div class="response" id="mce-success-response" style="display:none"></div>
						</div>

						<div style="position: absolute; left: -5000px;" aria-hidden="true">
							<input type="text" name="b_1e6b485ce231f549069f1ab83_b0d90307ae" tabindex="-1" value="">
						</div>
					</form>
				</div>
				<!--End mc_embed_signup-->
			</div>

			<!-- Menu auxiliar -->
			<?php /*
				wp_nav_menu( array(
					'theme_location'  => 'principal',
					'depth'	          => 2, // 1 = no dropdowns, 2 = with dropdowns.
					'container'       => 'div',
					'container_class' => 'col-12 col-md-6 nav-footer d-flex align-items-center justify-content-center mb-3 mb-md-0',
					'container_id'    => '',
					'menu_class'      => 'navbar-aux list-unstyled',
					'fallback_cb'     => 'WP_Bootstrap_Navwalker::fallback',
					'walker'          => new WP_Bootstrap_Navwalker(),
				) ); */
			?>

			<!-- Menu social -->
			<?php
				wp_nav_menu( array(
					'theme_location'  => 'social',
					'depth'	          => 2, // 1 = no dropdowns, 2 = with dropdowns.
					'container'       => 'div',
					'container_class' => 'col-12 col-md-4 d-flex align-items-center justify-content-end nav-social',
					'container_id'    => '',
					'menu_class'      => 'navbar-social list-inline mb-0',
					'fallback_cb'     => 'WP_Bootstrap_Navwalker::fallback',
					'walker'          => new WP_Bootstrap_Navwalker(),
				) );
			?>
		</div>

		<div class="row">
			<div class="col-12 border-top copy">
				<p class="text-white text-center py-4">© <?php the_date('Y'); ?> Copyright . Todos os direitos Reservados . <a href="<?php echo site_url(); ?>" title="Maristela Medeiros Nutricionista"><?php bloginfo(); ?></a></p>
			</div>
		</div>

		<a href="#topo" class="back-top" data-container="body" data-toggle="popover" data-trigger="hover" data-placement="left" data-content="Voltar ao topo">
			<i class="fas fa-chevron-up"></i> <span class="text-hide">Voltar ao topo</span>
		</a>
	</div>
</footer>

<?php wp_footer(); ?>

<script src="<?php bloginfo('template_url'); ?>/js/scripts.min.js"></script>
<script src="<?php bloginfo('template_url'); ?>/js/main.js"></script>
<script src="<?php bloginfo('template_url'); ?>/js/jquery.mask.min.js"></script>
<script src="<?php bloginfo('template_url'); ?>/js/owl.carousel.min.js"></script>
<script src="https://use.fontawesome.com/releases/v5.9.0/js/all.js" data-auto-replace-svg="nest"></script>
<script>
	// Botão voltar ao topo
	$(".back-top").click(function() {
		$(window).scrollTop(0);
	});

	$('#telefone').mask('(00) 00000-0000');

	$(document).ready(function() {
		if(window.location.href.indexOf('#SolicitaContato') != -1) {
			$('#SolicitaContato').modal('show');
		}
	});

	// Header fixo quando sobe
	$(document).ready(function() {
		var offset = $('.navegacao').offset().top;
		var $meuMenu = $('.navegacao'); // guardar o elemento na memoria para melhorar performance
		$(document).on('scroll', function () {
			if (offset <= $(window).scrollTop()) {
				$meuMenu.addClass('fixed-top');
			} else {
				$meuMenu.removeClass('fixed-top');
			}
		});
	});
</script>

</body>
</html>
