<!DOCTYPE html>
<html lang="pt-br">
<head>
  <!-- Meta tags Obrigatórias -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <link rel="stylesheet" href="css/style.css">
  
  <title>Maristela Medeiros Nutricionista</title>
</head>
<body>

<header>
	<div class="container">
		<div class="row">
			<div class="col-12 pt-2 nav-top">
				<ul class="list-inline nav-topo text-right mb-0">
					<li class="list-inline-item"><i class="fas fa-phone"></i> <a href="tel:+5561996230190"> (61) 99623-0190</a></li>
					<li class="list-inline-item"><i class="fas fa-envelope"></i> <a href="mailto:contato@maristelamedeiros.com"> contato@maristelamedeiros.com</a></li>
					<li class="list-inline-item"><i class="fas fa-map-marker-alt"></i> Brasília/DF</li>
				</ul>
			</div>	
		</div>
	</div>
	
	<div class="container">
		<div class="flex-row">
			<nav class="navbar navbar-expand-lg justify-content-between p-0">
				<div class="d-flex">
			  	<a class="navbar-brand" href="#"><img src="images/marca.svg" alt="Maristela Medeiros Nutricionista" /></a>
			  </div>			  

				<div class="d-flex">
			  	<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#nav-mobile" aria-controls="conteudoNavbarSuportado" aria-expanded="false" aria-label="Alterna navegação">
				    <span class="navbar-toggler-icon"></span>
				  </button>
				  
				  <div class="collapse navbar-collapse" id="nav-mobile">
				    <ul class="navbar-nav text-uppercase">
				      <li class="nav-item active"><a class="nav-link" href="#">Home <span class="sr-only">(página atual)</span></a></li>
				      <li class="nav-item"><a class="nav-link" href="#quem-sou">Quem sou</a></li>
				      <li class="nav-item"><a class="nav-link" href="#servicos">Serviços</a></li>
				      <li class="nav-item"><a class="nav-link" href="#depoimentos">Depoimentos</a></li>
				      <li class="nav-item"><a class="nav-link" href="#blog">Blog</a></li>
				      <li class="nav-item"><a class="nav-link btn btn-cinza text-white shadow-sm btn-contato" href="#" data-toggle="modal" data-target="#SolicitaContato">Contato</a></li>
				    </ul>
					</div>
				</nav>
			</div>
		</div>
	</div>

	<!--BANNER-->
	<div class="jumbotron">
		<div class="container">
		<div class="row">
			<div class="col-7">
				<h1 class="font-weight-bold">Especialista em auditorias, consultorias e treinamentos com foco total em qualidade e segurança alimentar para empresas</h1>

				<a role="button" href="#servicos" class="btn btn-lg btn-outline-light mt-2">Conheça os serviços</a>
			</div>
		</div>
	</div>
</header>

<!--MODAL-->
<?php require_once("modal.php"); ?>

