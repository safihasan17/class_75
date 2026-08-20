<?php

/**
 * WooCommerce Cart & Checkout Blocks integration for the CodeCareBD gateways.
 *
 * One instance is registered per gateway (ccd_bkash, ccd_nagad, ccd_rocket,
 * ccd_payoneer). It exposes the gateway to the block checkout, enqueues the
 * shared client script and passes the per-gateway data the script needs.
 */

if (!defined('ABSPATH')) {
    exit;
}

if (!class_exists('Automattic\WooCommerce\Blocks\Payments\Integrations\AbstractPaymentMethodType')) {
    return;
}

class CCD_Blocks_Support extends \Automattic\WooCommerce\Blocks\Payments\Integrations\AbstractPaymentMethodType
{
    /**
     * Gateway settings (woocommerce_<id>_settings).
     *
     * @var array
     */
    protected $settings = array();

    /**
     * @param string $name Gateway id (e.g. ccd_bkash).
     */
    public function __construct($name)
    {
        $this->name = $name;
    }

    /**
     * Load the gateway settings.
     */
    public function initialize()
    {
        $this->settings = get_option('woocommerce_' . $this->name . '_settings', array());
        if (!is_array($this->settings)) {
            $this->settings = array();
        }
    }

    /**
     * Whether the gateway is enabled.
     *
     * @return bool
     */
    public function is_active()
    {
        return isset($this->settings['enabled']) && 'yes' === $this->settings['enabled'];
    }

    /**
     * Register and return the script handle(s) for this payment method.
     *
     * The same bundled script powers all four gateways; it is registered once
     * and reused.
     *
     * @return string[]
     */
    public function get_payment_method_script_handles()
    {
        $handle = 'ccd-blocks-integration';

        if (!wp_script_is($handle, 'registered')) {
            wp_register_script(
                $handle,
                CCD_PAYMENT_GATEWAY_PLUGIN_URL . 'assets/js/blocks/ccd-blocks.js',
                array('wc-blocks-registry', 'wc-settings', 'wp-element', 'wp-html-entities', 'wp-i18n'),
                CCD_PAYMENT_GATEWAY_VERSION,
                true
            );

            if (function_exists('wp_set_script_translations')) {
                wp_set_script_translations($handle, 'ccd-payment-gateway-domain');
            }
        }

        return array($handle);
    }

