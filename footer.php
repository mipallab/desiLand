<?php
/**
 * The template for displaying the footer
 *
 * @package DesiLan
 */

?>

<footer class="bg-card-dark text-gray-400 py-16 border-t border-gray-800 mt-auto text-sm">
	<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
		<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-12 mb-12">
			
			<!-- Column 1 -->
			<div class="col-span-1 lg:col-span-1">
				<?php if ( is_active_sidebar( 'footer-1' ) ) : ?>
					<?php dynamic_sidebar( 'footer-1' ); ?>
				<?php else : ?>
					<span class="font-display font-bold text-white mb-6 block text-sm"><?php bloginfo( 'name' ); ?></span>
					<p class="mb-6 leading-relaxed">
						<?php echo get_bloginfo( 'description' ) ? get_bloginfo( 'description' ) : 'Breathwork e meditação para uma vida mais consciente.'; ?>
					</p>
					<div class="space-y-2 text-sm">
						<a class="flex items-center hover:text-white transition-colors" href="mailto:ola@desliga.pt">
							<span class="material-icons-outlined text-sm mr-2">email</span> ola@desliga.pt
						</a>
						<div class="flex items-center">
							<span class="material-icons-outlined text-sm mr-2">phone</span> +351 912 345 678
						</div>
					</div>
				<?php endif; ?>
			</div>

			<!-- Column 2 -->
			<div>
				<?php if ( is_active_sidebar( 'footer-2' ) ) : ?>
					<?php dynamic_sidebar( 'footer-2' ); ?>
				<?php else : ?>
					<h4 class="text-white font-medium mb-6 text-sm">Explorar</h4>
					<ul class="space-y-3">
						<li><a class="hover:text-primary transition-colors" href="#">Início</a></li>
						<li><a class="hover:text-primary transition-colors" href="#">Áudios Premium</a></li>
						<li><a class="hover:text-primary transition-colors" href="#">Workshops</a></li>
						<li><a class="hover:text-primary transition-colors" href="#">A Minha Conta</a></li>
					</ul>
				<?php endif; ?>
			</div>

			<!-- Column 3 -->
			<div>
				<?php if ( is_active_sidebar( 'footer-3' ) ) : ?>
					<?php dynamic_sidebar( 'footer-3' ); ?>
				<?php else : ?>
					<h4 class="text-white font-medium mb-6 text-sm">Suporte</h4>
					<ul class="space-y-3">
						<li><a class="hover:text-primary transition-colors" href="#">Central de Ajuda</a></li>
						<li><a class="hover:text-primary transition-colors" href="#">Gerir Assinatura</a></li>
						<li><a class="hover:text-primary transition-colors" href="#">Contactar Suporte</a></li>
					</ul>
				<?php endif; ?>
			</div>

			<!-- Column 4 -->
			<div>
				<?php if ( is_active_sidebar( 'footer-4' ) ) : ?>
					<?php dynamic_sidebar( 'footer-4' ); ?>
				<?php else : ?>
					<h4 class="text-white font-medium mb-6 text-sm">Legal</h4>
					<ul class="space-y-3">
						<li><a class="hover:text-primary transition-colors" href="#">Termos &amp; Condições</a></li>
						<li><a class="hover:text-primary transition-colors" href="#">Política de Privacidade</a></li>
					</ul>
				<?php endif; ?>
			</div>

		</div>
		<div class="border-t border-gray-800 pt-8 flex flex-col md:flex-row justify-between items-center text-sm">
			<p><?php echo wp_kses_post( get_theme_mod( 'footer_copyright_text', '© ' . date( 'Y' ) . ' DesiLan. All rights reserved.' ) ); ?></p>
			<div class="flex gap-4">
				<?php
				for ( $i = 1; $i <= 5; $i++ ) {
					$icon = get_theme_mod( 'social_icon_' . $i );
					$link = get_theme_mod( 'social_link_' . $i );
					if ( ! empty( $icon ) && ! empty( $link ) ) {
						?>
						<a class="desilan-social-link w-8 h-8 rounded-full bg-gray-800 flex items-center justify-center hover:bg-primary hover:text-white transition-colors" href="<?php echo esc_url( $link ); ?>">
							<?php if ( preg_match( '/^(fa|dashicons)/', $icon ) ) : ?>
								<i class="<?php echo esc_attr( $icon ); ?> text-sm"></i>
							<?php else : ?>
								<span class="text-xs font-bold"><?php echo esc_html( $icon ); ?></span>
							<?php endif; ?>
						</a>
						<?php
					}
				}
				?>
			</div>
		</div>
	</div>
</footer>

<?php wp_footer(); ?>

</body>
</html>