<main>
	<!--QUEM SOU-->
	<div id="quem-sou" class="py-5">
		<div class="container">
			<div class="row d-flex align-items-center">
				<div class="col-5">
					<img src="images/foto-montada.png" class="img-fluid" alt="Nutricionista Maristela Medeiros, especialista em segurança dos alimentos" />
				</div>

				<div class="col-7">
					<h2 class="text-primary pb-4">Maristela Medeiros</h2>

					<p>Nutricionista há 28 anos e especialista em segurança dos alimentos pela Universidad Zaragoza na Espanha, a profissional atende oferecendo serviços de auditoria, consultoria e treinamentos sob medida para pequenas, médias e grandes empresas, em todo o Brasil.</p>

					<p>Em suas quase três décadas atuando com nutrição corporativa, passou por empresas de renome como Sodexo, Cotochés, Puras do Brasil e Grupo Paranapanema, <span class="font-weight-bold">conduzindo com excelência projetos voltados ao controle de qualidade, planejamento de cardápio, orçamento, legislação e gerenciamento de equipes</span>.</p>

					<div class="marcas pt-4">
						<img src="images/universidade-zaragoza.png" class="img-fluid mr-5" alt="Universidad Zaragoza Espanha">

						<img src="images/sodexo.png" class="img-fluid mr-2" alt="Sodexo">
						<img src="images/cotoches.png" class="img-fluid mr-2" alt="Cotochés">
						<img src="images/puras-do-brasil.png" class="img-fluid mr-2" alt="Puras do Brasil">
						<img src="images/paranapanema.png" class="img-fluid" alt="Grupo Paranapanema">
					</div>
				</div>
			</div>		
		</div>
	</div>

	<!--SERVIÇOS-->
	<div id="servicos" class="bg-palha py-5">
		<div class="container">
			<div class="row">
				<div class="col-12">
					<h2 class="text-primary text-center">Serviços</h2>

					<div class="card-deck">
						<div class="card border-0 rounded text-center shadow-sm">
							<img class="card-img-top" src="images/icone-auditorias.png" alt="Imagem de capa do card">

							<div class="card-body">
								<h3 class="card-title text-marrom">Auditorias</h3>

								<p class="card-text">Apuração de possíveis inconformidades e situações irregulares pelos padrões determinados pela Vigilância Sanitária, visando a prevenção de autuações e riscos de contaminação.</p>

								<button type="button" class="btn btn-primary btn-lg shadow-sm mb-3">Saiba mais</button>
							</div>
						</div>

						<div class="card border-0 rounded text-center shadow-sm">
							<img class="card-img-top" src="images/icone-consultorias.png" alt="Imagem de capa do card">

							<div class="card-body">
								<h3 class="card-title text-marrom">Consultorias</h3>

								<p class="card-text">Orientação e acompanhamento para aperfeiçoamentos nas técnicas, segurança dos alimentos, planejamento, precificação, assegurando a aplicação das melhores práticas de produção.</p>

								<button type="button" class="btn btn-primary btn-lg shadow-sm mb-3">Saiba mais</button>
							</div>
						</div>

						<div class="card border-0 rounded text-center shadow-sm">
							<img class="card-img-top" src="images/icone-treinamentos.png" alt="Imagem de capa do card">

							<div class="card-body">
								<h3 class="card-title text-marrom">Treinamentos</h3>

								<p class="card-text">Capacitações técnicas para empresas, com conteúdo adaptável de acordo com a necessidade do cliente e porte da equipe, apoiando o desenvolvimento e padronização de processos.</p>

								<button type="button" class="btn btn-primary btn-lg shadow-sm mb-3">Saiba mais</button>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<!--CTA-->
	<div id="cta" class="bg-cinza text-white py-3">
		<div class="container">
			<div class="row">
				<div class="col-5">
					<img src="images/prato.png" class="img-fluid" alt="Atendimento nutricional especializado para empresas" />
				</div>

				<div class="col-7 align-self-center">
					<h3>Invista em um atendimento nutricional especializado para o seu negócio e <span class="font-weight-bold">garanta melhorias expressivas na qualidade do seu serviço, economia e segurança na produção dos alimentos</span>.</h3>

					<a href="#" class="btn btn-primary btn-lg mt-3" role="button" data-toggle="modal" data-target="#SolicitaContato">Entre em contato</a>
				</div>
			</div>
		</div>
	</div>

	<!--DEPOIMENTOS-->
	<div id="depoimentos" class="py-5">
		<div class="container">
			<div class="row">
				<div class="col-12">
					<h2 class="text-primary text-center">Depoimentos</h2>
					<p class="text-center font-italic mb-5">O que dizem os clientes</p>

					<div class="row">
						<div class="col-6">
							<div class="media d-flex align-items-center">
							  <img class="mr-3" src="images/foto.png" alt="Imagem de exemplo genérica">
							  <div class="media-body">							    
							    <a href="#">Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis. Fusce condimentum</a>
							    <h5 class="mt-3"><a href="#">Cabeçalho da mídia</a></h5>
							  </div>
							</div>						
						</div>

						<div class="col-6">
							<div class="media d-flex align-items-center">
							  <img class="mr-3" src="images/foto.png" alt="Imagem de exemplo genérica">
							  <div class="media-body">
							    <a href="#">Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis. Fusce condimentum nunc ac nisi vulputate fringilla. Donec lacinia congue felis in faucibus.</a>

							    <h5 class="mt-3"><a href="#">Cabeçalho da mídia</a></h5>
							  </div>
							</div>						
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<!--BLOG-->
	<div id="blog" class="bg-primary mt-4 pb-5">
		<div class="container">
			<div class="row">
				<div class="col-4">
					<h2 class="text-primary mb-5">Blog</h2>
					<p class="mb-5">Aqui você fica informado sobre todas as novidades do mundo da nutrição corporativa.</p>

					<a role="button" href="#" class="btn btn-outline-light btn-lg mt-5 text-uppercase">Ver todos os posts</a>
				</div>
				
				<div class="col-8">
					<div class="card-deck">
						<div class="card border-0 rounded shadow-sm">
							<img class="card-img-top" src="images/box-foto.png" alt="Imagem de capa do card">

							<div class="card-body">
								<h3 class="card-title"><a href="#" class="text-marrom-claro">Lorem ipsum dolor sit amet, consectetur adipiscing elit</a></h3>

								<p class="card-text">Ut cursus, urna eget tristique placerat, magna risus feugiat magna, eu tincidunt nisl est non mauris. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas ultrices risus tortor, sit amet aliquam ligula tempus ut. In commodo nibh vel arcu laoreet</p>

								<a href="#" class="text-uppercase font-weight-bold leia-mais">Ler mais ></a>
							</div>
						</div>

						<div class="card border-0 rounded shadow-sm">
							<img class="card-img-top" src="images/box-foto.png" alt="Imagem de capa do card">

							<div class="card-body">
								<h3 class="card-title"><a href="#" class="text-marrom-claro">Lorem ipsum dolor sit amet, consectetur adipiscing elit</a></h3>

								<p class="card-text">Ut cursus, urna eget tristique placerat, magna risus feugiat magna, eu tincidunt nisl est non mauris. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas ultrices risus tortor, sit amet aliquam ligula tempus ut. In commodo nibh vel arcu laoreet</p>

								<a href="#" class="text-uppercase font-weight-bold leia-mais">Ler mais ></a>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<!--SABER MAIS-->
	<div id="saber-mais" class="py-5">
		<div class="container">
			<div class="row d-flex justify-content-center">
				<div class="col-5">
					<h2 class="text-primary">Quer saber mais?</h2>
					<p class="font-italic">Para saber mais sobre os serviços e preços preencha o formulário:</p>
				</div>

				<div class="col-3 align-self-center">
					<a role="button" href="#" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#SolicitaContato">Entre em contato</a>
				</div>
			</div>
		</div>
	</div>
