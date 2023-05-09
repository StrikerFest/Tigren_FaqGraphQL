/*
 * @author    Tigren Solutions <info@tigren.com>
 * @copyright  Copyright (c)  2023.  Tigren Solutions <https://www.tigren.com>. All rights reserved.
 * @license   Open Software License ("OSL") v. 3.0
 */

const veniaUiPackagePath = '@magento/venia-ui';
module.exports = componentOverrideMapping = {
    [`${veniaUiPackagePath}/lib/components/ProductFullDetail/productFullDetail.js`]: 'src/components/ProductFullDetail/productFullDetail.js',
    [`${veniaUiPackagePath}/lib/RootComponents/Product/product.shimmer.js`]: 'src/components/Product/product.shimmer.js',
};
