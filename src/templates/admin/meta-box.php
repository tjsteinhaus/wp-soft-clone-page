<p class="post-attributes-label-wrapper">
    <label class="post-attributes-label" for="page"><strong>Which page would you like to clone</strong></label>
</p>
<?php wp_dropdown_pages( [
    'show_option_none' => 'Select a page',
    'option_none_value' => '',
    'name' => 'wp_clone_page__page',
    'selected' => get_post_meta( $post->ID, 'wp_clone_page__page', true )
] ); ?>
<p class="post-attributes-label-wrapper">
    <label class="post-attributes-label">What would you like to clone?</label><br/>
    <label for="wp_clone_page__title">
        <input type="checkbox" name="wp_clone_page__clone[]" id="wp_clone_page__title" value="title" <?php echo in_array( 'title', $cloneType ) ? ' checked="checked"' : ''; ?>> 
        Post Title
    </label><br />
    <label for="wp_clone_page__content">
        <input type="checkbox" name="wp_clone_page__clone[]" id="wp_clone_page__content" value="content" <?php echo in_array( 'content', $cloneType ) ? ' checked="checked"' : ''; ?>> 
        Post Content
    </label><br />
    <label for="wp_clone_page__meta">
        <input type="checkbox" name="wp_clone_page__clone[]" id="wp_clone_page__meta" value="meta" <?php echo in_array( 'meta', $cloneType ) ? ' checked="checked"' : ''; ?>> 
        Post Meta
    </label><br />
    <label for="wp_clone_page__template">
        <input type="checkbox" name="wp_clone_page__clone[]" id="wp_clone_page__template" value="template" <?php echo in_array( 'template', $cloneType ) ? ' checked="checked"' : ''; ?>> 
        Post Template
    </label>
</p>
<!-- WP NONCE -->
<?php wp_nonce_field( \WPClonePage\Admin\SaveData::NONCE_ACTION, \WPClonePage\Admin\SaveData::NONCE_NAME ); ?>