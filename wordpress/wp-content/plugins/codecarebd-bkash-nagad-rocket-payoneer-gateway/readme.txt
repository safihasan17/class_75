=== CodeCareBD - Payment Gateway for WooCommerce ===
Contributors: devshakil, codecarebd, shakvaro
Requires at least: 6.3
Requires PHP: 7.3
Tested up to: 7.0
Stable tag: 1.3.1
WC requires at least: 6.3
WC tested up to: 10.8
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html
Tags: bkash, nagad, rocket, woocommerce, payment-gateway

Integrate bKash, Nagad, Rocket and Payoneer manual payment gateways with WooCommerce. Block checkout and HPOS ready.

== Description ==

**CodeCareBD - Payment Gateway for WooCommerce** is a free, lightweight plugin that adds **bKash**, **Nagad**, **Rocket** and **Payoneer** as manual payment methods to your WooCommerce store. It is built for Bangladeshi e-commerce and F-commerce sellers who want to accept mobile financial service (MFS) payments without expensive merchant API onboarding.

When a customer places an order, they send money to your bKash, Nagad or Rocket number (Agent or Personal), then confirm the payment by entering their **mobile number and Transaction ID (TrxID)** right on the checkout page. You verify the payment and process the order from your WooCommerce dashboard. Payoneer is supported the same way using the sender email and transaction ID.

This makes it the perfect **bKash WooCommerce payment gateway** (and Nagad / Rocket / Payoneer gateway) for small and medium online shops, Facebook-commerce stores, and any merchant who collects payments manually.

= Why choose this plugin? =

* **100% free** - no monthly fees, no per-transaction charges from the plugin.
* **Four payment methods in one plugin** - bKash, Nagad, Rocket and Payoneer.
* **Block Checkout ready** - works natively with the new WooCommerce Cart & Checkout Blocks (the default checkout for new stores), as well as the classic shortcode checkout.
* **HPOS compatible** - fully supports WooCommerce High-Performance Order Storage (Custom Order Tables).
* **No API or merchant account required** - use your existing personal or agent number.
* **Lightweight and fast** - no bloat, minimal impact on checkout speed.

= Key Features =

* Accept payments via **bKash, Nagad, Rocket and Payoneer**.
* Choose **Agent** or **Personal** account type for each gateway.
* Show your receiving number/email and custom instructions on the checkout page.
* Collect the customer's **sender number and Transaction ID** for easy verification.
* Optional **send money charge** (e.g. bKash 1.85%, Nagad 1.45%) added automatically to the order total.
* **Advance / partial payment** - let customers pay only the delivery charge in advance, with a custom "Advance Received" order status (great for reducing fake cash-on-delivery orders).
* Transaction ID and account number shown on the **admin order screen** and order list columns.
* Custom **thank-you page message** and order email instructions per gateway.
* Number and Transaction ID validation on both classic and block checkout.
* Translation ready.

= Perfect for =

* Bangladeshi WooCommerce and WordPress stores.
* F-commerce (Facebook commerce) sellers.
* Small and medium businesses accepting bKash, Nagad or Rocket.
* Stores that want to collect an advance delivery charge to cut down on fake orders.

= How it works =

1. The customer selects bKash, Nagad, Rocket or Payoneer at checkout.
2. They send money to your displayed number/email.
3. They enter their sending number and Transaction ID and place the order.
4. You confirm the payment and update the order status from your dashboard.

== How to use ==

