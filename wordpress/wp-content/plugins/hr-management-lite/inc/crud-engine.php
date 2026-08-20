<?php
if ( ! defined( 'ABSPATH' ) ) exit;

/** Full table name with $wpdb prefix */
function hrml_table_name( $module_key ) {
    global $wpdb;
    $module = hrml_get_module( $module_key );
    return $wpdb->prefix . $module['table'];
}

/** Resolve a foreign-key / select value into a human-readable label for list display */
function hrml_format_column_value( $module_key, $field_key, $value ) {
    $module = hrml_get_module( $module_key );
    $field  = $module['fields'][ $field_key ];

    if ( $field['type'] === 'select_department' ) {
        return hrml_get_department_name( $value );
    }
    if ( $field['type'] === 'select_designation' ) {
        return hrml_get_designation_name( $value );
    }
    if ( $field['type'] === 'select' && isset( $field['options'][ $value ] ) ) {
        return $field['options'][ $value ];
    }
    if ( $field['type'] === 'date' && $value ) {
        return date_i18n( 'd M, Y', strtotime( $value ) );
    }
    return $value;
}

function hrml_get_department_name( $id ) {
    global $wpdb;
    if ( ! $id ) return '—';
    $name = $wpdb->get_var( $wpdb->prepare( "SELECT name FROM {$wpdb->prefix}hr_departments WHERE id = %d", $id ) );
    return $name ? $name : '—';
}

function hrml_get_designation_name( $id ) {
    global $wpdb;
    if ( ! $id ) return '—';
    $name = $wpdb->get_var( $wpdb->prepare( "SELECT name FROM {$wpdb->prefix}hr_designations WHERE id = %d", $id ) );
    return $name ? $name : '—';
}

/**
 * Handle delete requests (?action=delete&id=X). Runs early via admin_init
 * so it can redirect before any page output starts.
 */
function hrml_handle_delete_requests() {
    if ( ! isset( $_GET['hrml_action'] ) || $_GET['hrml_action'] !== 'delete' ) return;
    if ( ! isset( $_GET['module'], $_GET['id'], $_GET['_wpnonce'] ) ) return;

    $module_key = sanitize_key( $_GET['module'] );
    $id         = absint( $_GET['id'] );

    if ( ! wp_verify_nonce( $_GET['_wpnonce'], 'hrml_delete_' . $module_key . '_' . $id ) ) {
        wp_die( 'Security check failed.' );
    }
    if ( ! current_user_can( 'manage_options' ) ) return;

    $module = hrml_get_module( $module_key );
    if ( ! $module ) return;

    global $wpdb;
    $wpdb->delete( hrml_table_name( $module_key ), array( 'id' => $id ) );

    wp_safe_redirect( admin_url( 'admin.php?page=' . $module['menu_slug'] . '&deleted=1' ) );
    exit;
}
add_action( 'admin_init', 'hrml_handle_delete_requests' );

/**
 * Renders the List page for a module: table of rows + Add New button.
 */
function hrml_render_list_page( $module_key ) {
    global $wpdb;
    $module = hrml_get_module( $module_key );
    $table  = hrml_table_name( $module_key );
    $rows   = $wpdb->get_results( "SELECT * FROM $table ORDER BY id DESC" );

    $add_url = admin_url( 'admin.php?page=' . $module['menu_slug'] . '-add' );
    ?>
    <div class="wrap">
        <h1 class="wp-heading-inline"><?php echo esc_html( $module['plural'] ); ?></h1>
        <a href="<?php echo esc_url( $add_url ); ?>" class="page-title-action">Add New</a>

        <?php if ( isset( $_GET['deleted'] ) ) : ?>
            <div class="notice notice-success is-dismissible"><p>Deleted successfully.</p></div>
        <?php endif; ?>
        <?php if ( isset( $_GET['saved'] ) ) : ?>
            <div class="notice notice-success is-dismissible"><p>Saved successfully.</p></div>
        <?php endif; ?>

        <table class="wp-list-table widefat fixed striped">
            <thead>
                <tr>
                    <?php foreach ( $module['list_columns'] as $col ) : ?>
                        <th><?php echo esc_html( $module['fields'][ $col ]['label'] ); ?></th>
                    <?php endforeach; ?>
                    <th style="width:160px;">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php if ( empty( $rows ) ) : ?>
                    <tr><td colspan="<?php echo count( $module['list_columns'] ) + 1; ?>">No <?php echo esc_html( strtolower( $module['plural'] ) ); ?> found yet.</td></tr>
                <?php else : foreach ( $rows as $row ) : ?>
                    <tr>
                        <?php foreach ( $module['list_columns'] as $col ) : ?>
                            <td><?php echo esc_html( hrml_format_column_value( $module_key, $col, $row->$col ) ); ?></td>
                        <?php endforeach; ?>
                        <td>
                            <?php
                            $edit_url   = admin_url( 'admin.php?page=' . $module['menu_slug'] . '-edit&id=' . $row->id );
                            $delete_url = wp_nonce_url(
                                admin_url( 'admin.php?page=' . $module['menu_slug'] . '&hrml_action=delete&module=' . $module_key . '&id=' . $row->id ),
                                'hrml_delete_' . $module_key . '_' . $row->id
                            );
                            ?>
                            <a href="<?php echo esc_url( $edit_url ); ?>">Edit</a> |
                            <a href="<?php echo esc_url( $delete_url ); ?>" onclick="return confirm('Are you sure you want to delete this?');" style="color:#b32d2e;">Delete</a>
                        </td>
                    </tr>
                <?php endforeach; endif; ?>
            </tbody>
        </table>
    </div>
    <?php
}

