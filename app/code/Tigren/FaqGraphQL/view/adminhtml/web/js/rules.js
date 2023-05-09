/*
 * @author    Tigren Solutions <info@tigren.com>
 * @copyright  Copyright (c)  2023.  Tigren Solutions <https://www.tigren.com>. All rights reserved.
 * @license   Open Software License ("OSL") v. 3.0
 */

define([
    'jquery',
    'Magento_Rule/rules'
], function ($, VarienRulesForm) {
    'use strict';

    function VarienRulesFormExtend() {
        VarienRulesForm.apply(this, arguments);
    }

    VarienRulesFormExtend.prototype = Object.create(VarienRulesForm.prototype);
    VarienRulesFormExtend.prototype.constructor = VarienRulesFormExtend;

    VarienRulesFormExtend.prototype.hideParamInputField = function (container, event) {
        if (!$(event.currentTarget).hasClass('hasDatepicker')) {
            VarienRulesForm.prototype.hideParamInputField.call(this, container, event);
        }
    }

    return VarienRulesFormExtend;
});
