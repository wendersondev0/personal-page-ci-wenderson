	<!-- Header -->
	<header>
		<div class="container">
			<div class="slider-container">
				<div class="intro-text">
					<div class="intro-lead-in">Bem vindo ao meu site pessoal!!</div>
					<div class="intro-heading">Wenderson da S.S</div>
					<a href="#about" class="page-scroll btn btn-xl">Conheça mais!</a>
				</div>
			</div>
		</div>
	</header>
	<section id="about" class="light-bg">
		<div class="container">
			<div class="row">
				<div class="col-lg-12 text-center">
					<div class="section-title">
						<h2>Sobre</h2>
						<p>Este é meu site pessoal para apresentar minha vida profissional, meu cursos, certificados, experiências, e outros.</p>
					</div>
				</div>
			</div>
		</div>
		<!-- /.container -->
	</section>
	<section class="overlay-dark bg-img1 dark-bg short-section">
		<div class="container text-center">
			<div class="row">
				<div class="col-md-offset-3 col-md-3 mb-sm-30">
					<div class="counter-item">
						<a class="page-scroll" href="#project">
							<h2 data-count="<?= count($projects) ?>"><?= count($projects) ?></h2>
							<h6>Projetos</h6>
						</a>
					</div>
				</div>
				<div class="col-md-3 mb-sm-30">
					<div class="counter-item">
						<a class="page-scroll" href="#certificate">
							<h2 data-count="<?= count($certificates) ?>"><?= count($certificates) ?></h2>
							<h6>Certificados</h6>
						</a>
					</div>
				</div>
			</div>
		</div>
	</section>
	<section id="project" class="light-bg">
		<div class="container">
			<div class="row">
				<div class="col-lg-12 text-center">
					<div class="section-title">
						<h2>Projetos</h2>
						<p>Estes são alguns dos meus projetos, tanto pessoais, professionais, feitos em cursos e outros.</p>
					</div>
				</div>
			</div>
			<div class="row">
				<?php if (!empty($projects)) {
					foreach ($projects as $project) {
				?>
						<div class="col-md-4">
							<div class="ot-portfolio-item">
								<figure class="effect-bubba">
									<img src="<?= base_url() . $project["project_img"] ?>" alt="<?= $project["project_img"] ?>" class="img-responsive center-block" />
									<figcaption>
										<h2><?= $project["project_name"] ?></h2>
										<a href="#" data-toggle="modal" data-target="#project_<?= $project["project_id"] ?>"></a>
									</figcaption>
								</figure>
							</div>
						</div>

						<div class="modal fade" id="project_<?= $project["project_id"] ?>" tabindex="-1" role="dialog" aria-labelledby="Modal-label-1">
							<div class="modal-dialog" role="document">
								<div class="modal-content">

									<div class="modal-header">
										<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
										<h4 class="modal-title" id="Modal-label-1"><?= $project["project_name"] ?></h4>
									</div>

									<div class="modal-body">
										<img src="<?= base_url() . $project["project_img"] ?>" alt="<?= $project["project_img"] ?>" class="img-responsive center-block" />
										<!-- <div class="modal-works"><span>Branding</span><span>Web Design</span></div> -->
										<div class="modal-works"><span><?= intval($project["project_duration"]) ?> <?= (intval($project["project_duration"]) > 1) ? "horas" : "hora" ?> </span></div>
										<p><span>Tecnologias: </span><?= $project["project_stacks"] ?></p>
										<p><?= $project["project_description"] ?></p>
									</div>

									<div class="modal-footer">
										<button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
									</div>

								</div>
							</div>
						</div>
				<?php
					} //END FOREACH
				} //END IF
				?>
			</div>
		</div>
	</section>
	<section id="certificate" class="light-bg">
		<div class="container">
			<div class="row">
				<div class="col-lg-12 text-center">
					<div class="section-title">
						<h2>Certificados</h2>
						<p>Estes são alguns dos meus certificados de programação e tecnologia.</p>
					</div>
				</div>
			</div>
			<div class="row">
				<?php if (!empty($certificates)) {
					foreach ($certificates as $certificate) {
				?>
						<div class="col-md-3">
							<div class="team-item">
								<div class="team-image">
									<img src="<?= base_url() . $certificate["certificate_photo"] ?>" class="img-responsive" alt="author">
								</div>
								<div class="team-text">
									<h3><?= $certificate["certificate_title"] ?></h3>
									<!-- <div class="team-location">Sydney, Australia</div> -->
									<div class="team-position"><?= intval($certificate["certificate_duration"]) ?> <?= (intval($certificate["certificate_duration"]) > 1) ? "horas" : "hora" ?></div>
									<p><?= $certificate["certificate_description"] ?></p>
								</div>
							</div>
						</div>
				<?php }
				}
				?>
			</div>

		</div>
	</section>
	<section id="contact">
		<div class="container">
			<div class="row">
				<div class="col-lg-12 text-center">
					<div class="section-title">
						<h2>Contacte-me</h2>
						<p>Qualquer dúvida, ou por qualquer outra questão entre em contato!<br>Você pode entrar em contato pelos dados a seguir ou enviar uma mensagem de e-mail por este formulário</p>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12">
					<h3>Dados de contato</h3>
					<p><i class="fa fa-phone"></i> +55 (27) 9 9774-2613</p>
					<p><i class="fa fa-envelope"></i> wendersondasilva3@gmail.com</p>
				</div>
				<div class="col-md-12">
					<form name="sentMessage" id="contactForm" novalidate="">
						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<input type="text" class="form-control" placeholder="Seu nome *" id="name" required="" data-validation-required-message="Por favor digite o seu nome.">
									<p class="help-block text-danger"></p>
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<input type="email" class="form-control" placeholder="Seu E-mail *" id="email" required="" data-validation-required-message="Por favor digite o seu e-mail.">
									<p class="help-block text-danger"></p>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-12">
								<div class="form-group">
									<textarea class="form-control" placeholder="Sua mensagem *" id="message" required="" data-validation-required-message="Por favor digite a sua mensagem."></textarea>
									<p class="help-block text-danger"></p>
								</div>
							</div>
							<div class="clearfix"></div>
						</div>
						<div class="row">
							<div class="col-lg-12 text-center">
								<div id="success"></div>
								<button type="submit" class="btn">Enviar mensagem</button>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</section>
	<p id="back-top">
		<a href="#top"><i class="fa fa-angle-up"></i></a>
	</p>