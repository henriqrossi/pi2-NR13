<div class="container py-5">
	<h1 class="text-center">NR-13 Complied</h1>
	<h2 class="text-center">Aplicação web para disponibilizar a consulta dos materiais técnicos referentes à NR-13</h2>
	<p class="text-center">Trabalho de Projeto Integrador II - Cursos de Computação - UNIVESP - 2022</p>
	<form class="col-12" action="<?=base_url('home/busca_docs')?>" method="POST">
		<div class="form-group row justify-content-center">
			<div class="col-md-6 col-12">
				<label for="busca">Buscar documento</label>
				<input type="text" class="form-control" name="busca" id="busca" required placeholder="Pesquise por nome (ex: caldeiras, tubulações, ...)">
			</div>
		</div>
		<div class="row w-100 m-0 justify-content-center">
			<button type="submit" class="btn btn-dark my-2">Buscar</button>
		</div>
	</form>
</div>
