
            <div class="fundpress-tab-nav-v5">
                <h5 id="wp_fundraising_msg"></h5>
                <ul class="nav nav-tabs" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" href="#login" role="tab" data-toggle="tab">
                            <?php echo wf_login_label(); ?>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#signup" role="tab" data-toggle="tab">
                            註冊
                        </a>
                    </li>
                </ul>
            </div>
            <!-- fundpress-tab-nav-v3 -->
            <!-- Tab panes -->
            <div class="tab-content text-center">
                <div role="tabpanel" class="tab-pane fadeInRights show fade in active" id="login">
                    <form action="#" method="post" id="wp_fundraising_login_form">
                        <div class="xs-input-group-v2">
                            <i class="icon icon-profile-male"></i>
                            <input type="text" id="login_user_name" class="fundpress-required xs-input-control" name="user_name" placeholder="<?php esc_attr_e('Enter your username','wp-fundraising');?>">
                        </div>
                        <div class="xs-input-group-v2">
                            <i class="icon icon-key2"></i>
                            <input type="password" name="user_password" id="login_user_pass" class="fundpress-required xs-input-control" placeholder="<?php esc_attr_e('Enter your password','wp-fundraising');?>">
                        </div>
                        <div class="xs-submit-wraper xs-mb-20">
                            <input type="submit" name="submit" value="<?php echo wf_login_button_text(); ?>" id="xs_contact_get_action" class="btn btn-warning btn-block">
                        </div>
                    </form>

                    <form action="#" method="post" id="wp_fundraising_reset_form">
                        <div class="xs-input-group-v2">
                            <i class="icon icon-profile-male"></i>
                            <input type="text" id="reset_username" class="fundpress-required xs-input-control" name="user_name" placeholder="<?php esc_attr_e('Enter your username','wp-fundraising');?>">
                        </div>
                        <div class="xs-submit-wraper xs-mb-20">
                            <input type="submit" name="submit" value="Submit" id="xs_contact_get_action1" class="btn btn-warning btn-block">
                        </div>
                    </form>

                    <a href="#" class="xs_login_switch xs_switch"><?php echo esc_html__('Login','wp-fundraising'); ?></a>
                    <a href="#" class="xs_reset_switch xs_switch"><?php echo esc_html__('Reset Password','wp-fundraising'); ?></a>
                    <a>/</a>
                    <a href="/wp-login.php?action=register">
                    前往註冊~!
                   </a>
                    <?php do_action('wf_after_login_form');?>
                </div><!-- tab-pane -->

                <div role="tabpanel" class="tab-pane fadeInRights fade" id="signup">
                   <a href="/wp-login.php?action=register">
                    前往註冊~!
                   </a>
                </div><!-- tab-pane -->
            </div><!-- tab-content -->
        </div>
    </div>
</div>