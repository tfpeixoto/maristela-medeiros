<?php
$estiloPagina = 'style.css';
require_once('header.php');
?>

<!--BANNER-->
<div class="jumbotron">
  <div class="container">
    <div class="row">
      <div class="col-12 col-md-7">
        <h1><?php the_title(); ?></h1>
      </div>
    </div>
  </div>
</div>

<main class="main">
  <div class="container">
    <div class="row">
      <div class="col-8">
        <?php the_content(); ?>
      </div>
    </div>
  </div>
</main>

<?php
require_once("template-parts/modal.php");
require_once('footer.php');
?>