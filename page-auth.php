<?php
/**
 * Template Name: Login/Register Page
 * 
 * @package DesiLan
 */

get_header();
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
	
	<div class="max-w-[750px] mx-auto px-4 sm:px-6 lg:px-8 w-full">
		<!-- Header -->
		<div class="text-center mb-10 fade-up">
			<h1 class="font-display text-3xl md:text-5xl mb-4 text-gray-900 dark:text-white">Welcome to <?php bloginfo( 'name' ); ?></h1>
			<p class="text-lg text-gray-600 dark:text-gray-300">Continue your journey of breath and self-discovery.</p>
		</div>

		<!-- Auth Card -->
		<div class="bg-white dark:bg-card-dark rounded-2xl shadow-xl overflow-hidden border border-gray-100 dark:border-gray-800 fade-up" style="animation-delay: 0.1s;">
			
			<!-- Tab Navigation -->
			<div class="border-b border-gray-100 dark:border-gray-700">
				<div class="flex">
					<button id="login-tab" class="auth-tab active flex-1 px-6 py-4 text-center font-medium transition-all border-b-2 border-primary text-primary">
						<span class="flex items-center justify-center gap-2">
							<span class="material-icons-outlined text-xl">login</span>
							<span>Login</span>
						</span>
					</button>
					<button id="register-tab" class="auth-tab flex-1 px-6 py-4 text-center font-medium transition-all border-b-2 border-transparent text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-200">
						<span class="flex items-center justify-center gap-2">
							<span class="material-icons-outlined text-xl">person_add</span>
							<span>Sign Up</span>
						</span>
					</button>
				</div>
			</div>

			<!-- Tab Content -->
			<div class="p-8 md:p-12">
				
				<!-- Login Form -->
				<div id="login-content" class="auth-content">
					<h2 class="font-display text-2xl font-bold mb-6 text-gray-900 dark:text-white">Sign In to Your Account</h2>
					
					<!-- Social Login Buttons -->
					<div class="space-y-3 mb-8">
						<?php do_action( 'desilan_social_login_buttons' ); ?>
						
						<!-- Default Social Buttons if no plugin -->
						<button type="button" class="w-full flex items-center justify-center gap-3 px-4 py-3 border border-gray-200 dark:border-gray-700 rounded-lg hover:bg-gray-50 dark:hover:bg-gray-800 transition-colors bg-white dark:bg-transparent text-gray-700 dark:text-gray-200 font-medium">
							<svg class="w-5 h-5" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z" fill="#4285F4"></path><path d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z" fill="#34A853"></path><path d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l2.85-2.22.81-.62z" fill="#FBBC05"></path><path d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z" fill="#EA4335"></path></svg>
							Continue with Google
						</button>
						<button type="button" class="w-full flex items-center justify-center gap-3 px-4 py-3 border border-gray-200 dark:border-gray-700 rounded-lg hover:bg-gray-50 dark:hover:bg-gray-800 transition-colors bg-white dark:bg-transparent text-gray-700 dark:text-gray-200 font-medium">
							<svg class="w-5 h-5 dark:text-white" fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path d="M17.05 20.28c-.98.95-2.05.88-3.08.35-1.09-.46-2.09-.48-3.24 0-1.44.62-2.2.44-3.06-.35C2.79 15.25 3.51 7.59 9.05 7.31c1.35.07 2.29.74 3.08.74 1.18 0 2.45-.93 3.99-.71 1.52.12 2.65.65 3.39 1.75-2.92 1.78-2.4 5.92.52 7.15-.55 1.58-1.4 3.12-2.98 4.04zM12.03 7.25c-.15-2.23 1.66-4.07 3.74-4.25.29 2.58-2.34 4.5-3.74 4.25z"></path></svg>
							Continue with Apple
						</button>
					</div>

					<!-- Divider -->
					<div class="relative mb-8">
						<div class="absolute inset-0 flex items-center">
							<div class="w-full border-t border-gray-200 dark:border-gray-700"></div>
						</div>
						<div class="relative flex justify-center text-sm">
							<span class="px-3 bg-white dark:bg-card-dark text-gray-500 font-medium">or continue with email</span>
						</div>
					</div>

					<!-- Login Form -->
					<form method="post" action="" class="space-y-5" id="desilan-login-form">
						<?php wp_nonce_field( 'desilan_login_action', 'desilan_login_nonce' ); ?>
						
						<div id="login-messages" class="hidden"></div>
						
						<div>
							<label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1.5" for="login-username">Email or Username</label>
							<div class="relative">
								<span class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
									<span class="material-icons-outlined text-gray-400">person</span>
								</span>
								<input class="w-full pl-10 pr-4 py-3 rounded-lg border border-gray-200 dark:border-gray-600 bg-background-light dark:bg-background-dark focus:ring-2 focus:ring-primary focus:border-transparent outline-none transition-all dark:text-white placeholder-gray-400" id="login-username" name="login_username" placeholder="example@email.com" type="text" required/>
							</div>
						</div>

						<div>
						<label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1.5" for="login-password">Password</label>
						<div class="relative">
							<span class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
								<span class="material-icons-outlined text-gray-400">lock</span>
							</span>
							<input class="w-full pl-10 pr-12 py-3 rounded-lg border border-gray-200 dark:border-gray-600 bg-background-light dark:bg-background-dark focus:ring-2 focus:ring-primary focus:border-transparent outline-none transition-all dark:text-white placeholder-gray-400" id="login-password" name="login_password" placeholder="••••••••" type="password" required/>
							<button type="button" class="absolute inset-y-0 right-0 pr-3 flex items-center text-gray-400 hover:text-gray-600 dark:hover:text-gray-200" onclick="togglePassword('login-password', this)">
								<span class="material-icons-outlined text-xl">visibility</span>
							</button>
						</div>
					</div>

						<div class="flex items-center justify-between pt-1">
							<div class="flex items-center">
								<input class="h-4 w-4 text-primary focus:ring-primary border-gray-300 rounded cursor-pointer" id="remember-me" name="remember_me" type="checkbox" value="1"/>
								<label class="ml-2 block text-sm text-gray-600 dark:text-gray-400 cursor-pointer select-none" for="remember-me">Remember me</label>
							</div>
							<div class="text-sm">
								<a class="font-medium text-primary hover:text-primary-hover transition-colors" href="<?php echo esc_url( wp_lostpassword_url() ); ?>">Forgot password?</a>
							</div>
						</div>

						<button class="w-full bg-primary text-white px-8 py-3.5 rounded-lg font-medium hover:bg-primary-hover transition-all shadow-lg shadow-primary/20 hover:shadow-primary/30 mt-2 flex justify-center items-center gap-2 group" type="submit">
							Sign In
							<span class="material-icons-outlined group-hover:translate-x-1 transition-transform">arrow_forward</span>
						</button>
					</form>
				</div>

				<!-- Register Form -->
				<div id="register-content" class="auth-content hidden">
					<h2 class="font-display text-2xl font-bold mb-6 text-gray-900 dark:text-white">Create Your Account</h2>
					<p class="text-sm text-gray-500 dark:text-gray-400 mb-8 leading-relaxed">Join our community to get exclusive access to content, event history, and priority bookings.</p>

					<!-- Social Register Buttons -->
					<div class="grid grid-cols-2 gap-3 mb-8">
						<button type="button" class="flex items-center justify-center gap-2 px-3 py-2.5 border border-gray-200 dark:border-gray-700 rounded-lg hover:bg-white dark:hover:bg-gray-800 transition-colors bg-white/50 dark:bg-transparent text-gray-700 dark:text-gray-200 text-sm font-medium">
							<svg class="w-4 h-4" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z" fill="#4285F4"></path><path d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z" fill="#34A853"></path><path d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l2.85-2.22.81-.62z" fill="#FBBC05"></path><path d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z" fill="#EA4335"></path></svg>
							Google
						</button>
						<button type="button" class="flex items-center justify-center gap-2 px-3 py-2.5 border border-gray-200 dark:border-gray-700 rounded-lg hover:bg-white dark:hover:bg-gray-800 transition-colors bg-white/50 dark:bg-transparent text-gray-700 dark:text-gray-200 text-sm font-medium">
							<svg class="w-4 h-4 dark:text-white" fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path d="M17.05 20.28c-.98.95-2.05.88-3.08.35-1.09-.46-2.09-.48-3.24 0-1.44.62-2.2.44-3.06-.35C2.79 15.25 3.51 7.59 9.05 7.31c1.35.07 2.29.74 3.08.74 1.18 0 2.45-.93 3.99-.71 1.52.12 2.65.65 3.39 1.75-2.92 1.78-2.4 5.92.52 7.15-.55 1.58-1.4 3.12-2.98 4.04zM12.03 7.25c-.15-2.23 1.66-4.07 3.74-4.25.29 2.58-2.34 4.5-3.74 4.25z"></path></svg>
							Apple
						</button>
					</div>

					<!-- Divider -->
					<div class="relative mb-8">
						<div class="absolute inset-0 flex items-center">
							<div class="w-full border-t border-gray-200 dark:border-gray-700"></div>
						</div>
						<div class="relative flex justify-center text-sm">
							<span class="px-3 bg-white dark:bg-card-dark text-gray-500 font-medium">or register with email</span>
						</div>
					</div>

					<!-- Registration Form -->
					<form method="post" action="" class="space-y-5" id="desilan-register-form">
						<?php wp_nonce_field( 'desilan_register_action', 'desilan_register_nonce' ); ?>
						
						<div id="register-messages" class="hidden mb-4"></div>

						<div>
							<label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1.5" for="register-name">Full Name</label>
							<input class="w-full px-4 py-3 rounded-lg border border-gray-200 dark:border-gray-600 bg-white dark:bg-background-dark focus:ring-2 focus:ring-primary focus:border-transparent outline-none transition-all dark:text-white placeholder-gray-400" id="register-name" name="register_name" placeholder="How would you like to be addressed?" type="text" required/>
						</div>

						<div>
							<label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1.5" for="register-email">Email</label>
							<input class="w-full px-4 py-3 rounded-lg border border-gray-200 dark:border-gray-600 bg-white dark:bg-background-dark focus:ring-2 focus:ring-primary focus:border-transparent outline-none transition-all dark:text-white placeholder-gray-400" id="register-email" name="register_email" placeholder="example@email.com" type="email" required/>
						</div>

						<div class="grid grid-cols-1 md:grid-cols-2 gap-4">
						<div>
							<label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1.5" for="register-password">Password</label>
							<div class="relative">
								<input class="w-full px-4 pr-12 py-3 rounded-lg border border-gray-200 dark:border-gray-600 bg-white dark:bg-background-dark focus:ring-2 focus:ring-primary focus:border-transparent outline-none transition-all dark:text-white placeholder-gray-400" id="register-password" name="register_password" placeholder="••••••••" type="password" required/>
								<button type="button" class="absolute inset-y-0 right-0 pr-3 flex items-center text-gray-400 hover:text-gray-600 dark:hover:text-gray-200" onclick="togglePassword('register-password', this)">
									<span class="material-icons-outlined text-xl">visibility</span>
								</button>
							</div>
						</div>
						<div>
							<label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1.5" for="register-confirm">Confirm</label>
							<div class="relative">
								<input class="w-full px-4 pr-12 py-3 rounded-lg border border-gray-200 dark:border-gray-600 bg-white dark:bg-background-dark focus:ring-2 focus:ring-primary focus:border-transparent outline-none transition-all dark:text-white placeholder-gray-400" id="register-confirm" name="register_confirm" placeholder="••••••••" type="password" required/>
								<button type="button" class="absolute inset-y-0 right-0 pr-3 flex items-center text-gray-400 hover:text-gray-600 dark:hover:text-gray-200" onclick="togglePassword('register-confirm', this)">
									<span class="material-icons-outlined text-xl">visibility</span>
								</button>
							</div>
						</div>
					</div>

						<div class="flex items-start mt-2">
							<input class="h-4 w-4 mt-1 text-primary focus:ring-primary border-gray-300 rounded cursor-pointer" id="terms" name="terms" type="checkbox" required/>
							<label class="ml-2 block text-sm text-gray-600 dark:text-gray-400 cursor-pointer" for="terms">
				I agree to the 
				<?php 
				$terms_page = get_theme_mod('terms_conditions_page', 0);
				$privacy_page = get_option('wp_page_for_privacy_policy');
				?>
				<a class="text-primary hover:underline font-medium" href="<?php echo $terms_page ? esc_url(get_permalink($terms_page)) : '#'; ?>" target="_blank">Terms and Conditions</a> 
				and the 
				<a class="text-primary hover:underline font-medium" href="<?php echo $privacy_page ? esc_url(get_permalink($privacy_page)) : '#'; ?>" target="_blank">Privacy Policy</a>.
			</label>
						</div>

						<button class="w-full bg-gray-900 dark:bg-white dark:text-gray-900 text-white px-8 py-3.5 rounded-lg font-medium hover:bg-gray-800 dark:hover:bg-gray-200 transition-all shadow-lg shadow-gray-900/10 dark:shadow-white/10 mt-2" type="submit">
							Create Account
						</button>
					</form>
				</div>

			</div>
		</div>
	</div>
