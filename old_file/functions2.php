<?php
function display_all_products() {
    ob_start();
    $args = array(
        'post_type' => 'product',
        'posts_per_page' => -1,
        'order' => 'DESC',
        'orderby' => 'ID',
        'meta_query' => array(
            array(
                'key' => '_thumbnail_id',
                'compare' => 'NOT EXISTS'
            )
        )
    );
    $products = new WP_Query($args);
    if ($products->have_posts()) :
        $i = 1;
        while ($products->have_posts()) : $products->the_post();
            echo $i."<br>";
            $content = get_the_content();
            preg_match('/<strong>Referencia<\/strong>:\s*(.*?)\s*<strong>Marca<\/strong>/', $content, $matches);
            $referencia = trim($matches[1]) ?? '';

            <>
            if (!empty($referencia)) {
                // Adjust the pattern to match the product name variations
                $pattern = preg_quote($referencia, '/') . '\s*-\s*[0-9.]+\s*-\s*1';
                $image_found = false;
                // Check for different variations of the product name
                foreach (glob(get_template_directory() . '/all_images/images/' . $pattern . '.jpg') as $image_path) {
                    $image_found = true;
                    $upload_dir = wp_upload_dir();
                    $image_data = file_get_contents($image_path);
                    $filename = basename($image_path);
                    if (wp_mkdir_p($upload_dir['path'])) {
                        $file = $upload_dir['path'] . '/' . $filename;
                    } else {
                        $file = $upload_dir['basedir'] . '/' . $filename;
                    }
                    file_put_contents($file, $image_data);
                    $wp_filetype = wp_check_filetype($filename, null);
                    $attachment = array(
                        'post_mime_type' => $wp_filetype['type'],
                        'post_title'     => sanitize_file_name($filename),
                        'post_content'   => '',
                        'post_status'    => 'inherit'
                    );
                    $attach_id = wp_insert_attachment($attachment, $file);
                    require_once(ABSPATH . 'wp-admin/includes/image.php');
                    $attach_data = wp_generate_attachment_metadata($attach_id, $file);
                    wp_update_attachment_metadata($attach_id, $attach_data);
                    set_post_thumbnail(get_the_ID(), $attach_id);
                    unlink($image_path);
                }
                if ($image_found) {
                    ?>
                    <div class="product">
                        <div class="description">
                            <?php echo get_the_ID() . " " . $referencia; ?>
                        </div>
                    </div>
                    <?php
                } else {
                    ?>
                    <div class="product">
                        <div class="description">
                            <?php echo get_the_ID(); ?> No image found
                        </div>
                    </div>
                    <?php
                }
            }
            $i++;
        endwhile;
        wp_reset_postdata();
    else :
        echo '<p>No products found</p>';
    endif;
    return ob_get_clean();
}
add_shortcode('all_products', 'display_all_products');