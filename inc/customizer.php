<?php
/**
 * DesiLan Theme Customizer
 *
 * @package DesiLan
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function desilan_customize_register( $wp_customize ) {

	// Add Footer Section
	$wp_customize->add_section(
		'desilan_footer_section',
		array(
			'title'    => esc_html__( 'Footer Settings', 'desilan' ),
			'priority' => 120,
		)
	);

	/**
	 * Copyright Text
	 */
	$wp_customize->add_setting(
		'footer_copyright_text',
		array(
			'default'           => esc_html__( '© 2024 DesiLan. All rights reserved.', 'desilan' ),
			'sanitize_callback' => 'wp_kses_post',
			'transport'         => 'refresh',
		)
	);

	$wp_customize->add_control(
		'footer_copyright_text',
		array(
			'label'       => esc_html__( 'Copyright Text', 'desilan' ),
			'section'     => 'desilan_footer_section',
			'type'        => 'textarea',
		)
	);

	/**
	 * Social Media Colors
	 */
	// Icon Background Color
	$wp_customize->add_setting(
		'social_bg_color',
		array(
			'default'           => '#1f2937', // gray-800
			'sanitize_callback' => 'sanitize_hex_color',
		)
	);
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'social_bg_color',
			array(
				'label'    => esc_html__( 'Social Icon Background', 'desilan' ),
				'section'  => 'desilan_footer_section',
				'settings' => 'social_bg_color',
			)
		)
	);

	// Icon Hover Background Color
	$wp_customize->add_setting(
		'social_bg_hover_color',
		array(
			'default'           => '#b45f36', // Primary default
			'sanitize_callback' => 'sanitize_hex_color',
		)
	);
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'social_bg_hover_color',
			array(
				'label'    => esc_html__( 'Social Icon Hover Background', 'desilan' ),
				'section'  => 'desilan_footer_section',
				'settings' => 'social_bg_hover_color',
			)
		)
	);

	// Icon Color
	$wp_customize->add_setting(
		'social_icon_color',
		array(
			'default'           => '#9CA3AF', // gray-400
			'sanitize_callback' => 'sanitize_hex_color',
		)
	);
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'social_icon_color',
			array(
				'label'    => esc_html__( 'Social Icon Color', 'desilan' ),
				'section'  => 'desilan_footer_section',
				'settings' => 'social_icon_color',
			)
		)
	);

	// Icon Hover Color
	$wp_customize->add_setting(
		'social_icon_hover_color',
		array(
			'default'           => '#ffffff',
			'sanitize_callback' => 'sanitize_hex_color',
		)
	);
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'social_icon_hover_color',
			array(
				'label'    => esc_html__( 'Social Icon Hover Color', 'desilan' ),
				'section'  => 'desilan_footer_section',
				'settings' => 'social_icon_hover_color',
			)
		)
	);

	/**
	 * Social Media Links (5 Slots)
	 */
	for ( $i = 1; $i <= 5; $i++ ) {
		// Icon Class / Text
		$wp_customize->add_setting(
			'social_icon_' . $i,
			array(
				'default'           => '',
				'sanitize_callback' => 'sanitize_text_field',
			)
		);
		$wp_customize->add_control(
			'social_icon_' . $i,
			array(
				'label'       => sprintf( esc_html__( 'Social Icon/Text #%d', 'desilan' ), $i ),
				'description' => esc_html__( 'Enter FontAwesome class (e.g. "fa-brands fa-instagram") or Text (e.g. "IG")', 'desilan' ),
				'section'     => 'desilan_footer_section',
				'type'        => 'text',
			)
		);

		// Link
		$wp_customize->add_setting(
			'social_link_' . $i,
			array(
				'default'           => '',
				'sanitize_callback' => 'esc_url_raw',
			)
		);
		$wp_customize->add_control(
			'social_link_' . $i,
			array(
				'label'   => sprintf( esc_html__( 'Social Link #%d', 'desilan' ), $i ),
				'section' => 'desilan_footer_section',
				'type'    => 'url',
			)
		);
	}

}
add_action( 'customize_register', 'desilan_customize_register' );

/**
 * Output Custom CSS for Social Icons
 */
function desilan_customize_css() {
	$bg_color       = get_theme_mod( 'social_bg_color', '#1f2937' );
	$bg_hover       = get_theme_mod( 'social_bg_hover_color', '#b45f36' );
	$icon_color     = get_theme_mod( 'social_icon_color', '#9CA3AF' );
	$icon_hover     = get_theme_mod( 'social_icon_hover_color', '#ffffff' );
	?>
	<style type="text/css">
		.desilan-social-link {
			background-color: <?php echo esc_attr( $bg_color ); ?>;
			color: <?php echo esc_attr( $icon_color ); ?>;
		}
		.desilan-social-link:hover {
			background-color: <?php echo esc_attr( $bg_hover ); ?>;
			color: <?php echo esc_attr( $icon_hover ); ?>;
		}
		.desilan-social-link i, .desilan-social-link span {
			/* Ensure content inherits color */
			color: inherit;
		}
	</style>
	<?php
}
add_action( 'wp_head', 'desilan_customize_css' );
