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
				<?php
				// Check if custom logo is set
				if ( has_custom_logo() ) {
					the_custom_logo();
				} else {
					// Fallback to site name
					?>
					<a class="font-display text-2xl font-bold text-primary" href="<?php echo esc_url( home_url( '/' ) ); ?>">
						<?php bloginfo( 'name' ); ?>
					</a>
					<?php
				}
				?>
			</div>
			
			<!-- Desktop Menu -->
			<div class="hidden md:flex space-x-8 items-center text-sm font-medium">
				<?php
				if ( has_nav_menu( 'primary' ) ) {
					wp_nav_menu(
						array(
							'theme_location' => 'primary',
							'container'      => false,
							'menu_class'     => '',
							'items_wrap'     => '%3$s',
							'fallback_cb'    => false,
							'link_before'    => '',
							'link_after'     => '',
							'walker'         => new class extends Walker_Nav_Menu {
								function start_el( &$output, $item, $depth = 0, $args = null, $id = 0 ) {
									$classes = empty( $item->classes ) ? array() : (array) $item->classes;
									$is_current = in_array( 'current-menu-item', $classes ) || in_array( 'current_page_item', $classes );
									
									$class_names = $is_current ? 'text-primary transition-colors' : 'hover:text-primary transition-colors';
									
									$output .= '<a href="' . esc_url( $item->url ) . '" class="' . esc_attr( $class_names ) . '">';
									$output .= esc_html( $item->title );
									$output .= '</a>';
								}
							},
						)
					);
				} else {
					// Fallback menu if no menu is set
					?>
					<a class="hover:text-primary transition-colors" href="<?php echo esc_url( home_url( '/' ) ); ?>">Home</a>
					<a class="hover:text-primary transition-colors" href="#">About</a>
					<a class="hover:text-primary transition-colors" href="#">Events</a>
					<a class="hover:text-primary transition-colors" href="#">Shop</a>
					<a class="hover:text-primary transition-colors" href="#">Contact</a>
					<?php
				}
				?>
			</div>
			<div class="flex items-center space-x-4">
				<button class="p-2 rounded-full hover:bg-gray-100 dark:hover:bg-gray-800 transition-colors" onclick="document.documentElement.classList.toggle('dark')">
					<span class="material-icons-outlined text-xl">dark_mode</span>
				</button>
				
				<!-- Cart Icon -->
				<div class="relative">
					<a class="p-2 rounded-full hover:bg-gray-100 dark:hover:bg-gray-800 transition-colors flex" href="<?php echo esc_url( function_exists('wc_get_cart_url') ? wc_get_cart_url() : '#' ); ?>">
						<span class="material-icons-outlined text-xl">shopping_bag</span>
						<?php if ( function_exists('WC') && WC()->cart ) : ?>
							<span class="absolute top-0 right-0 h-4 w-4 bg-primary text-white text-[10px] font-bold rounded-full flex items-center justify-center">
								<?php echo WC()->cart->get_cart_contents_count(); ?>
							</span>
						<?php endif; ?>
					</a>
				</div>

				<?php if ( is_user_logged_in() ) : 
					$current_user = wp_get_current_user();
					?>
					<!-- Logged In: User Dropdown -->
					<div class="relative group hidden md:block">
						<button class="flex items-center gap-3 pl-4 pr-1.5 py-1.5 rounded-full border border-primary dark:border-primary bg-white dark:bg-card-dark shadow-md transition-all duration-300 focus:outline-none hover:shadow-lg">
							<span class="text-sm font-medium text-gray-700 dark:text-gray-200"><?php echo esc_html( $current_user->display_name ); ?></span>
							<div class="w-8 h-8 rounded-full bg-primary text-white flex items-center justify-center shadow-sm">
								<?php 
								$avatar = get_avatar( $current_user->ID, 32, '', '', array( 'class' => 'w-full h-full object-cover rounded-full' ) );
								if ( $avatar ) {
									echo $avatar;
								} else {
									// Fallback to initials if no avatar
									$initials = strtoupper( substr( $current_user->display_name, 0, 1 ) );
									echo '<span class="material-icons-outlined text-sm">person</span>';
								}
								?>
							</div>
						</button>
						<div class="absolute right-0 top-full mt-2 w-60 bg-white dark:bg-card-dark rounded-xl shadow-xl border border-gray-100 dark:border-gray-800 py-2 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200 transform origin-top-right z-50">
							<div class="px-4 py-3 border-b border-gray-100 dark:border-gray-700 mb-1">
								<p class="text-sm font-bold text-gray-900 dark:text-white font-display">Hello, <?php echo esc_html( $current_user->display_name ); ?></p>
								<p class="text-xs text-gray-500 dark:text-gray-400 truncate"><?php echo esc_html( $current_user->user_email ); ?></p>
							</div>
							<a class="flex items-center px-4 py-2.5 text-sm text-gray-600 dark:text-gray-300 hover:bg-accent-light/20 dark:hover:bg-gray-700/50 hover:text-primary transition-colors" href="<?php echo esc_url( get_edit_profile_url() ); ?>">
								<span class="material-icons-outlined text-lg mr-3">dashboard</span>
								<?php esc_html_e( 'Dashboard', 'desilan' ); ?>
							</a>
							<?php if ( function_exists('wc_get_account_endpoint_url') ) : ?>
								<a class="flex items-center px-4 py-2.5 text-sm text-gray-600 dark:text-gray-300 hover:bg-accent-light/20 dark:hover:bg-gray-700/50 hover:text-primary transition-colors" href="<?php echo esc_url( wc_get_account_endpoint_url( 'orders' ) ); ?>">
									<span class="material-icons-outlined text-lg mr-3">shopping_bag</span>
									<?php esc_html_e( 'Orders', 'desilan' ); ?>
								</a>
							<?php endif; ?>
							<div class="border-t border-gray-100 dark:border-gray-700 my-1"></div>
							<a class="flex items-center px-4 py-2.5 text-sm text-red-600 hover:bg-red-50 dark:hover:bg-red-900/10 transition-colors" href="<?php echo esc_url( wp_logout_url( home_url() ) ); ?>">
								<span class="material-icons-outlined text-lg mr-3">logout</span>
								<?php esc_html_e( 'Logout', 'desilan' ); ?>
							</a>
						</div>
					</div>
				<?php else : ?>
					<!-- Logged Out: Login/Signup -->
					<div class="hidden md:flex items-center space-x-3">
						<?php $auth_url = desilan_get_auth_page_url(); ?>
						<a href="<?php echo esc_url( $auth_url ); ?>" class="text-sm font-medium text-gray-700 dark:text-gray-200 hover:text-primary transition-all px-4 py-2 rounded-full border-2 border-gray-200 dark:border-gray-700 hover:border-primary dark:hover:border-primary hover:bg-gray-50 dark:hover:bg-gray-800">
							<?php esc_html_e( 'Login', 'desilan' ); ?>
						</a>
						<a href="<?php echo esc_url( add_query_arg( 'action', 'register', $auth_url ) ); ?>" class="text-sm font-bold bg-primary text-white px-5 py-2 rounded-full hover:bg-primary-hover transition-all shadow-lg shadow-primary/20 border-2 border-primary hover:border-primary-hover">
							<?php esc_html_e( 'Sign Up', 'desilan' ); ?>
						</a>
						<!-- Social Login Hook -->
						<?php do_action( 'desilan_social_login' ); ?>
					</div>
				<?php endif; ?>
			</div>
		</div>
	</div>
</nav>
