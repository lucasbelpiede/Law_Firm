<?php

namespace MasterAddons\Admin\Promotions;

/**
 * Author Name: Liton Arefin
 * Author URL: https://jeweltheme.com
 * Date: 25/07/2021
 */

if (!defined('ABSPATH')) {
    exit;
} // No, Direct access Sir !!!

if (!class_exists('Master_Addons_Promotions')) {
    class Master_Addons_Promotions
    {

        public $timenow;

        private static $instance = null;

        public static function get_instance()
        {
            if (!self::$instance) {
                self::$instance = new self;
            }
            return self::$instance;
        }

        public function __construct()
        {
            if (!is_admin()) {
                return;
            }

            $this->timenow = strtotime("now");

            // Admin Notices
            add_action('admin_init', [$this, 'jltma_admin_notice_init']);

            //Notices
            add_action('admin_notices', [$this, 'jltma_latest_update_details'], 10);
            add_action('network_admin_notices', [$this, 'jltma_latest_update_details'], 10);

            if (ma_el_fs()->can_use_premium_code()) {
                add_action('admin_notices', [$this, 'jltma_review_notice_generator'], 10);
            } else {

                add_action('admin_notices', [$this, 'jltma_review_notice_generator'], 10);
                add_action('admin_notices', [$this, 'jltma_upgrade_pro_notice_generator'], 10);


                //Black Friday & Cyber Monday Offer
                add_action('admin_notices', [$this, 'jltma_black_friday_cyber_monday_deals'], 10);
                //Hlloween Offer
                add_action('admin_notices', [$this, 'jltma_halloween_deals'], 10);
            }
            add_action('admin_notices', [$this, 'jltma_upgrade_pro_notice_popup'], 10);

            // Styles
            add_action('admin_enqueue_scripts', [$this, 'jltma_admin_notice_styles']);
        }

        public function jltma_admin_notice_init()
        {
            add_action('wp_ajax_jltma_dismiss_admin_notice', [$this, 'jltma_dismiss_admin_notice']);
        }

        public function jltma_latest_update_details()
        {
            if (!self::is_admin_notice_active('jltma-update-notice-forever')) {
                return;
            }

            $jltma_changelog_message = sprintf(
                __('<h3 class="jltma-update-head">' . JLTMA . ' <span><small><em>v' . JLTMA_VER . '</em></small>' . __(' has some major updates...', 'master-addons') . '</span></h3><br>%3$s %4$s %5$s %6$s<br> <strong>Check Changelogs for </strong> <a href="%1$s" target="__blank">%2$s</a>', 'master-addons'),
                esc_url_raw('https://master-addons.com/changelogs/'),
                __('More Details', 'master-addons'),

                /** Changelog Items
                 * Starts from: %3$s
                 */
                __('<span class="dashicons dashicons-yes"></span> <span class="jltma-changes-list">Latest Elementor, WordPress and Elementor Compatibility</span><br>', 'master-addons'), //%3$s
                __('<span class="dashicons dashicons-yes"></span> <span class="jltma-changes-list">Backward Campatibility Elementor Version functionality</span><br>', 'master-addons'),
                __('<span class="dashicons dashicons-yes"></span> <span class="jltma-changes-list">"Navigation Menu" addon -  Style issue fixed when Layout/Type is VERTICAL/SIDE. </span><br>', 'master-addons'),
                __('<span class="dashicons dashicons-yes"></span> <span class="jltma-changes-list">"Current Time" addon -  Name of the Month made translatable</span><br>', 'master-addons') //%6$s

            );

            printf('<div data-dismissible="jltma-update-notice-forever" id="jltma-admin-notice-forever" class="jltma-notice updated notice notice-success is-dismissible"><p>%1$s</p></div>', $jltma_changelog_message);
        }


        public function jltma_admin_notice_ask_for_review($notice_key)
        {
            if (!self::is_admin_notice_active($notice_key)) {
                return;
            }

            $this->jltma_notice_header($notice_key);

            echo /* translators: 1: Plugin name, 2: Wordpress.org Link, 3: Wordpress.org title */  sprintf(
                __('<p>Enjoying <strong>%1$s ?</strong></p> <p>Seems like you are enjoying <strong>%1$s</strong>. Would you please show us a little love by rating us on <a href="%2$s" target="_blank" style="background:yellow; padding:2px 5px;">%3$s?</a></p>
            <ul class="jltma-review-ul">
                <li><a href="%2$s" target="_blank" class="button jltma-sure-do-btn is-warning mt-4 upgrade-btn pt-1 pb-1 pr-4 pl-4" style="background-color: transparent; color: #fff;"><span class="dashicons dashicons-external" style="line-height:inherit"></span>Sure! I\'d love to!</a></li>
                <li><a href="#" target="_blank" class="jltma-admin-notice-dismiss button upgrade-btn mt-4 pt-1 pb-1 pr-4 pl-4"><span class="dashicons dashicons-smiley" style="line-height:inherit"></span>I\'ve already left a review</a></li>
                <li><a href="#" target="_blank" class="jltma-admin-notice-dismiss button is-danger upgrade-btn mt-4 pt-1 pb-1 pr-4 pl-4" style="background-color: #f14668 !important; color:#fff !important; border:1px solid #f14668;"><span class="dashicons dashicons-dismiss" style="line-height:inherit"></span>Never show again</a></li>
            </ul>', 'master-addons'),
                JLTMA,
                esc_url_raw('https://wordpress.org/support/plugin/master-addons/reviews/?filter=5'),
                __("WordPress.org", "master-addons")
            );
            $this->jltma_notice_footer();
        }

        public function jltma_crown_icon()
        {
            $svg_icon = '<svg width="43" height="38" viewBox="0 0 43 38" fill="none" xmlns="http://www.w3.org/2000/svg">
            <rect width="42.3448" height="38" rx="12" fill="url(#paint0_linear_3851_7357)"/>
            <path d="M28.4345 25.75H13.9103C13.6031 25.75 13.3517 26.0031 13.3517 26.3125V27.4375C13.3517 27.7469 13.6031 28 13.9103 28H28.4345C28.7417 28 28.9931 27.7469 28.9931 27.4375V26.3125C28.9931 26.0031 28.7417 25.75 28.4345 25.75ZM30.669 14.5C29.7438 14.5 28.9931 15.2559 28.9931 16.1875C28.9931 16.4371 29.049 16.6691 29.1467 16.8836L26.619 18.4094C26.0813 18.7328 25.3865 18.55 25.0758 18.0016L22.2303 12.9883C22.6039 12.6789 22.8483 12.2148 22.8483 11.6875C22.8483 10.7559 22.0976 10 21.1724 10C20.2472 10 19.4966 10.7559 19.4966 11.6875C19.4966 12.2148 19.741 12.6789 20.1145 12.9883L17.2691 18.0016C16.9583 18.55 16.26 18.7328 15.7259 18.4094L13.2016 16.8836C13.2959 16.6727 13.3552 16.4371 13.3552 16.1875C13.3552 15.2559 12.6046 14.5 11.6794 14.5C10.7541 14.5 10 15.2559 10 16.1875C10 17.1191 10.7506 17.875 11.6759 17.875C11.7666 17.875 11.8574 17.8609 11.9447 17.8469L14.469 24.625H27.8759L30.4001 17.8469C30.4874 17.8609 30.5782 17.875 30.669 17.875C31.5942 17.875 32.3448 17.1191 32.3448 16.1875C32.3448 15.2559 31.5942 14.5 30.669 14.5Z" fill="#FB0066"/>
            <defs>
            <linearGradient id="paint0_linear_3851_7357" x1="0" y1="0" x2="42.9298" y2="37.3272" gradientUnits="userSpaceOnUse">
            <stop stop-color="#FFF3B4"/>
            <stop offset="1" stop-color="#FFFCF0" stop-opacity="0.35"/>
            </linearGradient>
            </defs>
            </svg>';
            return $svg_icon;
        }

        public function jltma_upgrade_pro_notice_popup_content($notice_key)
        {
            if (!self::is_admin_notice_active($notice_key)) {
                return;
            }

            // Place popup image here as well at the alt value.
            $campaign_image_data = [
                'url' => JLTMA_IMAGE_DIR . 'popup.png',
                'alt' => 'Master Addons for Elementor Pro'
            ];

            $this->jltma_popup_notice_header($notice_key, $campaign_image_data);

?>
            <h4> <?php echo $this->jltma_crown_icon(); ?> <?php echo __('Upgrade to', 'master-addons'); ?> </h4>
            <h3>
                <?php echo sprintf(
                    __('%1s <span>%2s</span>', 'master-addons'),
                    __('Master Addons', 'master-addons'),
                    __('Pro', 'master-addons')
                ); ?>
            </h3>
            <p>
                <?php echo __('Get Access to exclusive Elementor Elements & Extensions to create a better page.', 'master-addons'); ?>
            </p>
            <ul class="list-items">
                <?php echo sprintf(
                    __('<li>Create an amazing <span>pricing Switcher</span> easily using Toggle Content Element.</li>', 'master-addons'),
                    __('<li>Showcase content based on user behavior like <span>browser, OS, User role, Time</span> etc.</li>', 'master-addons'),
                    __('<li>Lock your content by <span>Password, Age, Captcha or Based on User Role</span> by Restrict content.</li>', 'master-addons'),
                    __('<li>Unlock <span>10+ Elements & 8+ Extensions</span> to edit your Elementor pages seamlessly.</li>', 'master-addons')
                ); ?>
            </ul>

        <?php
            $this->jltma_popup_notice_footer();
        }

        public function jltma_popup_notice_header($notice_key, $campaign_image_data)
        {
        ?>
            <div data-dismissible="<?php echo esc_attr($notice_key); ?>" id="<?php echo esc_attr($notice_key); ?>" class="notice is-dismissible upgrade-pro-popup">
                <div class="upst-body">
                    <div class="col">
                        <img src="<?php echo esc_url($campaign_image_data['url']); ?>" alt="<?php echo esc_url($campaign_image_data['alt']); ?>">
                    </div>
                    <div class="col">
                        <div class="content-body">
                        <?php
                    }

                    public function jltma_popup_notice_footer()
                    {
                        ?>
                            <a href="https://master-addons.com/pricing/?utm_source=WPDashboard&utm_medium=users&utm_campaign=promo" class="button adminify-sure-do-btn is-warning mt-4 upgrade-btn pt-1 pb-1 pr-4 pl-4 upgrade-button">
                                <?php echo __('Upgrade to Pro', 'master-addons'); ?>
                                &nbsp;<?php //echo $this->jltma_crown_icon();
                                        ?>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="upst-footer">
                    <ul>
                        <li>
                            <a href="https://master-addons.com/support/" target="_blank">
                                <?php echo __('Support', 'master-addons'); ?>
                            </a>
                        </li>
                        <li>
                            <a href="https://master-addons.com/docs/" target="_blank">
                                <?php echo __('Documentation', 'master-addons'); ?>
                            </a>
                        </li>
                        <li>
                            <a href="https://master-addons.com/contact-us/" target="_blank">
                                <?php echo __('Request Features', 'master-addons'); ?>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        <?php
                    }

                    public function jltma_admin_upgrade_pro_notice($notice_key)
                    {
                        if (!self::is_admin_notice_active($notice_key)) {
                            return;
                        }

                        $this->jltma_notice_header($notice_key);

                        echo /* translators: 1: Info 2: Discount 3: Coupon */ sprintf(
                            __(' <p> %1$s <strong>%2$s</strong> %3$s </p> <p><a class="button upgrade-btn mt-4" href="https://master-addons.com/pricing" target="_blank">Upgrade Now</a></p>', 'master-addons'),
                            __("Unlock all possiblities - Ready made Pro Templates, Extensions, Features and much more .. <br>", "master-addons"),
                            __('20% Discount on all pricing, enjoy the freedom.<br>', 'master-addons'),
                            __("Coupon Code: <strong style='background:yellow; padding:1px 5px; color: #0347FF;'>ENJOY25</strong>", "master-addons")
                        );

                        $this->jltma_notice_footer();
                    }


                    // Black Friday & Cyber Monday Offer
                    public function jltma_admin_black_friday_cyber_monday_notice($notice_key)
                    {
                        if (!self::is_admin_notice_active($notice_key)) {
                            return;
                        }

                        $this->jltma_notice_header($notice_key);

                        echo /* translators: 1: Info 2: Discount 3: Coupon */ sprintf(
                            __(' <p> %1$s <strong>%2$s</strong> %3$s </p> <p><a class="button upgrade-btn mt-4" href="https://master-addons.com/pricing/?utm_source=WPDashboard&utm_medium=users&utm_campaign=promo" target="_blank">Upgrade Now</a></p>', 'master-addons'),
                            __("Get Access to exclusive Elementor Elements & Extensions to create a better page <br>", "master-addons"),
                            __('Lifetime Deals & <strong style="background:yellow; padding:2px 10px; color: #0347FF;">50%</strong> Discounts for <span style="background:#111; padding:2px 10px; color: #fff;">Black Friday and Cyber Monday Deals</span><br>', 'master-addons'),
                            __("Coupon Code: <strong style='background:yellow; padding:2px 10px; color: #0347FF;'>BFCM50</strong>", "master-addons")
                        );


                        $this->jltma_notice_footer();
                    }
                    // Halloween Offer
                    public function jltma_admin_halloween_notice($notice_key)
                    {
                        if (!self::is_admin_notice_active($notice_key)) {
                            return;
                        }

                        $this->jltma_notice_header($notice_key);

                        echo /* translators: 1: Info 2: Discount 3: Coupon */ sprintf(
                            __(' <p> %1$s <strong>%2$s</strong> %3$s </p> <p><a class="button upgrade-btn mt-4" href="https://master-addons.com/pricing/?utm_source=WPDashboard&utm_medium=users&utm_campaign=promo" target="_blank">Upgrade Now</a></p>', 'master-addons'),
                            __("Get Access to exclusive Elementor Elements & Extensions to create a better page. <br>", "master-addons"),
                            __('25% Discounts for <span style="background:#111; padding:2px 10px; color: #fff;">Halloween Deals</span><br>', 'master-addons'),
                            __("Coupon Code: <strong style='background:yellow; padding:2px 10px; color: #0347FF;'>SPOOKY25</strong>", "master-addons")
                        );


                        $this->jltma_notice_footer();
                    }


                    public function jltma_notice_header($notice_key)
                    { ?>
            <div data-dismissible="<?php echo esc_attr($notice_key); ?>" id="<?php echo esc_attr($notice_key); ?>" class="jltma-notice jltma-review-notice-banner updated notice notice-success is-dismissible">
                <div id="jltma-bfcm-upgrade-notice" class="jltma-review-notice">
                    <div class="jltma-admin-notice-banner">
                        <div class="jltma-admin-notice-contents columns is-tablet is-align-items-center">
                            <ul class="jltma-admin-notice-left-nav column is-2-tablet">
                                <li>
                                    <a class="is-flex is-align-items-center" target="_blank" href="https://master-addons.com/docs/">
                                        <i class="is-rounded is-pulled-left mr-2 dashicons dashicons-book"></i>
                                        <?php echo __('Docs', 'master-addons'); ?>
                                    </a>
                                </li>
                                <li>
                                    <a class="is-flex is-align-items-center" target="_blank" href="https://master-addons.com/all-widgets/">
                                        <i class="is-rounded is-pulled-left mr-2 dashicons dashicons-fullscreen-alt"></i>
                                        <?php echo __('All Demos', 'master-addons'); ?>
                                    </a>
                                </li>
                                <li>
                                    <a class="is-flex is-align-items-center" target="_blank" href="https://master-addons.com/pricing">
                                        <i class="is-rounded is-pulled-left mr-2 dashicons dashicons-editor-help"></i>
                                        <?php echo __('F.A.Q.', 'master-addons'); ?>
                                    </a>
                                </li>
                                <li>
                                    <a class="is-flex is-align-items-center" target="_blank" href="https://master-addons.com/contact-us/">
                                        <i class="is-rounded is-pulled-left mr-2 dashicons dashicons-phone"></i>
                                        <?php echo __('Contact Us', 'master-addons'); ?>
                                    </a>
                                </li>
                            </ul>
                            <div class="jltma-admin-notice-middle column is-8-tablet has-text-centered">

                            <?php }

                        public function jltma_notice_footer()
                        { ?>
                            </div>

                            <div class="jltma-admin-notice-right column is-2-tablet has-text-centered">
                                <ul class="jltma-admin-notice-right-nav">
                                    <li>
                                        <a class="jltma-logo" href="https://master-addons.com/" target="_blank">
                                            <img src="<?php echo JLTMA_IMAGE_DIR; ?>full-logo.png" alt="<?php echo JLTMA; ?>">
                                        </a>
                                    </li>
                                    <li class="jltma-admin-notice-social">
                                        <a class="jltma-admin-notice-social-icon" target="_blank" href="https://www.facebook.com/groups/2495256720521297">
                                            <i class="is-rounded dashicons dashicons-facebook-alt"></i>
                                        </a>
                                        <a class="jltma-admin-notice-social-icon" target="_blank" href="https://www.youtube.com/playlist?list=PLqpMw0NsHXV9V6UwRniXTUkabCJtOhyIf">
                                            <i class="is-rounded dashicons dashicons-youtube"></i>
                                        </a>
                                        <a class="jltma-admin-notice-social-icon" target="_blank" href="https://twitter.com/jwthemeltd">
                                            <i class="is-rounded dashicons dashicons-twitter"></i>
                                        </a>
                                    </li>
                                    <li class="jltma-rate-us mt-3">
                                        <div class="jltma-rate-contents">
                                            <label class="jltma-rating-label">Rate us:</label>
                                            <a class="jltma-rating is-inline-block" href="https://wordpress.org/support/plugin/master-addons/reviews/?filter=5" target="_blank">
                                                <span class="star">
                                                    <i class="dashicons dashicons-star-half"></i>
                                                </span>
                                                <span class="star">
                                                    <i class="dashicons dashicons-star-filled"></i>
                                                </span>
                                                <span class="star">
                                                    <i class="dashicons dashicons-star-filled"></i>
                                                </span>
                                                <span class="star">
                                                    <i class="dashicons dashicons-star-filled"></i>
                                                </span>
                                                <span class="star">
                                                    <i class="dashicons dashicons-star-filled"></i>
                                                </span>
                                            </a>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        <?php
                        }

                        public function jltma_dismiss_admin_notice()
                        {
                            $option_name        = sanitize_text_field($_POST['option_name']);
                            $dismissible_length = sanitize_text_field($_POST['dismissible_length']);

                            if ('forever' != $dismissible_length) {
                                // If $dismissible_length is not an integer default to 1
                                $dismissible_length = (0 == absint($dismissible_length)) ? 1 : $dismissible_length;
                                $dismissible_length = strtotime(absint($dismissible_length) . ' days');
                            }

                            check_ajax_referer('jltma-admin-notice-nonce', 'notice_nonce');
                            self::set_admin_notice_cache($option_name, $dismissible_length);
                            wp_die();
                        }

                        public static function set_admin_notice_cache($id, $timeout)
                        {
                            $cache_key = 'jltma-admin-notice-' . md5($id);
                            update_site_option($cache_key, $timeout);

                            return true;
                        }

                        public static function is_admin_notice_active($arg)
                        {
                            $array       = explode('-', $arg);
                            $length      = array_pop($array);
                            $option_name = implode('-', $array);
                            $db_record   = self::get_admin_notice_cache($option_name);

                            if ('forever' === $db_record) {
                                return false;
                            } elseif (absint($db_record) >= time()) {
                                return false;
                            } else {
                                return true;
                            }
                        }

                        public static function get_admin_notice_cache($id = false)
                        {
                            if (!$id) {
                                return false;
                            }

                            $cache_key = 'jltma-admin-notice-' . md5($id);
                            $timeout   = get_site_option($cache_key);
                            $timeout   = 'forever' === $timeout ? time() + 45 : $timeout;

                            if (empty($timeout) || time() > $timeout) {
                                return false;
                            }

                            return $timeout;
                        }

                        public function jltma_admin_notice_styles()
                        {
                            $output_css = '';
                            $output_css .= '.jltma-notice *{-webkit-box-sizing:border-box;box-sizing:border-box}.jltma-notice{margin:15px 15px 2px 0!important}.jltma-review-notice .notice-dismiss{padding:0 0 0 26px}.jltma-notice .jltma-update-head{margin:0}.jltma-notice .jltma-update-head span{font-size:.9em}.jltma-notice .jltma-changes-list{padding-left:.5em}.is-align-items-center{-webkit-box-align:center!important;-webkit-align-items:center!important;-ms-flex-align:center!important;align-items:center!important}.column{display:block;-webkit-flex-basis:0;-ms-flex-preferred-size:0;flex-basis:0;-webkit-box-flex:1;-webkit-flex-grow:1;-ms-flex-positive:1;flex-grow:1;-webkit-flex-shrink:1;-ms-flex-negative:1;flex-shrink:1;padding:.75rem}.has-text-centered{text-align:center!important}.columns{display:flex;margin-left:-.75rem;margin-right:-.75rem;margin-top:-.75rem}.jltma-review-notice .notice-dismiss:before{display:none}.jltma-review-notice.jltma-review-notice{background-color:#fff;border-radius:3px;border-left:4px solid transparent;display:flex;align-items:center;padding:10px 10px 10px 0}.jltma-review-notice .jltma-review-thumbnail{width:160px;float:left;margin-right:20px;padding-top:20px;text-align:center;border-right:4px solid transparent}.jltma-review-notice .jltma-review-thumbnail img{vertical-align:middle}.jltma-review-notice .jltma-review-text{flex:0 0 1;overflow:hidden}.jltma-review-notice .jltma-review-text h3{font-size:24px;margin:0 0 5px;font-weight:400;line-height:1.3}.jltma-review-notice .jltma-review-text p{margin:0 0 5px}.jltma-review-notice .jltma-review-ul{margin:5px 0 0;padding:0}.jltma-review-notice .jltma-review-ul li{display:inline-block;margin:5px 15px 0 0}.jltma-review-notice .jltma-review-ul li a{display:inline-block;color:#4b00e7;position:relative}.jltma-review-notice .jltma-review-ul li a:not(.notice-dismiss) span.dashicons{font-size:17px;float:left;height:auto;width:auto;margin-right:3px}#wpbody-content .jltma-notice.jltma-review-notice-banner{background-color:#4b00e7;border-left:0;padding-right:.5rem}#wpbody-content .jltma-review-notice-banner .jltma-admin-notice-banner{-webkit-box-flex:0;-webkit-flex:0 0 100%;-ms-flex:0 0 100%;flex:0 0 100%}#wpbody-content .jltma-review-notice-banner .jltma-review-notice{background-color:transparent;font-size:15px}#wpbody-content .jltma-review-notice-banner #jltma-bfcm-upgrade-notice p{color:#fff;font-size:15px}#wpbody-content .jltma-review-notice-banner .jltma-admin-notice-left-nav{margin:0}@media screen and (min-width:769px){.column.is-2,.column.is-2-tablet{-webkit-box-flex:0;-webkit-flex:none;-ms-flex:none;flex:none;width:16.6666666667%}.column.is-8,.column.is-8-tablet{-webkit-box-flex:0;-webkit-flex:none;-ms-flex:none;flex:none;width:66.6666666667%}}.mr-2{margin-right:.5rem!important}.mt-4{margin-top:1.5rem!important}img{max-width:100%}.is-pulled-left{float:left!important}.is-rounded{border-radius:9999px}a{text-decoration:none}.wp-adminify .is-rounded{-webkit-border-radius:9999px;border-radius:9999px}#wpbody-content .jltma-review-notice-banner .jltma-admin-notice-left-nav li{clear:both;margin-bottom:5px}#wpbody-content .jltma-review-notice-banner #jltma-bfcm-upgrade-notice .jltma-admin-notice-left-nav a{color:#fff;display:inline-block;line-height:25px}#wpbody-content .jltma-review-notice-banner .jltma-admin-notice-left-nav a i{background-color:#fff;color:#4b00e7;font-size:20px;height:26px;width:26px;line-height:26px}#wpbody-content .jltma-review-notice-banner .jltma-admin-notice-middle .upgrade-btn{background-color:#fff;border:1px solid #fff;color:#4b00e7;font-size:16px;font-weight:800;border-radius:8px}#wpbody-content .jltma-review-notice-banner .jltma-admin-notice-middle .upgrade-btn:hover{border:1px solid #fff!important;background:#4b00e7!important;color:#fff!important}#wpbody-content .jltma-review-notice-banner .jltma-admin-notice-middle .upgrade-btn:focus{background-color:#fff}.jltma-review-notice-banner .jltma-logo{display:flex;margin:0 auto 1rem;max-width:135px}#wpbody-content .jltma-review-notice-banner .jltma-admin-notice-social-icon i{background-color:#fff;height:40px;width:40px;line-height:40px;margin:3px}.jltma-review-notice-banner .jltma-logo{max-width:135px}#wpbody-content .jltma-review-notice-banner #jltma-bfcm-upgrade-notice .jltma-rate-contents,#wpbody-content .jltma-review-notice-banner #jltma-bfcm-upgrade-notice .jltma-rate-contents a{color:#fff}.jltma-review-notice-banner .jltma-rating{display:inline-block;direction:rtl}.jltma-review-notice-banner .jltma-rating label{font-size:0;line-height:0}.jltma-review-notice-banner .jltma-rate-contents i{font-size:14px;height:auto;width:auto;line-height:0;vertical-align:middle}.jltma-rating input{display:none!important}.jltma-rating:hover span i:before{content:"\f154"}.jltma-rating span:hover i:before,.jltma-rating span:hover~span i:before{content:"\f155"}#wpbody-content .jltma-review-notice-banner .notice-dismiss{border-color:#fff}#wpbody-content .jltma-review-notice-banner .notice-dismiss:before{color:#fff}#wpbody-content .jltma-review-notice-banner .jltma-admin-notice-middle .jltma-sure-do-btn:hover{background-color:#00d1b2!important;border-color:transparent!important} .upgrade-pro-popup {border:0 !important;max-width: 850px;width: 100%;gap: 15px;background: #fff;border-radius: 5px !important;margin: 80px 20px !important;padding: 40px !important;position: absolute !important;z-index: 9999;left: 30%;top: 1%;transform: translate(-30%, -2%);-webkit-box-shadow: 0px 0px 54px 0px rgb(20 20 42 / 7%) !important;box-shadow: 0px 0px 54px 0px rgb(20 20 42 / 7%) !important;}.upgrade-pro-popup .upst-body{display:flex;}.upgrade-pro-popup .col{flex-basis:50%;}.upgrade-pro-popup .col:nth-child(1){padding-right: 20px;padding-top: 120px;}.upgrade-pro-popup .col:nth-child(1) img{max-width:100%;-webkit-box-shadow: 0px 0px 54px 0px rgb(20 20 42 / 7%) !important;box-shadow: 0px 0px 54px 0px rgb(20 20 42 / 7%) !important;}.upgrade-pro-popup .col:nth-child(2){padding-left: 20px;}.upgrade-pro-popup .upst-body .content-body{color: rgba(78, 75, 102, 0.72);}.upgrade-pro-popup .upst-body .content-body h4{display:flex;color: #FB0066;margin-bottom: 10px;letter-spacing: 1px;gap: 10px;font-size: 22px;line-height: 32px;}.upgrade-pro-popup .upst-body .content-body h4 i {background: #ffff004a;padding: 5px 9px;border-radius: 5px;font-size: 16px;text-align: center;line-height: 24px;width:39px;}.upgrade-pro-popup .upst-body .content-body h3{color: #14142B;letter-spacing: 1px;font-size:28px;}.upgrade-pro-popup .upst-body .content-body h3 span{color: #0347ff;}.upgrade-pro-popup .upst-body .content-body p{font-weight: normal !important;line-height: 22px !important;font-size: 16px !important;}.upgrade-pro-popup .upst-body .content-body ul li {margin: 10px 0;line-height: 22px;padding-left: 30px;}.upgrade-pro-popup .upst-body .content-body ul li:before {color: #fff;top: 2px;left: 1px;font-size: 17px;}.upgrade-pro-popup .upst-body .content-body ul li:after {position: absolute;content: "";background: #00BA88;border-radius: 50px;width: 18px;height: 18px;top: 3px !important;left: 1px;}.upgrade-pro-popup .upst-body .content-body ul li span{color: #14142B !important;}.upgrade-pro-popup .upst-body .content-body .upgrade-btn {background: #0347ff;color: #fff;font-size: 16px;border:0 !important;border-radius: 6px;}.upgrade-pro-popup .upst-body .content-body .upgrade-btn:hover {color: #fff !important;}.upgrade-pro-popup .upst-footer ul{display: flex;padding-top:60px;width: 60%;margin: 0 auto;justify-content: space-between;}.upgrade-pro-popup ul li{position: relative;list-style: none;padding-left: 25px;}.upgrade-pro-popup ul li:before{position: absolute;content:"\f15e";font-family: dashicons;font-size: 19px;left: 0;top: 0;z-index: 1;}.upgrade-pro-popup .upst-footer ul li a{color: rgba(78, 75, 102, 0.72) !important;}.upgrade-pro-popup .upst-footer ul li a:hover{color: #0347FF !important;}.upgrade-pro-popup .upst-footer ul li:before{font-size: 22px;color: #00BA88;}.upgrade-pro-popup .notice-dismiss {border: 0 !important;outline: none !important;background: transparent !important;}.upgrade-pro-popup .notice-dismiss:before{content: "\00d7" !important;font-size: 30px !important;height: 22px !important;width: 22px !important;color: rgba(78, 75, 102, 0.72) !important;}@media only screen and (max-width: 1110px) {.upgrade-pro-popup {max-width: 90%;}}@media only screen and (max-width: 960px) {.upgrade-pro-popup {max-width: 80%;}.upgrade-pro-popup .upst-body {display: block;}.upgrade-pro-popup .col:nth-child(1) {padding: 0;margin-bottom: 40px;}.upgrade-pro-popup .col:nth-child(2){padding:0}.upgrade-pro-popup .upst-footer ul {width: 80%;padding-top: 40px;}}@media only screen and (max-width: 768px) {.upgrade-pro-popup .upst-footer ul {width: 100%;display:block;}}@media only screen and (max-width: 600px) {.upgrade-pro-popup {padding: 40px 20px 30px !important;}}';
                            echo '<style>' . strip_tags($output_css) . '</style>';
        ?>

<?php }

                        public function jltma_get_total_interval($interval, $type)
                        {
                            switch ($type) {
                                case 'years':
                                    return $interval->format('%Y');
                                    break;
                                case 'months':
                                    $years = $interval->format('%Y');
                                    $months = 0;
                                    if ($years) {
                                        $months += $years * 12;
                                    }
                                    $months += $interval->format('%m');
                                    return $months;
                                    break;
                                case 'days':
                                    return $interval->format('%a');
                                    break;
                                case 'hours':
                                    $days = $interval->format('%a');
                                    $hours = 0;
                                    if ($days) {
                                        $hours += 24 * $days;
                                    }
                                    $hours += $interval->format('%H');
                                    return $hours;
                                    break;
                                case 'minutes':
                                    $days = $interval->format('%a');
                                    $minutes = 0;
                                    if ($days) {
                                        $minutes += 24 * 60 * $days;
                                    }
                                    $hours = $interval->format('%H');
                                    if ($hours) {
                                        $minutes += 60 * $hours;
                                    }
                                    $minutes += $interval->format('%i');
                                    return $minutes;
                                    break;
                                case 'seconds':
                                    $days = $interval->format('%a');
                                    $seconds = 0;
                                    if ($days) {
                                        $seconds += 24 * 60 * 60 * $days;
                                    }
                                    $hours = $interval->format('%H');
                                    if ($hours) {
                                        $seconds += 60 * 60 * $hours;
                                    }
                                    $minutes = $interval->format('%i');
                                    if ($minutes) {
                                        $seconds += 60 * $minutes;
                                    }
                                    $seconds += $interval->format('%s');
                                    return $seconds;
                                    break;
                                case 'milliseconds':
                                    $days = $interval->format('%a');
                                    $seconds = 0;
                                    if ($days) {
                                        $seconds += 24 * 60 * 60 * $days;
                                    }
                                    $hours = $interval->format('%H');
                                    if ($hours) {
                                        $seconds += 60 * 60 * $hours;
                                    }
                                    $minutes = $interval->format('%i');
                                    if ($minutes) {
                                        $seconds += 60 * $minutes;
                                    }
                                    $seconds += $interval->format('%s');
                                    $milliseconds = $seconds * 1000;
                                    return $milliseconds;
                                    break;
                                default:
                                    return NULL;
                            }
                        }


                        public function jltma_days_differences()
                        {
                            if (is_multisite()) {
                                $install_date = get_site_option('jltma_activation_time');
                            } else {
                                $install_date = get_option('jltma_activation_time');
                            }
                            // $install_date = strtotime('2021-09-3 14:39:05'); // Testing datetime
                            $jltma_datetime1 = \DateTime::createFromFormat('U', $install_date);
                            $jltma_datetime2 = \DateTime::createFromFormat('U', strtotime("now"));

                            $interval = $jltma_datetime2->diff($jltma_datetime1);

                            $jltma_days_diff = $this->jltma_get_total_interval($interval, 'days');
                            return $jltma_days_diff;
                        }


                        public function jltma_review_notice_generator()
                        {
                            $jltma_seven_day_notice = $this->jltma_days_differences();
                            $diff_modulas = $jltma_seven_day_notice % 15;

                            if ($jltma_seven_day_notice <= 7) {
                                return;
                            }

                            if (($jltma_seven_day_notice < 15) && ($diff_modulas >= 8 && $diff_modulas <= 12)) {
                                $this->jltma_admin_notice_ask_for_review('jltma-nine-to-twelve');
                                return;
                            }

                            // No Review Ask for Pro Customers
                            // if (ma_el_fs()->can_use_premium_code()) {
                            //     if (($diff_modulas >= 0 && $diff_modulas < 5) || ($diff_modulas >= 11 && $diff_modulas < 14)) {
                            //         $this->jltma_admin_notice_ask_for_review('jltma-zero-to-five');
                            //     }
                            // }
                        }

                        public function jltma_upgrade_pro_notice_generator()
                        {
                            $jltma_seven_day_notice = $this->jltma_days_differences();
                            $diff_modulas = $jltma_seven_day_notice % 15;
                            if ($jltma_seven_day_notice <= 7) {
                                return;
                            }

                            if (($jltma_seven_day_notice < 15) && ($diff_modulas >= 13)) {
                                $this->jltma_admin_upgrade_pro_notice('jltma-after-thirteen');
                                return;
                            }


                            if ($jltma_seven_day_notice >= 15 && $diff_modulas >= 5 && $diff_modulas < 11) {
                                $this->jltma_admin_upgrade_pro_notice('jltma-five-to-eleventh');
                            }
                        }

                        public function jltma_upgrade_pro_notice_popup()
                        {
                            $jltma_twelve_days_notice = $this->jltma_days_differences();
                            $diff_modulas = $jltma_twelve_days_notice % 15;

                            if ($diff_modulas >= 8) {
                                $this->jltma_upgrade_pro_notice_popup_content('jltma-offer-popup-12');
                            }
                        }

                        public function jltma_black_friday_cyber_monday_deals()
                        {
                            $today = date("Y-m-d");
                            $start_date = '2022-11-23';
                            $expire_date = '2022-12-05';

                            $today_time = strtotime($today);
                            $start_time = strtotime($start_date);
                            $expire_time = strtotime($expire_date);
                            if ($today_time >= $start_time && $today_time <= $expire_time) {
                                $this->jltma_admin_black_friday_cyber_monday_notice('jltma-bfcm-2022');
                            }
                        }
                        public function jltma_halloween_deals()
                        {
                            $today = date("Y-m-d");
                            $start_date = '2023-10-27';
                            $expire_date = '2023-11-07';

                            $today_time = strtotime($today);
                            $start_time = strtotime($start_date);
                            $expire_time = strtotime($expire_date);
                            if ($today_time >= $start_time && $today_time <= $expire_time) {
                                $this->jltma_admin_halloween_notice('jltma-hlwn-2022');
                            }
                        }
                    }
                    Master_Addons_Promotions::get_instance();
                }
