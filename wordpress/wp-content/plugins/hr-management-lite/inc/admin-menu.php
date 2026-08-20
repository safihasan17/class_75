<?php
if ( ! defined( 'ABSPATH' ) ) exit;

function hrml_admin_menu() {

    // ---------- Top level menu ----------
    add_menu_page(
        'HR Management',            // page title
        'HR Management',            // menu title
        'manage_options',           // capability
        'hr-management',            // menu slug
        'hrml_dashboard_page',      // callback function
        'dashicons-groups',         // icon
        26                          // position
    );

    // ---------- Loop through every module and register List + Add + (hidden) Edit ----------
    foreach ( hrml_get_modules() as $module_key => $module ) {

        // List page (visible submenu)
        add_submenu_page(
            'hr-management',                          // parent slug
            $module['plural'],                        // page title
            $module['plural'],                        // menu title
            'manage_options',                         // capability
            $module['menu_slug'],                     // menu slug, e.g. hr-employees
            function () use ( $module_key ) {
                hrml_render_list_page( $module_key );
            }
        );

        // Add New page (visible submenu)
        add_submenu_page(
            'hr-management',                          // parent slug
            'Add ' . $module['singular'],
            'Add ' . $module['singular'],
            'manage_options',
            $module['menu_slug'] . '-add',            // e.g. hr-employees-add
            function () use ( $module_key ) {
                hrml_render_form_page( $module_key );
            }
        );

        // Edit page — registered under the real parent (required for the page
        // to work when linked to directly), then hidden from the menu below.
        add_submenu_page(
            'hr-management',
            'Edit ' . $module['singular'],
            'Edit ' . $module['singular'],
            'manage_options',
            $module['menu_slug'] . '-edit',           // e.g. hr-employees-edit
            function () use ( $module_key ) {
                hrml_render_form_page( $module_key );
            }
        );
    }
}
add_action( 'admin_menu', 'hrml_admin_menu' );

/**
 * Hide the "Edit" pages from the sidebar (they stay reachable via the
 * Edit links in each list table, they just shouldn't clutter the menu).
 */
function hrml_hide_edit_submenus() {
    foreach ( hrml_get_modules() as $module ) {
        remove_submenu_page( 'hr-management', $module['menu_slug'] . '-edit' );
    }
}
add_action( 'admin_menu', 'hrml_hide_edit_submenus', 999 );

function hrml_dashboard_page() {
    global $wpdb;
    ?>
    <div class="wrap">
        <h1>HR Management — Overview</h1>
        <p>Use the submenus on the left to manage each module.</p>
        <div style="display:flex; gap:20px; flex-wrap:wrap; margin-top:20px;">
            <?php foreach ( hrml_get_modules() as $module_key => $module ) :
                $table = hrml_table_name( $module_key );
                $count = $wpdb->get_var( "SELECT COUNT(*) FROM $table" );
            ?>
                <a href="<?php echo esc_url( admin_url( 'admin.php?page=' . $module['menu_slug'] ) ); ?>" style="text-decoration:none;">
                    <div style="background:#fff; border:1px solid #ccd0d4; border-radius:4px; padding:20px 30px; min-width:150px; text-align:center;">
                        <div style="font-size:28px; font-weight:bold; color:#2271b1;"><?php echo esc_html( $count ); ?></div>
                        <div style="margin-top:5px; color:#333;"><?php echo esc_html( $module['plural'] ); ?></div>
                    </div>
                </a>
            <?php endforeach; ?>
        </div>
    </div>
    <?php
}
