<?php
/**
 * Plugin name: 給定初始餘額
 * Description: 配合募資套件啟用
 * Plugin URL:tony1997he@nkust.edu.tw
 * Version: 0.0.1
 * Requires at least: none
 * Requires PHP: 7.3
 * Author: Zhi-Yao,Xu
 * Author URI: tony1997he@nkust.edu.tw
 * License: MIT
 * License URI: none
 * Text Domain: 給定初始餘額
 */

/*
 * name of this file usually same with the plugin name.
 * but not necessary.
 */

add_shortcode('example', 'something_to_do_function');
add_shortcode('my_wp_plugin_form', 'my_wp_plugin_form');

add_action('admin_menu', 'action_function_in_my_plugin');
// add_action('wp_head', 'my_wp_plugin_display_header_scripts'); //debug with header
// add_action('wp_head', 'my_wp_plugin_form_capture');
// add_action('wp_footer', 'my_wp_plugin_display_footer_scripts');

function something_to_do_function()
{
    $information = 'this is an information.';
    $information .= '<div>This is a div.</div>';
    $information .= '<p>This is a paragraph text.</p>';
    print 'this string is printed by command \'print\'.';
    return $information;
}
//後台選單
function action_function_in_my_plugin()
{
    // there has latest 2 arguments not in here, reference document on official website.
    add_menu_page('title of my-wp-plugin', '初始餘額', 'manage_options', 'my-wp-plugin-menu', 'my_wp_plugin_scripts_page');
}
//後台page
function my_wp_plugin_scripts_page()
{
    if (array_key_exists('submit_scripts_update', $_POST)) {
        update_option('plugin_blace', $_POST['plugin_blace']);
        // update_option('my_wp_plugin_footer_scripts', $_POST['footer_scripts']);
        ?>
        <div id="setting-error-settings_updated" class="updated settings-error notice is-dismissible">
            <strong>Settings have been saved.</strong>
        </div>
        <?php
    }
    $plugin_blace = get_option('plugin_blace', '1');
    // $footer_scripts = get_option('my_wp_plugin_footer_scripts', 'none');
    ?>
    <div class="wrap">
        <h2>some script for my-wp-plugin</h2>
        <form action="" method="post">
            <label for="plugin-blace">給每個人一開始的金額</label>
            <br>
            <textarea id="plugin-blace" name="plugin_blace" cols="10" rows="1"><?= $plugin_blace ?></textarea>
            <br>


            <input type="submit" name="submit_scripts_update" class="button button-primary" value="更新金額">
        </form>
    </div>
    <?php
}

//啟用後經過頁面啟動 初始值NONE
function my_wp_plugin_display_header_scripts()
{
    $plugin_blace = get_option('plugin_blace', '1');
    print $plugin_blace;
    return;
}

// function my_wp_plugin_display_footer_scripts()
// {
//     $footer_scripts = get_option('my_wp_plugin_footer_scripts', 'none');
//     print $footer_scripts;
//     return;
// }

//插件基本訊息
function my_wp_plugin_form()
{
    /* content variable */
    $content = '';
    $content .= '<form method="post" action="http://127.0.0.1/wp/thank-you/">';
    $content .= '<input type="text" name="full_name" placeholder="your full name">';
    $content .= '<br>';
    $content .= '<input type="email" name="email_address" placeholder="Email address">';
    $content .= '<br>';
    $content .= '<input type="phone" name="phone_number" placeholder="Phone number">';
    $content .= '<br>';
    $content .= '<textarea name="comments" placeholder="Give us your comments."></textarea>';
    $content .= '<br>';
    $content .= '<input type="submit" name="my_wp_form_submit" value="submit your information">';
    $content .= '</form>';
    return $content;
}
// //差件基本訊息顯示
// function my_wp_plugin_form_capture()
// {
//     if (array_key_exists('my_wp_form_submit', $_POST)) {
//         global $wpdb;
//         $to = 'support@email.com';
//         $subject = 'my-wp-plugin example site';
//         $body = '';
//         $body .= 'Name: ' . $_POST['full_name'] . '<br>';
//         $body .= 'Email: ' . $_POST['email_address'] . '<br>';
//         $body .= 'Phone: ' . $_POST['phone_number'] . '<br>';
//         $body .= 'Comments: ' . $_POST['comments'] . '<br>';
//         add_filter('wp_mail_content_type', 'set_html_content_type');
//         wp_mail($to, $subject, $body);
//         remove_filter('wp_mail_content_type', 'set_html_content_type');
//         $insertData = $wpdb->get_results('insert into ' . $wpdb->prefix . 'my_table set my_data = \'' . $body . '\';');
//     }
//     return;
// }

function set_html_content_type()
{
    return 'text/html';
}