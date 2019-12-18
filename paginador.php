<?php
	function paginador($reload, $pag, $tpages, $adyacente){ ?>
		<nav aria-label="Page navigation example">
			<ul class="pagination justify-content-end">
				<li class="page-item disabled">
      				<a class="page-link" href="#" tabindex="-1">Previous</a>
    			</li>
    			<?php if($tpages <= 1){ ?>
						<li class="page-item"><a class="page-link" href="#">1</a></li>
						<li class="page-item disabled"><a class="page-link" href="#">Next</a></li>
    			<?php }else{ ?>
						<li class="page-item"><a class="page-link" href="<?php echo 'configuracion_lampara.php?page=1'; ?>">1</a></li>
						<li class="page-item"><a class="page-link" href="<?php echo 'configuracion_lampara.php?page=2'; ?>">2</a></li>
						<li class="page-item"><a class="page-link" href="#">Next</a></li>
    			<?php } ?>
    		</ul>
		 </nav>

	<?php }
?>