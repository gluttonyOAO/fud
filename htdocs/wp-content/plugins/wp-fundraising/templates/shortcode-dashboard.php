<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

add_shortcode( 'wp_fundraising_dashboard','wp_fundraising_dashboard_shortcode' );

function wp_fundraising_dashboard_shortcode( $attr ){


    ob_start();
    $get_id = '';
    if( isset($_GET['wf_page']) ){ $get_id = $_GET['wf_page']; }
    $pagelink = get_permalink( get_the_ID() );

    $dashboard_pages = apply_filters('wf_frontend_dashboard_pages', array(

        'campaigns' =>
            array(
                'tab'             => 'campaigns',
                'tab_name'        => '募資項目',
                'load_form_file'  => WP_FUNDRAISING_DIR_PATH.'templates/dashboard/campaigns.php'
            ),
        'my_account' =>
            array(
                'tab'             => 'my_account',
                'tab_name'        => '帳戶資料',
                'load_form_file'  => WP_FUNDRAISING_DIR_PATH.'templates/dashboard/account.php'
            ),

    ));
    ?>

    <div class="xs-dashboard-page">

        <?php if ( is_user_logged_in() ) { ?>
            <div class="xs-dashboard-header">
                <h3 class="dashboard-title">Dashboard</h3>
                <div class="xs-btn-wraper">
                    <a href="<?php echo home_url('/')?>wf-campaign-form/" target="_blank" class="btn btn-primary"><?php echo wf_add_new_campaign_text();?></a>
                </div>
                <div class="clearfix"></div>
            </div>
            <div class="row">
                <div class="col-lg-3">
                    <ul  id="v-pills-tab" role="tablist" aria-orientation="vertical">
                        <?php

                        foreach ($dashboard_pages as $menu_name => $menu_value){

                            if ( empty($get_id) && $menu_name == 'campaigns'){ $active = 'active show';
                            } else { $active = ($get_id == $menu_name) ? 'active show' : ''; }

                            $pagelink = add_query_arg( 'wf_page', $menu_name , $pagelink );

                            if( $menu_value['tab'] == 'campaigns' ){ ?>
                                <li class="nav-link"><a class="nav-link <?php echo $active; ?>" href="<?php echo $pagelink; ?>"><?php echo $menu_value['tab_name']; ?></a></li>
                            <?php }elseif( $menu_value['tab'] == 'my_account' ){ ?>
                                <li class="nav-link"><a class="nav-link <?php echo $active; ?>" href="<?php echo $pagelink; ?>"><?php echo $menu_value['tab_name']; ?></a></li>
                            <?php }elseif( $menu_value['tab'] == 'address' ){ ?>
                                <li class="nav-link"><a class="nav-link <?php echo $active; ?>" href="<?php echo $pagelink; ?>"><?php echo $menu_value['tab_name']; ?></a></li>
                            <?php }else{ ?>
                                <li class="nav-link"><a class="nav-link <?php echo $active; ?>" href="<?php echo $pagelink; ?>"><?php echo $menu_value['tab_name']; ?></a></li>
                            <?php } ?>
                        <?php } ?>
                        <li class="nav-link"><a class="nav-link" href="<?php echo wp_logout_url(get_permalink()); ?>">登出</a></li>
                    </ul>
                </div>
                <div class="col-lg-9">

                    <?php

                    if ( ! empty($dashboard_pages[$get_id]['load_form_file']) ) {
                        if (file_exists($dashboard_pages[$get_id]['load_form_file'])) {
                            include $dashboard_pages[$get_id]['load_form_file'];
                        }
                    }else{
                        include $dashboard_pages['campaigns']['load_form_file'];
                    }

                    ?>

                </div>
            </div>

        <?php }else{ ?>
            <div class="xs-section-padding xs-login-btn-area">
                <div class="container">
                    <p>請<a href="" data-toggle="modal" data-target=".<?php echo wf_login_signup_modal_class();?>">登入</a>操作此頁面</p>
                </div>
            </div>
        <?php } ?>

    </div>

    <?php
    $html = ob_get_clean();
    return $html;
}