<?php
if ( ! defined( 'ABSPATH' ) ) exit;

function hrml_print_inline_styles() {
    static $printed = false;
    if ( $printed ) return;
    $printed = true;
    ?>
    <style>
        .hrml-card{background:#fff;border:1px solid #e2e2e2;border-radius:6px;padding:16px 20px;margin-bottom:12px;}
        .hrml-notice-urgent{border-left:4px solid #d63638;}
        .hrml-notice-normal{border-left:4px solid #2271b1;}
        .hrml-badge{display:inline-block;font-size:11px;padding:2px 8px;border-radius:10px;color:#fff;margin-left:8px;vertical-align:middle;}
        .hrml-badge-urgent{background:#d63638;}
        .hrml-badge-normal{background:#2271b1;}
        .hrml-holiday-row{display:flex;justify-content:space-between;padding:10px 0;border-bottom:1px solid #eee;}
        .hrml-holiday-row:last-child{border-bottom:none;}
        .hrml-employee-grid{display:flex;flex-wrap:wrap;gap:16px;}
        .hrml-employee-card{width:180px;text-align:center;background:#fff;border:1px solid #e2e2e2;border-radius:6px;padding:16px;}
        .hrml-employee-card img{width:80px;height:80px;object-fit:cover;border-radius:50%;margin-bottom:10px;}
        .hrml-employee-card h4{margin:0 0 4px;}
        .hrml-employee-card p{margin:2px 0;color:#555;font-size:13px;}
    </style>
    <?php
}

/** [hr_notice_board limit="5"] */
function hrml_shortcode_notice_board( $atts ) {
    global $wpdb;
    $atts = shortcode_atts( array( 'limit' => 5 ), $atts );
    hrml_print_inline_styles();

    $today = date( 'Y-m-d' );
    $notices = $wpdb->get_results( $wpdb->prepare(
        "SELECT * FROM {$wpdb->prefix}hr_notices
         WHERE expiry_date IS NULL OR expiry_date = '' OR expiry_date >= %s
         ORDER BY created_at DESC LIMIT %d",
        $today, intval( $atts['limit'] )
    ) );

    if ( empty( $notices ) ) {
        return '<p>No active notices right now.</p>';
    }

    ob_start();
    foreach ( $notices as $notice ) {
        $priority = $notice->priority ? $notice->priority : 'normal';
        ?>
        <div class="hrml-card hrml-notice-<?php echo esc_attr( $priority ); ?>">
            <strong><?php echo esc_html( $notice->title ); ?></strong>
            <span class="hrml-badge hrml-badge-<?php echo esc_attr( $priority ); ?>"><?php echo esc_html( ucfirst( $priority ) ); ?></span>
            <div><?php echo wp_kses_post( wpautop( $notice->content ) ); ?></div>
        </div>
        <?php
    }
    return ob_get_clean();
}
add_shortcode( 'hr_notice_board', 'hrml_shortcode_notice_board' );

/** [hr_holiday_calendar] */
function hrml_shortcode_holiday_calendar() {
    global $wpdb;
    hrml_print_inline_styles();

    $holidays = $wpdb->get_results( "SELECT * FROM {$wpdb->prefix}hr_holidays ORDER BY holiday_date ASC" );
    if ( empty( $holidays ) ) {
        return '<p>No holidays added yet.</p>';
    }

    ob_start();
    echo '<div class="hrml-card">';
    foreach ( $holidays as $holiday ) {
        $formatted_date = $holiday->holiday_date ? date_i18n( 'd F, Y', strtotime( $holiday->holiday_date ) ) : '—';
        ?>
        <div class="hrml-holiday-row">
            <span><?php echo esc_html( $holiday->name ); ?></span>
            <span><?php echo esc_html( $formatted_date ); ?></span>
        </div>
        <?php
    }
    echo '</div>';
    return ob_get_clean();
}
add_shortcode( 'hr_holiday_calendar', 'hrml_shortcode_holiday_calendar' );

/** [hr_employee_directory department="3"] */
function hrml_shortcode_employee_directory( $atts ) {
    global $wpdb;
    $atts = shortcode_atts( array( 'department' => '' ), $atts );
    hrml_print_inline_styles();

    if ( $atts['department'] ) {
        $employees = $wpdb->get_results( $wpdb->prepare(
            "SELECT * FROM {$wpdb->prefix}hr_employees WHERE department_id = %d ORDER BY name ASC",
            intval( $atts['department'] )
        ) );
    } else {
        $employees = $wpdb->get_results( "SELECT * FROM {$wpdb->prefix}hr_employees ORDER BY name ASC" );
    }

    if ( empty( $employees ) ) {
        return '<p>No employees found.</p>';
    }

    ob_start();
    echo '<div class="hrml-employee-grid">';
    foreach ( $employees as $employee ) {
        ?>
        <div class="hrml-employee-card">
            <?php if ( ! empty( $employee->photo_url ) ) : ?>
                <img src="<?php echo esc_url( $employee->photo_url ); ?>" alt="<?php echo esc_attr( $employee->name ); ?>">
            <?php endif; ?>
            <h4><?php echo esc_html( $employee->name ); ?></h4>
            <p><?php echo esc_html( hrml_get_designation_name( $employee->designation_id ) ); ?></p>
            <p><?php echo esc_html( hrml_get_department_name( $employee->department_id ) ); ?></p>
        </div>
        <?php
    }
    echo '</div>';
    return ob_get_clean();
}
add_shortcode( 'hr_employee_directory', 'hrml_shortcode_employee_directory' );
