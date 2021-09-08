<?php

/**
 * Plugin Name: Woocommerce Test Payment Module
 * Plugin URI:  http://www.tortoise-it.co.uk
 * Description: A payment gateway plugin for Woocommerce to handle test payments. Shows for admin only
 * Author:      Sean Barton (Tortoise IT)
 * Author URI:  http://www.tortoise-it.co.uk
 * Version:     1.4
 */

function sb_wc_test_init() {
	if (!class_exists('WC_Payment_Gateway')) {
		return;
	}

	class WC_Gateway_sb_test extends WC_Payment_Gateway {

		public function __construct() {
			$this->id = 'sb_test';
			$this->has_fields = false;
			$this->method_title = __( 'Test', 'woocommerce' );
			$this->init_form_fields();
			$this->init_settings();
			$this->title = 'Test gateway';

            $data = get_user_meta(get_current_user_id());
            if(isset($data['balance'][0])) {
                $this->balance = $data['balance'][0];
            }else {
				$this->balance=get_option('plugin_blace', '1');
                update_user_meta(get_current_user_id(),'balance',$this->balance);
            }


			add_action( 'woocommerce_update_options_payment_gateways_' . $this->id, array( $this, 'process_admin_options' ) );
		}

		function init_form_fields() {
			$this->form_fields = array(
				'enabled' => array(
					'title' => __( 'Enable/Disable', 'woocommerce' ),
					'type' => 'checkbox',
					'label' => __( 'Enable test gateway', 'woocommerce' ),
					'default' => 'yes'
				)
			);
		}


		public function admin_options() {
			echo '	<h3>Test gateway</h3>
				<table class="form-table">';

			$this->generate_settings_html();

			echo '	</table>';
		}

		public function process_payment( $order_id ) {


			$order = new WC_Order( $order_id );
			if(+$this->balance >= +$order->get_total()) return $this->complete_payment($order);
            $error_message = 'balance is not enough, please check it.';
            wc_add_notice( __('Payment error:', 'woothemes') . $error_message, 'error' );
            return;
		}

		protected function complete_payment(WC_Order $order) {
		    $new_balance = $this->balance - $order->get_total();
		    $this->update_balance($new_balance);
            global $woocommerce;
            $order->payment_complete();
            $order->reduce_order_stock();
            $woocommerce->cart->empty_cart();

            return array(
                'result' => 'success',
                //'redirect' => add_query_arg('key', $order->order_key, add_query_arg('order', $order->id, get_permalink(woocommerce_get_page_id('thanks')))),
                'redirect' => $order->get_checkout_order_received_url()
            );
        }

        protected function update_balance($balance){
            update_user_meta(get_current_user_id(),'balance',$balance);
        }

	}

	function add_sb_test_gateway( $methods ) {
		if (true) {
			$methods[] = 'WC_Gateway_sb_test';
		}

		return $methods;
	}

	add_filter('woocommerce_payment_gateways', 'add_sb_test_gateway' );

}

add_filter('plugins_loaded', 'sb_wc_test_init' );

?>