</main>

<script>
// Password visibility toggle function
function togglePassword(inputId, button) {
	const input = document.getElementById(inputId);
	const icon = button.querySelector('.material-icons-outlined');
	
	if (input.type === 'password') {
		input.type = 'text';
		icon.textContent = 'visibility_off';
	} else {
		input.type = 'password';
		icon.textContent = 'visibility';
	}
}
</script>

<script>
document.addEventListener('DOMContentLoaded', function() {
	const loginTab = document.getElementById('login-tab');
	const registerTab = document.getElementById('register-tab');
	const loginContent = document.getElementById('login-content');
	const registerContent = document.getElementById('register-content');

	// Check URL parameter to auto-switch tab
	const urlParams = new URLSearchParams(window.location.search);
	const action = urlParams.get('action');
	
	if (action === 'register') {
		// Auto-switch to register tab
		switchToRegister();
	}

	// Check for error/success messages in URL
	const loginError = urlParams.get('login');
	const registerError = urlParams.get('register');

	if (loginError) {
		showMessage('login-messages', getLoginErrorMessage(loginError), 'error');
	}

	if (registerError) {
		showMessage('register-messages', getRegisterErrorMessage(registerError), 'error');
		switchToRegister();
	}

	function switchToLogin() {
		loginTab.classList.add('active', 'border-primary', 'text-primary');
		loginTab.classList.remove('border-transparent', 'text-gray-500', 'dark:text-gray-400');
		registerTab.classList.remove('active', 'border-primary', 'text-primary');
		registerTab.classList.add('border-transparent', 'text-gray-500', 'dark:text-gray-400');
		
		loginContent.classList.remove('hidden');
		registerContent.classList.add('hidden');
	}

	function switchToRegister() {
		registerTab.classList.add('active', 'border-primary', 'text-primary');
		registerTab.classList.remove('border-transparent', 'text-gray-500', 'dark:text-gray-400');
		loginTab.classList.remove('active', 'border-primary', 'text-primary');
		loginTab.classList.add('border-transparent', 'text-gray-500', 'dark:text-gray-400');
		
		registerContent.classList.remove('hidden');
		loginContent.classList.add('hidden');
	}

	loginTab.addEventListener('click', switchToLogin);
	registerTab.addEventListener('click', switchToRegister);

	// Registration form validation
	const registerForm = document.getElementById('desilan-register-form');
	if (registerForm) {
		registerForm.addEventListener('submit', function(e) {
			const password = document.getElementById('register-password').value;
			const confirm = document.getElementById('register-confirm').value;
			const terms = document.getElementById('terms').checked;

			// Clear previous messages
			hideMessage('register-messages');

			// Validate password match
			if (password !== confirm) {
				e.preventDefault();
				showMessage('register-messages', 'Passwords do not match. Please try again.', 'error');
				return false;
			}

			// Validate password length
			if (password.length < 6) {
				e.preventDefault();
				showMessage('register-messages', 'Password must be at least 6 characters long.', 'error');
				return false;
			}

			// Validate terms checkbox
			if (!terms) {
				e.preventDefault();
				showMessage('register-messages', 'You must agree to the Terms and Conditions.', 'error');
				return false;
			}
		});
	}

	// Helper functions for messages
	function showMessage(elementId, message, type) {
		const messageDiv = document.getElementById(elementId);
		if (!messageDiv) return;

		const bgColor = type === 'error' ? 'bg-red-50 dark:bg-red-900/20 border-red-200 dark:border-red-800' : 'bg-green-50 dark:bg-green-900/20 border-green-200 dark:border-green-800';
		const textColor = type === 'error' ? 'text-red-600 dark:text-red-400' : 'text-green-600 dark:text-green-400';
		const icon = type === 'error' ? 'error' : 'check_circle';

		messageDiv.innerHTML = `
			<div class="flex items-start gap-3 p-4 rounded-lg border ${bgColor}">
				<span class="material-icons-outlined ${textColor}">${icon}</span>
				<p class="text-sm ${textColor} flex-1">${message}</p>
			</div>
		`;
		messageDiv.classList.remove('hidden');
		
		// Scroll to message
		messageDiv.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
	}

	function hideMessage(elementId) {
		const messageDiv = document.getElementById(elementId);
		if (messageDiv) {
			messageDiv.classList.add('hidden');
			messageDiv.innerHTML = '';
		}
	}

	function getLoginErrorMessage(error) {
		const messages = {
			'failed': 'Invalid username or password. Please try again.',
			'empty': 'Please enter your username and password.',
		};
		return messages[error] || 'Login failed. Please try again.';
	}

	function getRegisterErrorMessage(error) {
		const messages = {
			'password_mismatch': 'Passwords do not match. Please try again.',
			'invalid_email': 'Please enter a valid email address.',
			'email_exists': 'This email is already registered. Please login or use a different email.',
			'failed': 'Registration failed. Please try again.',
		};
		return messages[error] || 'An error occurred. Please try again.';
	}
});
</script>

<?php
get_footer();
