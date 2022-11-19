<div id="saber-mais" class="sabermais">
  <div class="container">
    <div class="row sabermais__row">
      <div class="col-12 col-md-6 sabermais__texto">
        <h2>Quer saber mais?</h2>
        <p>Para saber mais sobre os serviços e investimentos preencha o formulário:</p>
      </div>

      <div class="col-12 col-md-2 sabermais__cta">
        <a role="button" href="#" class="btn btn-primary" data-toggle="modal" data-target="#SolicitaContato">Entre em contato</a>
      </div>
    </div>
  </div>
</div>

<footer class="footer">
  <div class="container">
    <div class="row footer__info">
      <div class="col-12 col-md-4 footer__marca">
        <a href="<?= site_url(); ?>" class="logo-rodape">
          <img src="<?php bloginfo("template_url"); ?>/images/marca.svg" width="132" height="72" alt="Maristela Medeiros Nutricionista" />
        </a>
      </div>

      <div class="col-12 col-md-4 footer__newsletter">
        <!-- Begin Mailchimp Signup Form -->
        <div id="mc_embed_signup">
          <form action="https://maristelamedeiros.us3.list-manage.com/subscribe/post?u=1e6b485ce231f549069f1ab83&amp;id=b0d90307ae" method="post" id="mc-embedded-subscribe-form" name="mc-embedded-subscribe-form" class="validate form-inline" target="_blank" novalidate>

            <p>Cadastre-se e receba nossa newsletter</p>

            <div class="form-group">
              <input type="email" value="" name="EMAIL" placeholder="Digite seu e-mail" class="form-control required email" id="mce-EMAIL">
              <input type="submit" value="Enviar" name="subscribe" id="mc-embedded-subscribe" class="btn btn-primary">
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

      <?php
      wp_nav_menu(array(
        'theme_location'  => 'social',
        'depth'            => 2, // 1 = no dropdowns, 2 = with dropdowns.
        'container'       => 'div',
        'container_class' => 'col-12 col-md-4 footer__navsocial',
        'container_id'    => '',
        'menu_class'      => 'nav-social',
        'fallback_cb'     => 'WP_Bootstrap_Navwalker::fallback',
        'walker'          => new WP_Bootstrap_Navwalker(),
      ));
      ?>
    </div>

    <div class="row footer__copy">
      <div class="col-12">
        <p>© <?php the_date('Y'); ?> Copyright . Todos os direitos Reservados . <a href="<?= site_url(); ?>" title="Maristela Medeiros Nutricionista"><?php bloginfo(); ?></a></p>
      </div>
    </div>
  </div>
</footer>

<?php wp_footer(); ?>

</body>

</html>