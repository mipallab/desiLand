<?php
/**
 * The header for our theme
 *
 * @package DesiLan
 */

?>
<!DOCTYPE html>
<html class="scroll-smooth" <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
	<link rel="profile" href="https://gmpg.org/xfn/11">
	<link href="https://fonts.googleapis.com" rel="preconnect"/>
	<link crossorigin="" href="https://fonts.gstatic.com" rel="preconnect"/>
	<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,600;0,700;1,400&amp;family=Inter:wght@300;400;500;600&amp;display=swap" rel="stylesheet"/>
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons+Outlined" rel="stylesheet"/>
	<script src="https://cdn.tailwindcss.com?plugins=forms,typography"></script>
	<script>
		tailwind.config = {
			darkMode: "class",
			theme: {
			extend: {
				colors: {
				primary: "#B45F36", // Terracotta color
				"primary-hover": "#9C4E2A",
				"background-light": "#FAF7F2", // Warm beige
				"background-dark": "#1C1917", // Warm dark gray
				"card-light": "#FFFFFF",
				"card-dark": "#292524",
				"text-main-light": "#44403C",
				"text-main-dark": "#E7E5E4",
				"accent-light": "#EADBC9",
				"success": "#15803d",
				"success-light": "#dcfce7",
				},
				fontFamily: {
				display: ["'Playfair Display'", "serif"],
				sans: ["'Inter'", "sans-serif"],
				},
				borderRadius: {
				DEFAULT: "0.5rem",
				'xl': '1rem',
				'2xl': '1.5rem',
				},
				backgroundImage: {
				'hero-pattern': "url('https://images.unsplash.com/photo-1593811167562-9cef47bfc4d7?ixlib=rb-1.2.1&auto=format&fit=crop&w=1950&q=80')",
				}
			},
			},
		};
	</script>
	<style>
		.fade-up {
			animation: fadeUp 0.8s ease-out forwards;
		}
		@keyframes fadeUp {
			from { opacity: 0; transform: translateY(20px); }
			to { opacity: 1; transform: translateY(0); }
		}
		.scale-in {
			animation: scaleIn 0.5s ease-out forwards;
		}
		@keyframes scaleIn {
			from { opacity: 0; transform: scale(0.8); }
			to { opacity: 1; transform: scale(1); }
		}
		.no-scrollbar::-webkit-scrollbar {
			display: none;
		}
		.no-scrollbar {
			-ms-overflow-style: none;
			scrollbar-width: none;
		}
	</style>
	<?php wp_head(); ?>
</head>
<body <?php body_class( 'bg-background-light dark:bg-background-dark text-text-main-light dark:text-text-main-dark font-sans antialiased transition-colors duration-300 flex flex-col min-h-screen' ); ?>>
<?php wp_body_open(); ?>
<nav class="fixed w-full z-50 bg-background-light/90 dark:bg-background-dark/90 backdrop-blur-md border-b border-gray-100 dark:border-gray-800">
	<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
		<div class="flex justify-between items-center h-20">
			<div class="flex-shrink-0 flex items-center">
				<a class="font-display text-2xl font-bold text-primary" href="<?php echo esc_url( home_url( '/' ) ); ?>">
					<?php bloginfo( 'name' ); ?>
				</a>
			</div>
			<div class="hidden md:flex space-x-8 items-center text-sm font-medium">
				<?php
				wp_nav_menu(
					array(
						'theme_location' => 'menu-1',
						'menu_id'        => 'primary-menu',
						'container'      => false,
						'menu_class'     => 'flex space-x-8', // Note: WP adds ul, this might need custom walker or just simple links. For now, letting WP verify structure or Just static links as placeholder.
						'fallback_cb'    => false, // Don't show pages if no menu
						'items_wrap'     => '%3$s', // Remove ul wrapper if we want direct a tags, but WP outputs li. keeping standard mostly.
					)
				);
				?>
				<!-- Fallback static links if menu is empty, matching provided HTML -->
				<?php if ( ! has_nav_menu( 'menu-1' ) ) : ?>
					<a class="hover:text-primary transition-colors" href="#">Início</a>
					<a class="hover:text-primary transition-colors" href="#">Áudios</a>
					<a class="hover:text-primary transition-colors" href="#">Eventos</a>
					<a class="hover:text-primary transition-colors" href="#">Loja</a>
					<a class="hover:text-primary transition-colors" href="#">Conta</a>
				<?php endif; ?>
			</div>
			<div class="flex items-center space-x-4">
				<button class="p-2 rounded-full hover:bg-gray-100 dark:hover:bg-gray-800 transition-colors" onclick="document.documentElement.classList.toggle('dark')">
					<span class="material-icons-outlined text-xl">dark_mode</span>
				</button>
				<div class="w-8 h-8 rounded-full bg-primary text-white flex items-center justify-center text-sm font-medium">
					<?php 
					$current_user = wp_get_current_user();
					echo $current_user->exists() ? strtoupper( substr( $current_user->display_name, 0, 2 ) ) : 'G';
					?>
				</div>
			</div>
		</div>
	</div>
</nav>