/**
 * Renders the Add/Edit form page for a module and handles saving.
 */
function hrml_render_form_page( $module_key ) {
    global $wpdb;
    $module = hrml_get_module( $module_key );
    $table  = hrml_table_name( $module_key );

    $id       = isset( $_GET['id'] ) ? absint( $_GET['id'] ) : 0;
    $is_edit  = $id > 0;
    $row      = $is_edit ? $wpdb->get_row( $wpdb->prepare( "SELECT * FROM $table WHERE id = %d", $id ) ) : null;

    if ( $is_edit && ! $row ) {
        echo '<div class="wrap"><p>Item not found.</p></div>';
        return;
    }

    // Handle form submission
    if ( isset( $_POST['hrml_submit'] ) ) {
        if ( ! isset( $_POST['hrml_form_nonce'] ) || ! wp_verify_nonce( $_POST['hrml_form_nonce'], 'hrml_save_' . $module_key ) ) {
            wp_die( 'Security check failed.' );
        }

        $data = array();
        foreach ( $module['fields'] as $key => $field ) {
            $raw = isset( $_POST[ $key ] ) ? wp_unslash( $_POST[ $key ] ) : '';
            if ( in_array( $field['type'], array( 'select_department', 'select_designation' ), true ) ) {
                $data[ $key ] = absint( $raw );
            } elseif ( $field['type'] === 'textarea' ) {
                $data[ $key ] = sanitize_textarea_field( $raw );
            } elseif ( $field['type'] === 'date' ) {
                $data[ $key ] = sanitize_text_field( $raw );
            } else {
                $data[ $key ] = sanitize_text_field( $raw );
            }
        }

        if ( $is_edit ) {
            $wpdb->update( $table, $data, array( 'id' => $id ) );
        } else {
            $wpdb->insert( $table, $data );
        }

        wp_safe_redirect( admin_url( 'admin.php?page=' . $module['menu_slug'] . '&saved=1' ) );
        exit;
    }
    ?>
    <div class="wrap">
        <h1><?php echo $is_edit ? 'Edit ' . esc_html( $module['singular'] ) : 'Add New ' . esc_html( $module['singular'] ); ?></h1>

        <form method="post">
            <?php wp_nonce_field( 'hrml_save_' . $module_key, 'hrml_form_nonce' ); ?>
            <table class="form-table">
                <?php foreach ( $module['fields'] as $key => $field ) :
                    $value = $row ? $row->$key : '';
                ?>
                    <tr>
                        <th style="width:200px;"><label for="<?php echo esc_attr( $key ); ?>"><?php echo esc_html( $field['label'] ); ?><?php echo ! empty( $field['required'] ) ? ' *' : ''; ?></label></th>
                        <td><?php hrml_render_field_input( $key, $field, $value ); ?></td>
                    </tr>
                <?php endforeach; ?>
            </table>
            <?php submit_button( $is_edit ? 'Update' : 'Add', 'primary', 'hrml_submit' ); ?>
        </form>
    </div>
    <?php
}

/** Renders a single form input based on its field type */
function hrml_render_field_input( $key, $field, $value ) {
    switch ( $field['type'] ) {

        case 'textarea':
            printf( '<textarea id="%1$s" name="%1$s" rows="4" style="width:100%%;">%2$s</textarea>', esc_attr( $key ), esc_textarea( $value ) );
            break;

        case 'date':
            printf( '<input type="date" id="%1$s" name="%1$s" value="%2$s">', esc_attr( $key ), esc_attr( $value ) );
            break;

        case 'select':
            echo '<select id="' . esc_attr( $key ) . '" name="' . esc_attr( $key ) . '">';
            foreach ( $field['options'] as $opt_val => $opt_label ) {
                printf( '<option value="%1$s"%2$s>%3$s</option>', esc_attr( $opt_val ), selected( $value, $opt_val, false ), esc_html( $opt_label ) );
            }
            echo '</select>';
            break;

        case 'select_department':
            global $wpdb;
            $departments = $wpdb->get_results( "SELECT id, name FROM {$wpdb->prefix}hr_departments ORDER BY name ASC" );
            echo '<select id="' . esc_attr( $key ) . '" name="' . esc_attr( $key ) . '">';
            echo '<option value="">— Select Department —</option>';
            foreach ( $departments as $dept ) {
                printf( '<option value="%1$s"%2$s>%3$s</option>', esc_attr( $dept->id ), selected( $value, $dept->id, false ), esc_html( $dept->name ) );
            }
            echo '</select>';
            break;

        case 'select_designation':
            global $wpdb;
            $designations = $wpdb->get_results( "SELECT id, name FROM {$wpdb->prefix}hr_designations ORDER BY name ASC" );
            echo '<select id="' . esc_attr( $key ) . '" name="' . esc_attr( $key ) . '">';
            echo '<option value="">— Select Designation —</option>';
            foreach ( $designations as $desig ) {
                printf( '<option value="%1$s"%2$s>%3$s</option>', esc_attr( $desig->id ), selected( $value, $desig->id, false ), esc_html( $desig->name ) );
            }
            echo '</select>';
            break;

        default: // text
            printf( '<input type="text" id="%1$s" name="%1$s" value="%2$s" style="width:100%%;">', esc_attr( $key ), esc_attr( $value ) );
    }
}
