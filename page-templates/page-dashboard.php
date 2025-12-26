<?php
/**
 * Template Name: My Account Dashboard
 * 
 * @package DesiLan
 */

// Redirect if not logged in
if ( ! is_user_logged_in() ) {
	wp_redirect( desilan_get_auth_page_url() );
	exit;
}

get_header();

$current_user = wp_get_current_user();
$user_registered = get_the_author_meta( 'user_registered', $current_user->ID );
$member_since = date( 'Y', strtotime( $user_registered ) );
?>

<style>
	.fade-up {
		animation: fadeUp 0.8s ease-out forwards;
	}
	@keyframes fadeUp {
		from { opacity: 0; transform: translateY(20px); }
		to { opacity: 1; transform: translateY(0); }
	}
</style>

<main class="flex-grow pt-32 pb-20 md:pt-40 md:pb-28 bg-background-light dark:bg-background-dark relative overflow-hidden flex flex-col justify-center">
	<!-- Background Decorations -->
	<div class="absolute top-0 right-0 -mr-20 -mt-20 w-[400px] h-[400px] bg-accent-light/50 dark:bg-primary/10 rounded-full blur-3xl -z-10"></div>
	<div class="absolute bottom-0 left-0 -ml-20 -mb-20 w-[300px] h-[300px] bg-primary/10 rounded-full blur-3xl -z-10"></div>
	
	<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 w-full">
		<!-- Page Header -->
		<div class="text-center mb-10 fade-up">
			<h1 class="font-display text-3xl md:text-5xl mb-4 text-gray-900 dark:text-white">My Account</h1>
			<p class="text-lg text-gray-600 dark:text-gray-300">Manage your activities, bookings, and preferences in one place.</p>
		</div>

		<div class="flex flex-col lg:flex-row gap-8 fade-up" style="animation-delay: 0.1s;">
			<!-- Sidebar -->
			<aside class="w-full lg:w-72 flex-shrink-0">
				<div class="bg-white dark:bg-card-dark rounded-xl shadow-lg border border-gray-100 dark:border-gray-800 overflow-hidden sticky top-24">
					<!-- User Info -->
					<div class="p-6 border-b border-gray-100 dark:border-gray-700 bg-gray-50/50 dark:bg-card-dark">
						<div class="flex items-center gap-4">
							<div class="h-12 w-12 rounded-full bg-primary/10 text-primary flex items-center justify-center text-xl font-display font-bold border border-primary/20">
								<?php echo esc_html( strtoupper( substr( $current_user->display_name, 0, 1 ) ) ); ?>
							</div>
							<div>
								<p class="text-sm font-bold text-gray-900 dark:text-white"><?php echo esc_html( $current_user->display_name ); ?></p>
								<p class="text-xs text-gray-500 dark:text-gray-400">Member since <?php echo esc_html( $member_since ); ?></p>
							</div>
						</div>
					</div>

					<!-- Navigation -->
					<nav class="p-3 space-y-1">
						<?php
						$current_endpoint = WC()->query->get_current_endpoint();
						$menu_items = array(
							'' => array(
								'label' => 'Dashboard',
								'icon' => 'dashboard',
								'url' => wc_get_account_endpoint_url( 'dashboard' ),
							),
							'orders' => array(
								'label' => 'Orders',
								'icon' => 'shopping_bag',
								'url' => wc_get_account_endpoint_url( 'orders' ),
							),
							'downloads' => array(
								'label' => 'Downloads',
								'icon' => 'download',
								'url' => wc_get_account_endpoint_url( 'downloads' ),
							),
							'edit-address' => array(
								'label' => 'Addresses',
								'icon' => 'location_on',
								'url' => wc_get_account_endpoint_url( 'edit-address' ),
							),
							'edit-account' => array(
								'label' => 'Account Settings',
								'icon' => 'settings',
								'url' => wc_get_account_endpoint_url( 'edit-account' ),
							),
						);

						foreach ( $menu_items as $endpoint => $item ) :
							$is_active = ( $current_endpoint === $endpoint || ( empty( $current_endpoint ) && $endpoint === '' ) );
							$active_class = $is_active ? 'bg-primary/10 text-primary dark:bg-primary/20 border-l-4 border-primary shadow-sm' : 'text-gray-600 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-800 hover:text-primary dark:hover:text-primary';
							?>
							<a class="flex items-center gap-3 px-4 py-3 text-sm font-medium rounded-lg <?php echo esc_attr( $active_class ); ?> transition-all group" href="<?php echo esc_url( $item['url'] ); ?>">
								<span class="material-icons-outlined <?php echo $is_active ? '' : 'group-hover:scale-110 transition-transform'; ?>"><?php echo esc_html( $item['icon'] ); ?></span>
								<?php echo esc_html( $item['label'] ); ?>
							</a>
						<?php endforeach; ?>

						<!-- Logout -->
						<div class="border-t border-gray-100 dark:border-gray-700 my-2 pt-2">
							<a class="flex items-center gap-3 px-4 py-3 text-sm font-medium rounded-lg text-red-600 hover:bg-red-50 dark:hover:bg-red-900/20 transition-colors" href="<?php echo esc_url( wp_logout_url( home_url() ) ); ?>">
								<span class="material-icons-outlined">logout</span>
								Logout
							</a>
						</div>
					</nav>
				</div>
			</aside>

			<!-- Main Content -->
			<div class="flex-grow">
				<div class="bg-white dark:bg-card-dark rounded-2xl shadow-xl border border-gray-100 dark:border-gray-800 p-6 md:p-10 h-full">
					<!-- Welcome Header -->
					<div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-8 gap-4">
						<div>
							<h2 class="font-display text-2xl font-bold text-gray-900 dark:text-white">Hello, <?php echo esc_html( $current_user->display_name ); ?></h2>
							<p class="text-sm text-gray-500 dark:text-gray-400 mt-1">Welcome back to your connection space.</p>
						</div>
						<div class="flex gap-3">
							<a href="<?php echo esc_url( wc_get_account_endpoint_url( 'edit-account' ) ); ?>" class="px-4 py-2 text-sm font-medium text-primary border border-primary/30 rounded-lg hover:bg-primary/5 dark:hover:bg-primary/10 transition-colors">
								Edit Profile
							</a>
						</div>
					</div>

					<!-- Stats Cards -->
					<div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-6 mb-10">
						<?php
						// Get WooCommerce data
						$customer_orders = wc_get_orders( array(
							'customer' => $current_user->ID,
							'limit' => 1,
							'orderby' => 'date',
							'order' => 'DESC',
						) );
						$last_order = ! empty( $customer_orders ) ? $customer_orders[0] : null;
						?>

						<!-- Last Order Card -->
						<?php if ( $last_order ) : ?>
						<div class="group bg-background-light dark:bg-background-dark p-5 rounded-xl border border-gray-200 dark:border-gray-700 hover:border-primary/50 dark:hover:border-primary/50 transition-colors cursor-pointer">
							<div class="flex items-center gap-3 mb-4 text-gray-500 dark:text-gray-400">
								<div class="p-2 bg-white dark:bg-card-dark rounded-lg shadow-sm text-primary">
									<span class="material-icons-outlined text-xl">shopping_bag</span>
								</div>
								<span class="text-xs font-bold uppercase tracking-wider text-gray-500">Last Order</span>
							</div>
							<h3 class="font-display font-bold text-gray-900 dark:text-white text-lg mb-1">#<?php echo esc_html( $last_order->get_order_number() ); ?></h3>
							<p class="text-sm text-gray-500 dark:text-gray-400 mb-4"><?php echo esc_html( $last_order->get_item_count() ); ?> Items</p>
							<p class="text-sm text-green-600 flex items-center gap-1.5 font-medium bg-green-50 dark:bg-green-900/20 py-1 px-2 rounded w-fit">
								<span class="w-1.5 h-1.5 rounded-full bg-green-500"></span> <?php echo esc_html( wc_get_order_status_name( $last_order->get_status() ) ); ?>
							</p>
						</div>
						<?php endif; ?>

						<!-- Total Orders Card -->
						<div class="group bg-background-light dark:bg-background-dark p-5 rounded-xl border border-gray-200 dark:border-gray-700 hover:border-primary/50 dark:hover:border-primary/50 transition-colors cursor-pointer relative overflow-hidden">
							<div class="absolute right-0 top-0 w-20 h-20 bg-primary/5 rounded-full -mr-10 -mt-10 group-hover:bg-primary/10 transition-colors"></div>
							<div class="flex items-center gap-3 mb-4 text-primary relative z-10">
								<div class="p-2 bg-white dark:bg-card-dark rounded-lg shadow-sm">
									<span class="material-icons-outlined text-xl">receipt_long</span>
								</div>
								<span class="text-xs font-bold uppercase tracking-wider">Total Orders</span>
							</div>
							<?php
							$total_orders = wc_get_customer_order_count( $current_user->ID );
							?>
							<h3 class="font-display font-bold text-gray-900 dark:text-white text-lg mb-1 relative z-10"><?php echo esc_html( $total_orders ); ?> Orders</h3>
							<p class="text-sm text-gray-500 dark:text-gray-400 mb-4 relative z-10">All time</p>
						</div>

						<!-- Placeholder for custom content -->
						<div class="bg-gradient-to-br from-primary to-primary-hover text-white p-5 rounded-xl shadow-lg shadow-primary/20 relative overflow-hidden md:col-span-2 xl:col-span-1">
							<div class="absolute right-0 top-0 opacity-10 transform translate-x-1/4 -translate-y-1/4">
								<span class="material-icons-outlined text-9xl">loyalty</span>
							</div>
							<div class="relative z-10 h-full flex flex-col justify-between">
								<div>
									<div class="flex items-center gap-3 mb-3 text-white/90">
										<span class="material-icons-outlined">stars</span>
										<span class="text-xs font-bold uppercase tracking-wider">Member Status</span>
									</div>
									<h3 class="font-display font-bold text-white text-xl">Active Member</h3>
									<p class="text-sm text-white/80 mt-1">Thank you for being part of our community.</p>
								</div>
							</div>
						</div>
					</div>

					<!-- Recent Orders Table -->
					<div class="border-t border-gray-100 dark:border-gray-800 pt-8">
						<div class="flex items-center justify-between mb-6">
							<h3 class="font-display text-xl font-bold text-gray-900 dark:text-white flex items-center gap-2">
								<span class="material-icons-outlined text-primary">history</span> Recent Orders
							</h3>
							<a class="text-sm font-medium text-primary hover:text-primary-hover flex items-center gap-1 group" href="<?php echo esc_url( wc_get_account_endpoint_url( 'orders' ) ); ?>">
								View all 
								<span class="material-icons-outlined text-xs group-hover:translate-x-1 transition-transform">arrow_forward</span>
							</a>
						</div>

						<?php
						$recent_orders = wc_get_orders( array(
							'customer' => $current_user->ID,
							'limit' => 5,
							'orderby' => 'date',
							'order' => 'DESC',
						) );
						?>

						<?php if ( ! empty( $recent_orders ) ) : ?>
						<div class="overflow-x-auto rounded-lg border border-gray-100 dark:border-gray-800">
							<table class="w-full text-left border-collapse">
								<thead class="bg-gray-50 dark:bg-gray-800/50">
									<tr class="text-xs text-gray-500 dark:text-gray-400 uppercase tracking-wider">
										<th class="py-3 px-4 font-medium">Order</th>
										<th class="py-3 px-4 font-medium">Date</th>
										<th class="py-3 px-4 font-medium">Status</th>
										<th class="py-3 px-4 font-medium">Total</th>
										<th class="py-3 px-4 font-medium text-right">Actions</th>
									</tr>
								</thead>
								<tbody class="text-sm divide-y divide-gray-100 dark:divide-gray-800 bg-white dark:bg-card-dark">
									<?php foreach ( $recent_orders as $order ) : ?>
									<tr class="group hover:bg-gray-50 dark:hover:bg-gray-800/30 transition-colors">
										<td class="py-4 px-4 font-bold text-gray-900 dark:text-white">#<?php echo esc_html( $order->get_order_number() ); ?></td>
										<td class="py-4 px-4 text-gray-600 dark:text-gray-300"><?php echo esc_html( $order->get_date_created()->date_i18n( 'd M, Y' ) ); ?></td>
										<td class="py-4 px-4">
											<?php
											$status = $order->get_status();
											$status_class = 'bg-gray-100 text-gray-800 dark:bg-gray-900/30 dark:text-gray-400 border-gray-200 dark:border-gray-800';
											if ( $status === 'completed' ) {
												$status_class = 'bg-green-100 text-green-800 dark:bg-green-900/30 dark:text-green-400 border-green-200 dark:border-green-800';
											} elseif ( $status === 'processing' ) {
												$status_class = 'bg-blue-100 text-blue-800 dark:bg-blue-900/30 dark:text-blue-400 border-blue-200 dark:border-blue-800';
											} elseif ( $status === 'pending' ) {
												$status_class = 'bg-yellow-100 text-yellow-800 dark:bg-yellow-900/30 dark:text-yellow-400 border-yellow-200 dark:border-yellow-800';
											}
											?>
											<span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium border <?php echo esc_attr( $status_class ); ?>">
												<?php echo esc_html( wc_get_order_status_name( $status ) ); ?>
											</span>
										</td>
										<td class="py-4 px-4 text-gray-600 dark:text-gray-300"><?php echo $order->get_formatted_order_total(); ?></td>
										<td class="py-4 px-4 text-right">
											<a href="<?php echo esc_url( $order->get_view_order_url() ); ?>" class="text-gray-400 hover:text-primary transition-colors p-1.5 hover:bg-primary/10 rounded-full inline-flex">
												<span class="material-icons-outlined text-lg">visibility</span>
											</a>
										</td>
									</tr>
									<?php endforeach; ?>
								</tbody>
							</table>
						</div>
						<?php else : ?>
						<div class="text-center py-12 bg-gray-50 dark:bg-gray-800/30 rounded-lg">
							<span class="material-icons-outlined text-6xl text-gray-300 dark:text-gray-600 mb-4">shopping_bag</span>
							<p class="text-gray-500 dark:text-gray-400">No orders yet</p>
							<a href="<?php echo esc_url( wc_get_page_permalink( 'shop' ) ); ?>" class="inline-block mt-4 px-6 py-2 bg-primary text-white rounded-lg hover:bg-primary-hover transition-colors">
								Start Shopping
							</a>
						</div>
						<?php endif; ?>
					</div>
				</div>
			</div>
		</div>
	</div>
</main>

<?php
get_footer();
