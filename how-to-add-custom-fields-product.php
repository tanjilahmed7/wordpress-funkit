
<?php
// First Register the Tab by hooking into the 'woocommerce_product_data_tabs' filter
add_filter('woocommerce_product_data_tabs', 'add_my_custom_product_data_tab');
function add_my_custom_product_data_tab($product_data_tabs)
{
	$product_data_tabs['my-custom-tab'] = array(
		'label' => __('My Custom Tab', 'my_text_domain'),
		'target' => 'my_custom_product_data',
	);
	return $product_data_tabs;
}


add_action('woocommerce_product_data_panels', 'add_my_custom_product_data_fields');
function add_my_custom_product_data_fields()
{
	?>
	<!-- id below must match target registered in above add_my_custom_product_data_tab function -->
	<div id="my_custom_product_data" class="panel woocommerce_options_panel">
		<?php
			woocommerce_wp_checkbox(
				array(
					'id'        => 'include_giftwrap_option',
					'label'     => __('Include giftwrap option', 'tpwcp'),
					'desc_tip'  => __('Select this option to show giftwrapping options for this product', 'tpwcp')
				)
			);
			?>
	</div>
<?php

}
add_action('woocommerce_process_product_meta', 'save_fields');

function save_fields($post_id)
{
	$product = wc_get_product($post_id);
	// Save the include_giftwrap_option setting
	$include_giftwrap_option = isset($_POST['include_giftwrap_option']) ? 'yes' : 'no';
	// update_post_meta( $post_id, 'include_giftwrap_option', sanitize_text_field( $include_giftwrap_option ) );
	$product->update_meta_data('include_giftwrap_option', sanitize_text_field($include_giftwrap_option));

	$product->save();
}
