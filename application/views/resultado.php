<?php $this->load->view('template/header');?>
<style type="text/css">
	.modal-dialog,
	.modal-content {
		max-width: 100vw !important;
		height: 100vh;
		margin: 0 !important;
	}
</style>
<div class="conteudo row w-100 m-0">
	<div class="col-md-12 col-12 d-flex align-items-center">
		<div class="container py-5">
			<center><button type="button" class="btn btn-dark" onclick="history.back()">Voltar para home</button></center>
			<h1 class="text-center mt-4">PII 2 Grupo 075 - Araras/SP</h1>
			<h2 class="text-center">Resultados da pesquisa</h2>
			<div class="container">
				<?php if($result): ?>
					<?php foreach ($result as $r => $res) :?>
						<div class="row w-100 m-0 justify-content-center align-items-center" style="border: 1px solid #000">
							<div class="col-md-3 text-center p-0">
								<img class="w-100" src="<?=base_url('assets/img/nr13/'.$res->nome.'.jpg')?>" alt="Imagem NR13">
							</div>
							<div class="col-md-9 text-center p-5">
								<a class="btn btn-primary" data-toggle="modal" data-target="#modal<?=$r?>">Ver documento: <?=$res->nome?></a>
							</div>
						</div>
					<?php endforeach; ?>
				<?php else : ?>
					<p class="text-center">Nenhum resultado encontrado. Refaça sua busca.</p>
				<?php endif;?>
			</div>
		</div>
	</div>
</div>
<?php $this->load->view('template/footer');?>

<!-- modal -->
<?php if($result): ?>
	<?php foreach ($result as $r => $res) :?>
		<div class="modal fade" id="modal<?=$r?>" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
			<div class="modal-dialog modal-dialog-centered modal-lg" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="modalLabel"><?=$res->nome?></h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
						<iframe width="100%" height="100%" src="<?=base_url('assets/arquivos/'.$res->nome.'.pdf')?>"></iframe>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-dismiss="modal" aria-label="Fechar">Fechar</button>
					</div>
				</div>
			</div>
		</div>
	<?php endforeach; ?>
<?php endif;?>
