import template from './swag-paypal-credentials.html.twig';

const { Component } = Shopware;

Component.register('sw-paypal-credentials', {
    template,
    name: 'SwagPaypalCredentials',

    props: {
        actualConfigData: {
            type: Object,
            required: true
        },
        allConfigs: {
            type: Object,
            required: true
        },
        selectedSalesChannelId: {
            type: String,
            required: true
        }
    },

    methods: {
        checkTextFieldInheritance(value) {
            if (typeof value !== 'string') {
                return true;
            }

            return value.length <= 0;
        },

        checkBoolFieldInheritance(value) {
            if (typeof value !== 'boolean') {
                return true;
            }

            return false;
        }
    }
});
