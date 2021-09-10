<?php
add_action('post_submitbox_misc_actions', 'my_post_submitbox_misc_actions');

function my_post_submitbox_misc_actions($post)
{
	$custom_post_action = get_post_meta($post->ID, 'my_custom_post_action', true);
	?>

	<div class="misc-pub-section my-options">
		<label for="my_custom_post_action">My Option</label><br />
		<select id="my_custom_post_action" name="my_custom_post_action">
			<option value="1" <?php echo $custom_post_action == '1' ? 'selected' : '' ?>>First Option goes here</option>
			<option value="2" <?php echo $custom_post_action == '2' ? 'selected' : '' ?>>Second Option goes here</option>
		</select>
	</div>
<?php
}
add_action('save_post', 'set_post_default_category', 10, 3);

function set_post_default_category($post_id, $post, $update)
{
	// Only want to set if this is a new post!
	update_post_meta($post_id, 'my_custom_post_action', $_POST['my_custom_post_action']);
}
