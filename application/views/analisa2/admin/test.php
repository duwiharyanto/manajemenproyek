<form method="POST" action="<?= base_url($global->url)?>" enctype="multipart/form-data">
	<div class="box box-primary animated bounceInRight">
		<div class="box-header with-border">
			<h3 class="box-title"><?= ucwords($global->headline)?></h3>
		</div>
		<div class="box-body">
			<div class="selector">
				<select>
					<option>Name</option>
					<option>Father Name</option>
					<option>Mother Name</option>
				</select>
				<input type="text"/>
			</div>
			<div>
				<button type="button" id="copy">Copy</button>
			</div>

			<div class="another">

			</div>					
		</div>		
	</div>			
</form>
<script type="text/javascript">
	$(function(){
		$('select').select2();
		$('#copy').click(function(){
			$('select').select2('destroy');
			var selectorParant = $('.selector').html();
			$('.another').append(selectorParant);
			$('select').select2();
		});
	});
</script>
<?php
	include 'action.js';
?>