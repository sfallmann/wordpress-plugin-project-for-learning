<?php
add_action( 'admin_menu', 'spf_add_admin_menu' );
add_action( 'admin_init', 'spf_settings_init' );


function spf_add_admin_menu(  ) { 

	add_menu_page( 'SPF Movie DB', 'SPF Movie DB', 'manage_options', 'spf_movie_db', 'spf_options_page' );

}


function spf_settings_init(  ) { 

	register_setting( 'pluginPage', 'spf_settings' );

	add_settings_section(
		'spf_pluginPage_section', 
		__( 'Your section description', 'spf-movie-content' ), 
		'spf_settings_section_callback', 
		'pluginPage'
	);

	add_settings_field( 
		'spf_text_field_0', 
		__( 'Settings field description', 'spf-movie-content' ), 
		'spf_text_field_0_render', 
		'pluginPage', 
		'spf_pluginPage_section' 
	);

	add_settings_field( 
		'spf_text_field_1', 
		__( 'Settings field description', 'spf-movie-content' ), 
		'spf_text_field_1_render', 
		'pluginPage', 
		'spf_pluginPage_section' 
	);

	add_settings_field( 
		'spf_checkbox_field_2', 
		__( 'Settings field description', 'spf-movie-content' ), 
		'spf_checkbox_field_2_render', 
		'pluginPage', 
		'spf_pluginPage_section' 
	);


}


function spf_text_field_0_render(  ) { 

	$options = get_option( 'spf_settings' );
	?>
	<input type='text' name='spf_settings[spf_text_field_0]' value='<?php echo $options['spf_text_field_0']; ?>'>
	<?php

}


function spf_text_field_1_render(  ) { 

	$options = get_option( 'spf_settings' );
	?>
	<input type='text' name='spf_settings[spf_text_field_1]' value='<?php echo $options['spf_text_field_1']; ?>'>
	<?php

}


function spf_checkbox_field_2_render(  ) { 

	$options = get_option( 'spf_settings' );
	?>
	<input type='checkbox' name='spf_settings[spf_checkbox_field_2]' <?php checked( $options['spf_checkbox_field_2'], 1 ); ?> value='1'>
	<?php

}


function spf_settings_section_callback(  ) { 

	echo __( 'This section description', 'spf-movie-content' );

}


function spf_options_page(  ) { 

	?>
	<form action='options.php' method='post'>

		<h2>SPF Movie DB</h2>

		<?php
		settings_fields( 'pluginPage' );
		do_settings_sections( 'pluginPage' );
		submit_button();
		?>

	</form>
	<?php

}

?>