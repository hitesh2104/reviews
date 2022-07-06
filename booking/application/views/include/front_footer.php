
		<!-- Bottom scripts (common) -->
		<script src="<?php echo base_url(); ?>assets/js/gsap/main-gsap.js?ver=<?php echo DO_NO_CACHE; ?>"></script>
		<script src="<?php echo base_url(); ?>assets/js/jquery-ui/js/jquery-ui-1.10.3.minimal.min.js?ver=<?php echo DO_NO_CACHE; ?>"></script>
		<script src="<?php echo base_url(); ?>assets/js/bootstrap.js?ver=<?php echo DO_NO_CACHE; ?>"></script>
		<script src="<?php echo base_url(); ?>assets/js/joinable.js?ver=<?php echo DO_NO_CACHE; ?>"></script>
		<script src="<?php echo base_url(); ?>assets/js/resizeable.js?ver=<?php echo DO_NO_CACHE; ?>"></script>
		<script src="<?php echo base_url(); ?>assets/js/neon-api.js?ver=<?php echo DO_NO_CACHE; ?>"></script>
		<script src="<?php echo base_url(); ?>assets/js/jquery.validate.min.js?ver=<?php echo DO_NO_CACHE; ?>"></script>
		<script src="<?php echo base_url(); ?>assets/js/parsley.min.js"></script>
		<script src="<?php echo base_url(); ?>assets/js/uploadifive.min.js"></script>
		<?php if($this->uri->segment(1) != "register" && $this->uri->segment(2) != "register" && $this->uri->segment(2) != "consent_form"){ ?>
		<script src="<?php echo base_url(); ?>assets/js/neon-login.js?ver=<?php echo DO_NO_CACHE; ?>"></script>
		<?php } ?>
		<!-- JavaScripts initializations and stuff -->
		<script src="<?php echo base_url(); ?>assets/js/custom.php"></script>
		<script src="<?php echo base_url(); ?>assets/js/toastr.js"></script>
		<?php // if($this->uri->segment(2) != "consent_form"){ ?>
		<script src="<?php echo base_url(); ?>assets/js/neon-custom.js?ver=<?php echo DO_NO_CACHE; ?>"></script>
		<?php // } ?>
	</body>
	</html>