[youtube https://www.youtube.com/watch?v=yrK5dhQpX68]

== Please note: ==

- This is a WooCommerce plugin, requiring WooCommerce activation.
- You need accounts with bKash, Nagad, Rocket, or Payoneer to receive payments.

For suggestions and support, contact us [here](https://codecarebd.com/contact).

== Frequently Asked Questions ==

= Is this plugin free? =

Yes. CodeCareBD - Payment Gateway for WooCommerce is completely free. The plugin never charges any fee. Standard bKash/Nagad/Rocket send money or cash out charges from the providers still apply to you as the account holder.

= Do I need a bKash/Nagad merchant account or payment API? =

No. This is a manual payment gateway. You can use your existing personal or agent bKash, Nagad or Rocket number. Customers send money and submit the Transaction ID, which you verify manually. No API keys or merchant onboarding required.

= Does it work with the new WooCommerce block checkout? =

Yes. Version 1.1 adds full support for the WooCommerce Cart & Checkout Blocks, which is the default checkout for new stores. It also keeps working on the classic shortcode checkout.

= Is it compatible with HPOS (High-Performance Order Storage)? =

Yes. The plugin declares HPOS compatibility and stores all order data using the WooCommerce order CRUD API, so transaction details display correctly whether HPOS or the legacy storage is enabled.

= Can customers pay only the delivery charge in advance? =

Yes. Enable the Advance Payment option and customers can pay just the shipping/delivery charge up front. The order is marked "Advance Received" and the remaining amount is shown to you and the customer.

= Which currencies are supported? =

The plugin works with your WooCommerce currency. It is designed primarily for BDT (Bangladeshi Taka) but does not restrict the store currency.

= Is WooCommerce required? =

Yes. WooCommerce must be installed and active for this plugin to work.

== Privacy & Data Sharing ==

This plugin can send usage and diagnostic data to the developer to help fix bugs and prioritise features. **This is disabled by default.** Nothing is collected or sent unless you explicitly opt in via the admin notice shown after activation. Declining (or ignoring) the notice leaves the plugin fully functional.

There are two separate, optional opt-ins:

1. Usage & diagnostics. When enabled, we collect: WordPress, PHP, MySQL and WooCommerce versions; your active theme, locale and whether the site is multisite; the plugin version and activation/deactivation/update events; which of the plugin's features are enabled; and a one-way (SHA-256) hash of your site URL. The raw site URL is never sent.

2. Product update emails (separate checkbox). Only if you tick this, we additionally collect your site administrator email to send occasional product updates.

You can change or withdraw your choice at any time from **Settings → Data Sharing** in your WordPress admin. Turning data sharing off stops all collection and requests deletion of previously collected data. Uninstalling does the same.

Data is sent over HTTPS to https://track.shakvaro.cloud and is handled as described in our privacy policy: https://shakvaro.com/wp-insights/privacy

== Screenshots ==

1. Payment Settings (bKash).
2. Payment Settings (Rocket).
3. Payment Settings (Nagad).
4. Payment Settings (Payoneer).
5. Checkout Page.

== Changelog ==

= 1.3.1 - 2026-06-20 =
* FIXED: Deleting then reinstalling the plugin no longer creates a duplicate record in usage analytics — the install identity is now derived from the site, so a reinstall reuses the same record. (Shakvaro WP Insights SDK 1.2.7.)

= 1.3 - 2026-06-20 =
* FIXED: Activation event now correctly reported to Shakvaro WP Insights on plugin (re)activation.

= 1.2 - 2026-06-16 =
* NEW: Optional, privacy-first usage analytics (Shakvaro WP Insights) to help us fix bugs and prioritize features. Disabled by default; nothing is collected unless you opt in. See the "Privacy & Data Sharing" section and manage it any time under Settings -> Data Sharing.
* NEW: Deletion/erasure request sent and local data cleaned on uninstall.

= 1.1 - 2026-06-12 =
* NEW: WooCommerce Cart & Checkout Blocks support - all four gateways (bKash, Nagad, Rocket, Payoneer) now appear and work on the block-based checkout (default for new WooCommerce stores).
* NEW: Declared High-Performance Order Storage (HPOS) compatibility.
* FIXED: Order number/Transaction ID are now stored and read via WooCommerce order CRUD, so they display correctly under HPOS.
* IMPROVED: Shared, single-source validation for both classic and block checkout.
* IMPROVED: Added Requires Plugins / WC requires/tested headers; refreshed "Tested up to" for the latest WordPress and WooCommerce.
* IMPROVED: Checkout assets are versioned by plugin version instead of a per-request timestamp.

= 1.0 - 2026-02-03 =
* SECURITY: Fixed $_POST array access without isset() checks
* SECURITY: Fixed array offset warnings when payment gateway settings don't exist
* SECURITY: Added proper sanitization before validation in all payment methods
* SECURITY: Fixed variable naming issues (Payoneer email was incorrectly named)
* IMPROVED: Better input validation with defense in depth (isset + empty checks)
* IMPROVED: Code quality and WordPress coding standards compliance
* FIXED: PHP notices and warnings on checkout page

= 0.9 - 2025-11-28 =
* NEW: Added optional Advance Payment feature
* NEW: Custom order status "Advance Received" for advance payments
* NEW: Customers can pay only delivery/shipping charge as advance payment
* NEW: Settings page for advance payment configuration
* NEW: Customizable advance payment text messages
* NEW: Admin order details show advance payment information
* IMPROVED: Better payment amount calculations
* IMPROVED: Enhanced admin order display with advance payment breakdown
* FIXED: Remaining payment amount calculation accuracy
* Updated tested up to WordPress 6.7.4

= 0.8 - 2024-12-25 =
* Validation Error Fix.

= 0.5 - 2024-02-16 =
* Fixed issues on Single Order Page.

= 0.4 - 2024-02-13 =
* Updated for new WooCommerce version.
* Fixed validation issues.

= 0.3 - 2023-09-01 =
* Bug Fixes.

= 0.2 - 2023-08-24 =
* Small Fixes.

= 0.1 - 2022-09-21 =
* First release.

== Upgrade Notice ==

= 1.3 =
Fixes activation event tracking in Shakvaro WP Insights so (re)activations are correctly reported.

= 1.2 =
Adds optional, opt-in usage analytics (off by default) to help improve the plugin, with full data-sharing controls and erasure on uninstall.

= 1.1 =
Adds WooCommerce block checkout support and HPOS compatibility, and fixes order meta storage under HPOS. Recommended for all users on modern WooCommerce.
