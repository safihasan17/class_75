/**
 * CodeCareBD — WooCommerce Cart & Checkout Blocks integration.
 *
 * Registers the four manual gateways (bKash, Nagad, Rocket, Payoneer) as block
 * payment methods. No build step: this uses the WordPress/WooCommerce script
 * globals (wc-blocks-registry, wp-element, etc.) directly.
 */
(function () {
    'use strict';

    if (!window.wc || !window.wc.wcBlocksRegistry || !window.wc.wcSettings) {
        return;
    }

    var registerPaymentMethod = window.wc.wcBlocksRegistry.registerPaymentMethod;
    var getSetting = window.wc.wcSettings.getSetting;
    var el = window.wp.element.createElement;
    var useEffect = window.wp.element.useEffect;
    var decodeEntities = window.wp.htmlEntities.decodeEntities;
    var __ = window.wp.i18n.__;

    var GATEWAYS = ['ccd_bkash', 'ccd_nagad', 'ccd_rocket', 'ccd_payoneer'];

    /**
     * Client-side validation mirroring the server (ccd_validate_payment_fields).
     *
     * @param {string} id     Gateway id.
     * @param {Array}  fields Field descriptors [number/email, transaction].
     * @param {Object} values Current field values.
     * @return {string[]} Error messages (empty when valid).
     */
    function validate(id, fields, values) {
        var errors = [];
        var primary = fields[0];
        var trx = fields[1];
        var primaryVal = (values[primary.name] || '').trim();
        var trxVal = (values[trx.name] || '').trim();

        if (id === 'ccd_payoneer') {
            if (primaryVal === '') {
                errors.push(__('Please enter your Payoneer sender email.', 'ccd-payment-gateway-domain'));
            } else if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(primaryVal)) {
                errors.push(__('Please enter a valid Payoneer sender email.', 'ccd-payment-gateway-domain'));
            }
            if (trxVal === '') {
                errors.push(__('Please enter your Payoneer transaction ID.', 'ccd-payment-gateway-domain'));
            } else if (trxVal.length < 5) {
                errors.push(__('Please enter a valid Payoneer transaction ID.', 'ccd-payment-gateway-domain'));
            }
        } else {
            if (primaryVal === '') {
                errors.push(__('Please enter your number.', 'ccd-payment-gateway-domain'));
            } else if (!/^[0-9]{11}$/.test(primaryVal)) {
                errors.push(__('Please enter a valid phone number.', 'ccd-payment-gateway-domain'));
            }
            if (trxVal === '') {
                errors.push(__('Please enter your transaction ID.', 'ccd-payment-gateway-domain'));
            } else if (trxVal.length < 5) {
                errors.push(__('Please enter a valid transaction ID.', 'ccd-payment-gateway-domain'));
            }
        }

        return errors;
    }

    GATEWAYS.forEach(function (id) {
        var data = getSetting(id + '_data', null);
        if (!data || !data.fields || !data.fields.length) {
            return;
        }

        // Module-scoped store of the latest field values for this gateway.
        var values = {};

        /**
         * The content rendered under the payment method in block checkout.
         */
        var Content = function (props) {
            var eventRegistration = props.eventRegistration;
            var emitResponse = props.emitResponse;
            var onPaymentSetup = eventRegistration.onPaymentSetup;

            useEffect(function () {
                var unsubscribe = onPaymentSetup(function () {
                    var errors = validate(id, data.fields, values);
                    if (errors.length) {
                        return {
                            type: emitResponse.responseTypes.ERROR,
                            message: errors.join(' '),
                            messageContext: emitResponse.noticeContexts.PAYMENTS
                        };
                    }
                    var paymentMethodData = {};
                    data.fields.forEach(function (f) {
                        paymentMethodData[f.name] = values[f.name] || '';
                    });
                    return {
                        type: emitResponse.responseTypes.SUCCESS,
                        meta: { paymentMethodData: paymentMethodData }
                    };
                });
                return unsubscribe;
            }, [onPaymentSetup, emitResponse.responseTypes, emitResponse.noticeContexts]);

            var children = [];

            if (data.description) {
                children.push(el('p', { key: 'desc' }, decodeEntities(data.description)));
            }

            if (data.accountInfo) {
                children.push(el('p', { key: 'account', className: 'ccd-blocks-account-info' },
                    el('strong', null, decodeEntities(data.accountInfo))));
            }

            if (data.chargeNote) {
                children.push(el('p', { key: 'charge', className: 'ccd_extra_charge_note' },
                    decodeEntities(data.chargeNote)));
            }

            if (data.advancePayment) {
                var ap = data.advancePayment;
                children.push(el('div', {
                    key: 'advance',
                    className: 'ccd_advance_payment_notice',
                    style: { background: '#fff3cd', border: '1px solid #ffc107', padding: '15px', margin: '15px 0', borderRadius: '4px' }
                }, [
                    el('strong', { key: 't' }, decodeEntities(ap.title)),
                    el('br', { key: 'br1' }),
                    decodeEntities(ap.advanceText) + ' ',
                    el('strong', { key: 'a' }, decodeEntities(ap.advanceAmount)),
                    el('br', { key: 'br2' }),
                    decodeEntities(ap.remainingText) + ' ',
                    el('strong', { key: 'r' }, decodeEntities(ap.remainingAmount))
                ]));
            }

            var rows = data.fields.map(function (f) {
                return el('p', { key: f.name, className: 'ccd-blocks-field form-row form-row-wide' }, [
                    el('label', { key: 'l', htmlFor: 'ccd_block_' + f.name }, decodeEntities(f.label)),
                    el('input', {
                        key: 'i',
                        id: 'ccd_block_' + f.name,
                        type: f.type || 'text',
                        className: 'input-text',
                        placeholder: f.placeholder || '',
                        onChange: function (e) { values[f.name] = e.target.value; }
                    })
                ]);
            });

            children.push(el('div', { key: 'fields', className: 'ccd-blocks-fields' }, rows));

            return el('div', { className: 'ccd-blocks-content' }, children);
        };

        /**
         * Label: gateway title with its icon.
         */
        var Label = function () {
            var title = decodeEntities(data.title || id);
            var nodes = [el('span', { key: 'title' }, title)];
            if (data.icon) {
                nodes.unshift(el('img', {
                    key: 'icon',
                    src: data.icon,
                    alt: title,
                    style: { maxHeight: '24px', marginRight: '8px', verticalAlign: 'middle' }
                }));
            }
            return el('span', { className: 'ccd-blocks-label', style: { display: 'flex', alignItems: 'center' } }, nodes);
        };

        registerPaymentMethod({
            name: id,
            label: el(Label, null),
            ariaLabel: decodeEntities(data.title || id),
            canMakePayment: function () { return true; },
            content: el(Content, null),
            edit: el(Content, null),
            supports: {
                features: (data.supports && data.supports.length) ? data.supports : ['products']
            }
        });
    });
})();
