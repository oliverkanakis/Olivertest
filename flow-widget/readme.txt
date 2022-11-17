=== Flow Widget ===
Tags: Flow, widget
Requires at least: 4.6.1
Tested up to: 4.6.1

This plugin will install the Flow Widget on configured pages.

== Description ==

    This is the initial version of the plugin and should be considered as a BETA.

    The plugin will inject the Flow Widget script on WordPress frontend pages. It's possible to configure in admin which pages the script is injected in.
Once injected the Flow Widget will work as expected.

== Installation ==

1. Upload the plugin files to the `/wp-content/plugins/customer-widget` directory, or install the plugin through the WordPress plugins screen directly.
2. Activate the plugin through the 'Plugins' screen in WordPress
3. Use the Settings->General screen to configure the plugin. The settings are under the "Flow Widget" section.
3.1 Copy paste the script tag from Flow admin into "Import script"
3.2 (OPTIONAL) Enter a regex matching the pages the widget should be displayed on in the "Show widget on pages regex (optional)".

== Test ==

1. Install phpunit: `brew install homebrew/php/phpunit`
2. Run `phpunit --bootstrap ./classes/flow-widget-class.php ./test/FlowWidgetClassTest.php` in the same folder as this readme
