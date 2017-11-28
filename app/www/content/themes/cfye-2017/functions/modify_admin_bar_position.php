<?php
function modify_admin_bar_position() {
	if ( is_user_logged_in() ) { ?>
	<style type="text/css">
		body {			
			margin-top: -32px;
			padding-bottom: 32px;			
		}
		body.admin-bar #wphead {
			padding-top: 0;
		}
		body.admin-bar #footer {
			padding-bottom: 32px;
		}
		#wpadminbar {
			top: auto !important;
			bottom: 0;
		}
		#wpadminbar .quicklinks .menupop ul {
			/* bottom: 28px; */
        }
        .ab-sub-wrapper {
            bottom: 32px;
		}
		
		@media screen and (max-width: 782px) {
			body {
				margin-top: -46px;
				padding-bottom: 46px;
			}

			.ab-sub-wrapper {
				bottom: 46px;
			}
		}
	</style>
<?php 
	}
}

// add_action( 'wp_head', 'modify_admin_bar_position' );