</main>

<footer class="bg-cinza pt-5">
	<div class="container">
		<div class="row pb-3">
			<div class="col-3 d-flex align-items-center">
				<a href="#" class="logo-rodape"><img src="images/marca.svg" width="132" height="72" alt="Maristela Medeiros Nutricionista" /></a>
			</div>

			<div class="col-6 nav-footer d-flex align-items-center justify-content-center">
				<ul class="navbar-aux list-unstyled">
		      <li class="nav-item list-inline-item"><a class="text-white" href="#">Home <span class="sr-only">(página atual)</span></a></li>
		      <li class="nav-item list-inline-item"><a class="text-white" href="#">Quem sou</a></li>
		      <li class="nav-item list-inline-item"><a class="text-white" href="#">Serviços</a></li>
		      <li class="nav-item list-inline-item"><a class="text-white" href="#">Depoimentos</a></li>
		      <li class="nav-item list-inline-item"><a class="text-white" href="#">Blog</a></li>
		      <li class="nav-item list-inline-item"><a class="text-white" href="#">Contato</a></li>
		    </ul>
			</div>

			<div class="col-3 d-flex justify-content-end align-items-center">
				<ul class="navbar-social list-inline">
		      <li class="list-inline-item"><a href="#"><img src="images/linkedin.svg" alt="Linkedin" /></a></li>
		      <li class="list-inline-item"><a href="#"><img src="images/youtube.svg" alt="YouTube" /></a></li>
		      <li class="list-inline-item"><a href="#"><img src="images/instagram.svg" alt="Instagram" /></a></li>
		      <li class="list-inline-item"><a href="#"><img src="images/facebook.svg" alt="Facebook" /></a></li>
		    </ul>
			</div>
		</div>

		<div class="row">
			<div class="col-12 border-top copy">
				<p class="text-white text-center py-4">© 2019 Copyright . Todos os direitos Reservados . <a ref="#">Maristela Medeiros</a></p>
			</div>
		</div>
	</div>
</footer>

<script src="js/scripts.min.js"></script>
<script src="https://use.fontawesome.com/releases/v5.9.0/js/all.js" data-auto-replace-svg="nest"></script>

</body>
</html>