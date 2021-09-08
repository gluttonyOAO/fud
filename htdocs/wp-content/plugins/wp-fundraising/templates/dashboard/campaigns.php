<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

$args1 = array(
    'post_type' 		=> 'product',
    'post_status'		=> array('publish'
        //,'draft', 'future'
        ),
    'author'    		=> get_current_user_id(),
    'tax_query' 		=> array(
        array(
            'taxonomy' => 'product_type',
            'field'    => 'slug',
            'terms'    => 'wp_fundraising',
        ),
    ),
    'posts_per_page'    => 4,
);

$args2 = array(
    'post_type' 		=> 'product',
    'post_status'		=> array('draft', 'pending'),
    'author'    		=> get_current_user_id(),
    'tax_query' 		=> array(
        array(
            'taxonomy' => 'product_type',
            'field'    => 'slug',
            'terms'    => 'wp_fundraising',
        ),
    ),
    'posts_per_page'    => 4,
);


$current_page = get_permalink();

?><div class="tab-pane slideUp active show" id="campaign" role="tabpanel"><?php
$the_query1 = new WP_Query( $args1 );
$the_query2 = new WP_Query( $args2 );

if ( $the_query1->have_posts() ) :
    global $post;
    $i = 1;
    while ( $the_query1->have_posts() ) : $the_query1->the_post();



        $funding_goal   = wf_get_total_goal_by_campaign(get_the_ID());
        $raised_percent   = wf_get_fund_raised_percent(get_the_ID());
        $fund_raised_percent   = wf_get_fund_raised_percentFormat(get_the_ID());
        $image_link = wp_get_attachment_url(get_post_thumbnail_id());
        $total_sales    = get_post_meta( get_the_ID(), 'total_sales', true );
        $enddate        = get_post_meta( get_the_ID(), '_wf_duration_end', true );

        $total_raised = wf_get_total_fund_raised_by_campaign(get_the_ID());
        if($total_raised == null){
            $total_raised = 0;
        }
        $days_remaining = apply_filters('date_expired_msg', esc_html__('Date expired', 'wp-fundraising'));
        if (wf_date_remaining(get_the_ID())){
            $days_remaining = apply_filters('date_remaining_msg', esc_html__(wf_date_remaining(get_the_ID()), 'wp-fundraising'));
        }
        ?>
        <div class="xs-campaign-info-card">
            <div class="xs-dashboard-header">
                <h3 class="dashboard-title"><?php echo get_the_title(); ?> <span><?php esc_html_e('by','wp-fundraising');?> <?php echo get_the_author();?></span></h3>
                <div class="xs-btn-wraper">
                    <!-- <a target="_blank" href="<?php echo home_url('/')?>wf-campaign-form/?action=edit&campaign_id=<?php the_ID();?>" class="btn btn-outline-success">編輯</a> -->
                    <a href="<?php the_permalink();?>" class="btn btn-outline-success">查看</a>
                </div>
                <div class="clearfix"></div>
            </div>
            <div class="row">
                <div class="col-md-3">
                    <div class="xs-pie-chart-v3" data-percent="<?php echo $raised_percent; ?>">
                        <div class="pie-chart-info">
                            <div class="xs-pie-chart-percent"></div>
                            <span>%</span>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="xs-campaign-card">
                        <h5><?php echo wc_price($total_raised); ?></h5>
                        <h6>目前金額</h6>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="xs-campaign-card card-primary">
                        <h5><?php echo wc_price($funding_goal); ?></h5>
                        <h6>目標金額</h6>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="xs-campaign-card">
                        <h5><?php echo $days_remaining; ?></h5>
                        <h6>剩餘天數</h6>
                    </div>
                </div>
            </div>
        </div>
    <?php endwhile;
    wp_reset_postdata();
    endif;
if ( $the_query2->have_posts() ) :
    global $post2;
    $i = 1;
    while ( $the_query2->have_posts() ) : $the_query2->the_post();



        $funding_goal   = wf_get_total_goal_by_campaign(get_the_ID());
        $raised_percent   = wf_get_fund_raised_percent(get_the_ID());
        $fund_raised_percent   = wf_get_fund_raised_percentFormat(get_the_ID());
        $image_link = wp_get_attachment_url(get_post_thumbnail_id());
        $total_sales    = get_post_meta( get_the_ID(), 'total_sales', true );
        $enddate        = get_post_meta( get_the_ID(), '_wf_duration_end', true );

        $total_raised = wf_get_total_fund_raised_by_campaign(get_the_ID());
        if($total_raised == null){
            $total_raised = 0;
        }
        $days_remaining = apply_filters('date_expired_msg', esc_html__('Date expired', 'wp-fundraising'));
        if (wf_date_remaining(get_the_ID())){
            $days_remaining = apply_filters('date_remaining_msg', esc_html__(wf_date_remaining(get_the_ID()), 'wp-fundraising'));
        }
        ?>
        <div class="xs-campaign-info-card">
            <div class="xs-dashboard-header">
                <h3 class="dashboard-title"><?php echo get_the_title(); ?> <span><?php esc_html_e('by','wp-fundraising');?> <?php echo get_the_author();?></span></h3>
                <div class="xs-btn-wraper">
                    <!-- <a target="_blank" href="<?php echo home_url('/')?>wf-campaign-form/?action=edit&campaign_id=<?php the_ID();?>" class="btn btn-outline-success">編輯</a> -->
                    <a href="<?php $url1=the_permalink()."&preview=true"; echo $url1;?>" class="btn btn-outline-success">預覽</a>
                </div>
                <div class="clearfix"></div>
            </div>
            <div class="row">
                <div class="col-md-3">
                    <div class="xs-pie-chart-v3" data-percent="<?php echo $raised_percent; ?>">
                        <div class="pie-chart-info">
                            <div class="xs-pie-chart-percent"></div>
                            <span>%</span>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="xs-campaign-card">
                        <h5><?php echo wc_price($total_raised); ?></h5>
                        <h6>目前金額</h6>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="xs-campaign-card card-primary">
                        <h5><?php echo wc_price($funding_goal); ?></h5>
                        <h6>目標金額</h6>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="xs-campaign-card">
                        <h5><?php echo $days_remaining; ?></h5>
                        <h6>剩餘天數</h6>
                    </div>
                </div>
            </div>
        </div>
    <?php endwhile;
    wp_reset_postdata();
    endif;
    if( !($the_query1->have_posts() || $the_query2->have_posts()) ):
    ?><p> 不好意思～！目前您還未有任何募資方案。</p>
<?php endif; ?>

</div>