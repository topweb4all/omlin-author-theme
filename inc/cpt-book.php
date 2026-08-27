<?php
// ====== Register Books CPT ======
function omnia_register_books_cpt() {
    $labels = array(
        'name'               => 'Books',
        'singular_name'      => 'Book',
        'add_new'            => 'Add New Book',
        'add_new_item'       => 'Add New Book',
        'edit_item'          => 'Edit Book',
        'all_items'          => 'All Books',
        'menu_name'          => 'Books',
    );

    $args = array(
        'labels'        => $labels,
        'public'        => true,
        'show_ui'       => true,
        'show_in_menu'  => true,
        'has_archive'   => true,
        'supports'      => array( 'title', 'editor', 'thumbnail', 'excerpt' ),
        'menu_icon'     => 'dashicons-book',
    );

    // مهم: اسم ال post type هنا book
    register_post_type( 'book', $args );
}
add_action( 'init', 'omnia_register_books_cpt' );


// ====== Book Details Meta Box ======
function hana_book_add_meta_box() {
    add_meta_box(
        'hana_book_details',
        'Book Details',
        'hana_book_meta_box_callback',
        'book', // post type
        'normal',
        'high'
    );
}
add_action( 'add_meta_boxes', 'hana_book_add_meta_box' );

function hana_book_meta_box_callback( $post ) {
    wp_nonce_field( 'hana_book_save_meta', 'hana_book_meta_nonce' );

    $subtitle     = get_post_meta( $post->ID, '_book_subtitle', true );
    $tagline      = get_post_meta( $post->ID, '_book_tagline', true );
    $pages        = get_post_meta( $post->ID, '_book_pages', true );
    $format       = get_post_meta( $post->ID, '_book_format', true );
    $buy_link     = get_post_meta( $post->ID, '_book_buy_link', true );
    $preview_link = get_post_meta( $post->ID, '_book_preview_link', true );

    // الحقول الجديدة
    $series_name  = get_post_meta( $post->ID, '_book_series_name', true );
    $series_num   = get_post_meta( $post->ID, '_book_series_number', true );
    $genres       = get_post_meta( $post->ID, '_book_genres', true );
    ?>
    <table class="form-table">
        <tr>
            <th><label for="book_subtitle">Subtitle</label></th>
            <td>
                <input type="text" name="book_subtitle" id="book_subtitle" class="regular-text"
                    value="<?php echo esc_attr( $subtitle ); ?>" />
            </td>
        </tr>

        <tr>
            <th><label for="book_tagline">Tagline</label></th>
            <td>
                <input type="text" name="book_tagline" id="book_tagline" class="regular-text"
                    value="<?php echo esc_attr( $tagline ); ?>" />
            </td>
        </tr>

        <tr>
            <th><label for="book_pages">Pages</label></th>
            <td>
                <input type="number" name="book_pages" id="book_pages" class="small-text" min="1"
                    value="<?php echo esc_attr( $pages ); ?>" />
            </td>
        </tr>

        <tr>
            <th><label for="book_format">Format</label></th>
            <td>
                <input type="text" name="book_format" id="book_format" class="regular-text"
                    placeholder="Ebook, Paperback, etc."
                    value="<?php echo esc_attr( $format ); ?>" />
            </td>
        </tr>

        <tr>
            <th><label for="book_buy_link">Buy link (Amazon)</label></th>
            <td>
                <input type="url" name="book_buy_link" id="book_buy_link" class="regular-text"
                    value="<?php echo esc_url( $buy_link ); ?>" />
            </td>
        </tr>

        <tr>
            <th><label for="book_preview_link">Preview link</label></th>
            <td>
                <input type="url" name="book_preview_link" id="book_preview_link" class="regular-text"
                    value="<?php echo esc_url( $preview_link ); ?>" />
            </td>
        </tr>

        <!-- NEW: Series Name -->
        <tr>
            <th><label for="book_series_name">Series</label></th>
            <td>
                <input type="text" name="book_series_name" id="book_series_name" class="regular-text"
                    placeholder="Sin Trilogy"
                    value="<?php echo esc_attr( $series_name ); ?>" />
                <p class="description">Name of the series this book belongs to (e.g. Sin Trilogy).</p>
            </td>
        </tr>

        <!-- NEW: Series Number -->
        <tr>
            <th><label for="book_series_number">Series Number</label></th>
            <td>
                <input type="number" name="book_series_number" id="book_series_number" class="small-text" min="1"
                    value="<?php echo esc_attr( $series_num ); ?>" />
                <p class="description">Book order in the series (e.g. 1 for Book #1).</p>
            </td>
        </tr>

        <!-- NEW: Genres (simple text for now) -->
        <tr>
            <th><label for="book_genres">Genres</label></th>
            <td>
                <input type="text" name="book_genres" id="book_genres" class="regular-text"
                    placeholder="Dark Romance, Mafia, Psychological"
                    value="<?php echo esc_attr( $genres ); ?>" />
                <p class="description">Comma-separated genres (for display or future use).</p>
            </td>
        </tr>
    </table>
    <?php
}

function hana_book_save_meta( $post_id ) {
    if ( ! isset( $_POST['hana_book_meta_nonce'] ) ||
         ! wp_verify_nonce( $_POST['hana_book_meta_nonce'], 'hana_book_save_meta' ) ) {
        return;
    }

    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
        return;
    }

    if ( isset( $_POST['post_type'] ) && 'book' === $_POST['post_type'] ) {
        if ( ! current_user_can( 'edit_post', $post_id ) ) {
            return;
        }
    }

    // Save old fields
    $fields = array(
        'book_subtitle'      => '_book_subtitle',
        'book_tagline'       => '_book_tagline',
        'book_pages'         => '_book_pages',
        'book_format'        => '_book_format',
        'book_buy_link'      => '_book_buy_link',
        'book_preview_link'  => '_book_preview_link',
        // new fields
        'book_series_name'   => '_book_series_name',
        'book_series_number' => '_book_series_number',
        'book_genres'        => '_book_genres',
    );

    foreach ( $fields as $field_name => $meta_key ) {
        if ( isset( $_POST[ $field_name ] ) ) {
            $value = $_POST[ $field_name ];

            // sanitize
            if ( 'book_pages' === $field_name || 'book_series_number' === $field_name ) {
                $value = intval( $value );
            } elseif ( 'book_buy_link' === $field_name || 'book_preview_link' === $field_name ) {
                $value = esc_url_raw( $value );
            } else {
                $value = sanitize_text_field( $value );
            }

            update_post_meta( $post_id, $meta_key, $value );
        } else {
            // لو فاضي امسحيه
            delete_post_meta( $post_id, $meta_key );
        }
    }
}
add_action( 'save_post', 'hana_book_save_meta' );
