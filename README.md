#LoopConf Customizer Workshop Example Repository
##LoopConf - October, 2016

The objective is to start with the code in the `master` branch and iterate on the theme options implemented with the WordPress Customizer.

###Getting Started
1. Create a new WordPress site on [Pantheon](https://pantheon.io). If you do not have a Pantheon account, you can register for a free [here](https://pantheon.io/register).

1. Download the `master` branch of this repository - either using Git or downloading the [`.zip` file](https://github.com/ataylorme/loop-conf-2016-customizer-workshop/archive/master.zip).

1. Ensure your Pantheon site is in SFTP mode, connect to your Pantheon site via SFTP and upload the files downloaded in the previous step to the `code` directory.

###WordPress at Scale Theme
All example code is in the `wp-content/themes/wordpress-at-scale` directory.

###Files
The theme options implemented with the WordPress Customizer API can be found in the files `wp-content/themes/wordpress-at-scale/inc/theme-options.php`.

Other theme functionality can be found in the `wp-content/themes/wordpress-at-scale/functions.php` and the `wp-content/themes/wordpress-at-scale/inc` directory.

##Branches

###[master](https://github.com/ataylorme/loop-conf-2016-customizer-workshop/tree/master)
The `master` branch is the starting codebase for the workshop. It adds theme options with the WordPress Customizer.

The theme options use full page reload and need some improvement. The code in `inc/theme-options.php` is where you'll want to start.

Modified files:

* [themes/wordpress-at-scale/inc/theme-options.php](https://github.com/ataylorme/loop-conf-2016-customizer-workshop/blob/master/web/wp-content/themes/wordpress-at-scale/inc/theme-options.php#L55)

###[full-page-reload](https://github.com/ataylorme/loop-conf-2016-customizer-workshop/tree/full-page-reload)
This is an alias of the `master` branch.
  
###[post-message](https://github.com/ataylorme/loop-conf-2016-customizer-workshop/tree/post-message)
The `post-message` branch uses the `postMessage` transport and adds live preview with JavaScript in `assets/js/customizer-preview.js`.

Modified files:

* [themes/wordpress-at-scale/assets/js/customizer-preview.js](https://github.com/ataylorme/loop-conf-2016-customizer-workshop/blob/post-message/web/wp-content/themes/wordpress-at-scale/assets/js/customizer-preview.js)
* [themes/wordpress-at-scale/inc/enqueue-script-styles.php](https://github.com/ataylorme/loop-conf-2016-customizer-workshop/blob/post-message/web/wp-content/themes/wordpress-at-scale/inc/enqueue-script-styles.php)
* [themes/wordpress-at-scale/inc/theme-options.php](https://github.com/ataylorme/loop-conf-2016-customizer-workshop/blob/post-message/web/wp-content/themes/wordpress-at-scale/inc/theme-options.php)

This branch does _not_ include any Customizer functionality introduced in WordPress 4.5.

###[partial-refresh](https://github.com/ataylorme/loop-conf-2016-customizer-workshop/tree/partial-refresh)
The `partial-refresh` branch expands on the theme options Customizer implementation by adding a new field for banner background image in `inc/theme-options.php`.
 The banner background image field has partial refresh support for an optimized user experience.
 
Modified files:

* [themes/wordpress-at-scale/inc/theme-options.php](https://github.com/ataylorme/loop-conf-2016-customizer-workshop/blob/partial-refresh/web/wp-content/themes/wordpress-at-scale/inc/theme-options.php)
* [themes/wordpress-at-scale/template-parts/banner-home.php](https://github.com/ataylorme/loop-conf-2016-customizer-workshop/blob/partial-refresh/web/wp-content/themes/wordpress-at-scale/template-parts/banner-home.php)
 
###[settings-validation](https://github.com/ataylorme/loop-conf-2016-customizer-workshop/tree/settings-validation)
The `settings-validation` branch expands on the theme options Customizer implementation by adding settings validation to the banner title text and banner background image in `inc/theme-options.php`.

Modified files:

* [themes/wordpress-at-scale/inc/theme-options.php](https://github.com/ataylorme/loop-conf-2016-customizer-workshop/blob/settings-validation/web/wp-content/themes/wordpress-at-scale/inc/theme-options.php)
* [themes/wordpress-at-scale/template-parts/banner-home.php](https://github.com/ataylorme/loop-conf-2016-customizer-workshop/blob/settings-validation/web/wp-content/themes/wordpress-at-scale/template-parts/banner-home.php)

##Resources
* [The Customizer API in the WordPress developer handbook](https://developer.wordpress.org/themes/advanced-topics/customizer-api/)
* [Kirki](https://aristath.github.io/kirki/) - a toolkit for the WordPress Customizer
* [WP_Customize_Color_Control](https://developer.wordpress.org/reference/classes/wp_customize_color_control/)
* [Selective refresh in the customizer](https://make.wordpress.org/core/2016/02/16/selective-refresh-in-the-customizer/)
* [Implementing Selective Refresh for widgets](https://make.wordpress.org/core/2016/03/22/implementing-selective-refresh-support-for-widgets/)
* [Jetpack widget selective refresh pull request](https://github.com/Automattic/jetpack/pull/3607/commits/2615f0043f0fd031bb921718f8f02c9bb30fabac)
* [Selective refresh example plugin](https://gist.github.com/westonruter/a15b99bdd07e6f4aae7a)
* [Fast preview menu changes in the customizer](https://make.wordpress.org/core/2015/07/29/fast-previewing-changes-to-menus-in-the-customizer/)
* [`inc/customizer.php` in the WordPress TwentySixteen theme](https://github.com/WordPress/twentysixteen/blob/master/inc/customizer.php)
