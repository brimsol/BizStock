		<!-- javascript
		================================================== -->
		<!-- Placed at the end of the document so the pages load faster -->
		<script src="/public/js/jquery-1.7.2.min.js"></script>
		<script src="/public/bootstrap/js/bootstrap.min.js"></script>
		<script src="/public/bootstrap/js/bootbox.min.js"></script>
		<script src="/public/js/basic.js"></script>
		<!-- End of default scripts -->
		<?php
			/**
			 * Adds the Javascript file from anywhere 
			 * used for javascript plugins
			 */
			if(isset($root_js) && is_array($root_js))
			{
				foreach ($root_js as $root_js_file)
				{
					echo '<script src="' . $root_js_file . '"></script>';
				}
			}

			/**
			 * Adds the Javascript file from public/
			 * used for javascript plugins
			 */
			if(isset($js) && is_array($js))
			{
				foreach ($js as $js_file)
				{
					echo '<script src="/public/' . $js_file . '.js"></script>';
				}
			}

			/**
			 * Adds the Javascript file from public/js/app/
			 * used for application specific javascript files
			 */
			if(isset($app_js) && is_array($app_js))
			{
				foreach ($app_js as $app_js_file)
				{
					echo '<script src="/public/js/app/' . $app_js_file . '.js"></script>';
				}
			}
		?>
	</body>
</html>