    /**
     * Per-gateway configuration map.
     *
     * @return array
     */
    protected function ccd_config()
    {
        $configs = array(
            'ccd_bkash' => array(
                'title_key'        => 'bkash_title',
                'title_default'    => __('Payment With bKash', 'ccd-payment-gateway-domain'),
                'desc_key'         => 'bkash_description',
                'number_key'       => 'bkash_number',
                'type_key'         => 'bkash_account_type',
                'charge_key'       => 'bkash_charge',
                'charge_label'     => __('Note: 1.85% bKash "Send Money" cost will be added with the net price.', 'ccd-payment-gateway-domain'),
                'account_label'    => 'bKash',
                'icon'             => 'assets/img/bkash.png',
                'fields'           => array(
                    array('name' => 'bkash_number', 'label' => __('bKash Number', 'ccd-payment-gateway-domain'), 'placeholder' => 'Ex. 018XXXXXXXX', 'type' => 'tel'),
                    array('name' => 'bkash_transaction_id', 'label' => __('bKash Transaction ID', 'ccd-payment-gateway-domain'), 'placeholder' => 'Ex. 8N7A6D5EE7M', 'type' => 'text'),
                ),
            ),
            'ccd_nagad' => array(
                'title_key'        => 'ccd_nagad_title',
                'title_default'    => __('Payment With Nagad', 'ccd-payment-gateway-domain'),
                'desc_key'         => 'ccd_nagad_description',
                'number_key'       => 'ccd_nagad_number',
                'type_key'         => 'ccd_nagad_account_type',
                'charge_key'       => 'ccd_nagad_charge',
                'charge_label'     => __('Note: 1.45% Nagad "Send Money" cost will be added with the net price.', 'ccd-payment-gateway-domain'),
                'account_label'    => 'Nagad',
                'icon'             => 'assets/img/nagad.png',
                'fields'           => array(
                    array('name' => 'ccd_nagad_number', 'label' => __('Nagad Number', 'ccd-payment-gateway-domain'), 'placeholder' => 'Ex. 018XXXXXXXX', 'type' => 'tel'),
                    array('name' => 'ccd_nagad_transaction_id', 'label' => __('Nagad Transaction ID', 'ccd-payment-gateway-domain'), 'placeholder' => 'Ex. 8N7A6D5EE7M', 'type' => 'text'),
                ),
            ),
            'ccd_rocket' => array(
                'title_key'        => 'ccd_rocket_title',
                'title_default'    => __('Payment With Rocket', 'ccd-payment-gateway-domain'),
                'desc_key'         => 'ccd_rocket_description',
                'number_key'       => 'ccd_rocket_number',
                'type_key'         => 'ccd_rocket_account_type',
                'charge_key'       => 'ccd_rocket_charge',
                'charge_label'     => __('Note: 1.85% Rocket "Send Money" cost will be added with the net price.', 'ccd-payment-gateway-domain'),
                'account_label'    => 'Rocket',
                'icon'             => 'assets/img/rocket.png',
                'fields'           => array(
                    array('name' => 'ccd_rocket_number', 'label' => __('Rocket Number', 'ccd-payment-gateway-domain'), 'placeholder' => 'Ex. 018XXXXXXXX', 'type' => 'tel'),
                    array('name' => 'ccd_rocket_transaction_id', 'label' => __('Rocket Transaction ID', 'ccd-payment-gateway-domain'), 'placeholder' => 'Ex. 8N7A6D5EE7M', 'type' => 'text'),
                ),
            ),
            'ccd_payoneer' => array(
                'title_key'        => 'ccd_payoneer_title',
                'title_default'    => __('Payment With Payoneer', 'ccd-payment-gateway-domain'),
                'desc_key'         => 'ccd_payoneer_description',
                'number_key'       => 'ccd_payoneer_recipient_email',
                'type_key'         => '',
                'charge_key'       => '',
                'charge_label'     => '',
                'account_label'    => 'Payoneer',
                'icon'             => 'assets/img/payoneer.png',
                'fields'           => array(
                    array('name' => 'ccd_payoneeer_sender_email', 'label' => __('Payoneer Email', 'ccd-payment-gateway-domain'), 'placeholder' => 'Ex. example@example.com', 'type' => 'email'),
                    array('name' => 'ccd_payoneer_transaction_id', 'label' => __('Transaction ID', 'ccd-payment-gateway-domain'), 'placeholder' => 'Ex. 8N7A6D5EE7M', 'type' => 'text'),
                ),
            ),
        );

        return isset($configs[$this->name]) ? $configs[$this->name] : array();
    }

    /**
     * Data exposed to the client script as wcSettings('<name>_data').
     *
     * @return array
     */
    public function get_payment_method_data()
    {
        $config = $this->ccd_config();
        if (empty($config)) {
            return array();
        }

        $title       = !empty($this->settings[$config['title_key']]) ? $this->settings[$config['title_key']] : $config['title_default'];
        $description = isset($this->settings[$config['desc_key']]) ? $this->settings[$config['desc_key']] : '';

        // Receiver account/email line shown to the customer.
        $account_info = '';
        if (!empty($config['number_key']) && !empty($this->settings[$config['number_key']])) {
            $receiver = $this->settings[$config['number_key']];
            if ('ccd_payoneer' === $this->name) {
                $account_info = sprintf(
                    /* translators: %s: Payoneer recipient email */
                    __('Payoneer Recipient Email : %s', 'ccd-payment-gateway-domain'),
                    $receiver
                );
            } else {
                $account_type = (!empty($config['type_key']) && !empty($this->settings[$config['type_key']])) ? $this->settings[$config['type_key']] : '';
                $account_info = trim(sprintf('%s %s Number : %s', $config['account_label'], $account_type, $receiver));
            }
        }

        // Charge note (only when the "send money" charge is enabled).
        $charge_note = '';
        if (!empty($config['charge_key']) && isset($this->settings[$config['charge_key']]) && 'yes' === $this->settings[$config['charge_key']]) {
            $charge_note = $config['charge_label'];
        }

        return array(
            'title'          => wp_strip_all_tags($title),
            'description'    => wp_strip_all_tags($description),
            'accountInfo'    => $account_info,
            'chargeNote'     => $charge_note,
            'icon'           => CCD_PAYMENT_GATEWAY_PLUGIN_URL . $config['icon'],
            'fields'         => $config['fields'],
            'advancePayment' => ccd_get_advance_payment_display(),
            'supports'       => $this->get_supported_features(),
        );
    }

    /**
     * Supported block features.
     *
     * @return string[]
     */
    public function get_supported_features()
    {
        return array('products');
    }
}
