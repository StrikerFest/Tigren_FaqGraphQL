/*
 * @author    Tigren Solutions <info@tigren.com>
 * @copyright  Copyright (c)  2023.  Tigren Solutions <https://www.tigren.com>. All rights reserved.
 * @license   Open Software License ("OSL") v. 3.0
 */

const moduleOverridePlugin = require('./src/plugins/moduleOverrideWebpackPlugin');
const componentOverrideMapping = require('./componentOverrideMapping');

module.exports = targets => {

    targets.of('@magento/pwa-buildpack').webpackCompiler.tap(compiler => {
        new moduleOverridePlugin(componentOverrideMapping).apply(compiler);
    })

    targets.of('@magento/venia-ui').routes.tap(routes => {
        routes.push(
            // {
            //     name: 'DefaultIndex',
            //     pattern: '/tigren_question',
            //     path: require.resolve('../components/CustomerQuestion/index.js')
            // }
        );
    });
};
