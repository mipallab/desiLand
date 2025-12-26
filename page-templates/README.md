# Page Templates

This folder contains all custom page templates for the DesiLan theme.

## Available Templates:

### 1. **Login/Register Page** (`page-auth.php`)
- **Template Name:** Login/Register Page
- **Purpose:** Custom authentication page with tabbed login and registration forms
- **Features:**
  - Tabbed interface (Login/Sign Up)
  - Password visibility toggle
  - Form validation with error messages
  - Social login hooks
  - Dynamic Terms & Privacy Policy links
  - Max width: 750px for focused design

### 2. **My Account Dashboard** (`page-dashboard.php`)
- **Template Name:** My Account Dashboard
- **Purpose:** WooCommerce-compatible account dashboard
- **Features:**
  - Sidebar navigation with user info
  - Recent orders table
  - Order statistics cards
  - Member status display
  - Links to WooCommerce account endpoints
  - Requires user to be logged in (auto-redirects if not)

## Usage:

1. Create a new page in WordPress admin
2. In the Page Attributes sidebar, select the desired template from the dropdown
3. Publish the page

## WordPress Recognition:

WordPress automatically recognizes page templates in the `page-templates` folder. No additional configuration needed!

## Best Practices:

- All page template files should start with `page-` prefix
- Include proper template header comment with "Template Name"
- Keep templates organized in this folder for maintainability
- Document any new templates added to this README
