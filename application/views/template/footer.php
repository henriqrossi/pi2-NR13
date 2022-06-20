<footer class="page-footer w-100 py-4">
	<div class="container">
		<div class="row text-center justify-content-around w-100 m-0">
			<div class="col-md-12 col-12">			
				<p class="m-0">Rua Lorem Ipsum - Bairro, Araras - SP</p>
				<p class="m-0"><i class="fas fa-phone-square-alt mr-2"></i> (99) 99999-9999</p>
			</div>	
		</div>
		<div class="row justify-content-center w-100 py-3 m-0">
			<span style="font-size: 0.8em; text-align: center">Todos os direitos reservados © <?=date('Y')?></span>
		</div>
	</div>
</footer>
<script type="text/javascript" src="<?=base_url('assets/js/jquery-3.3.1.js')?>"></script>
<script type="text/javascript" src="<?=base_url('assets/js/bootstrap.min.js')?>"></script>
<script type="text/javascript" src="<?=base_url('assets/js/aos.js')?>"></script>
<script type="text/javascript" src="<?=base_url('assets/js/all.min.js')?>"></script>
<script type="text/javascript" src="<?=base_url('assets/slick/slick.min.js')?>"></script>
<script type="text/javascript">
	AOS.init();
	function changePic1() {
		document.getElementById("facebook").src = "<?=base_url('assets/img/icones/fb-amarelo.png')?>";
	}
	function backPic1() {
		document.getElementById("facebook").src = "<?=base_url('assets/img/icones/fb-branco.png')?>";
	}
	function changePic2() {
		document.getElementById("instagram").src = "<?=base_url('assets/img/icones/insta-amarelo.png')?>";
	}
	function backPic2() {
		document.getElementById("instagram").src = "<?=base_url('assets/img/icones/insta-branco.png')?>";
	}
	function changePic3() {
		document.getElementById("linkedin").src = "<?=base_url('assets/img/icones/in-amarelo.png')?>";
	}
	function backPic3() {
		document.getElementById("linkedin").src = "<?=base_url('assets/img/icones/in-branco.png')?>";
	}
</script>
</body>
</html>
