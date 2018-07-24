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
    <label class="post-attributes-label">How should we clone the page?</label><br/>
    <label for="wp_clone_page__virtual">
        <input type="radio" name="wp_clone_page__clone" id="wp_clone_page__soft" value="soft" <?php checked( 'soft', $cloneType ); ?>> 
        Soft Clone
    </label><br />
    <label for="wp_clone_page__physical">
        <input type="radio" name="wp_clone_page__clone" id="wp_clone_page__hard" value="hard" <?php checked( 'hard', $cloneType ); ?>> 
        Hard Clone
    </label>
</p>