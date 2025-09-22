<?php
/**
 * Gallery Management System
 * 
 * Handles the backend logic for the custom gallery management system.
 * Allows uploading and managing up to 6 photos for the gallery.
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

/**
 * Add Gallery menu to WordPress admin
 */
function tov_add_gallery_menu() {
    add_menu_page(
        __('Gallery Management', 'tov'),
        __('Gallery', 'tov'),
        'manage_options',
        'tov-gallery',
        'tov_render_gallery_page',
        'dashicons-images-alt2',
        30
    );
}
add_action('admin_menu', 'tov_add_gallery_menu');

/**
 * Render the gallery management page
 */
function tov_render_gallery_page() {
    // Handle form submissions
    if (isset($_POST['action'])) {
        if ($_POST['action'] === 'upload_images' && wp_verify_nonce($_POST['tov_gallery_nonce'], 'tov_gallery_upload')) {
            tov_handle_gallery_upload();
        } elseif ($_POST['action'] === 'remove_image' && wp_verify_nonce($_POST['tov_gallery_nonce'], 'tov_gallery_remove')) {
            tov_handle_gallery_remove();
        } elseif ($_POST['action'] === 'reorder_images' && wp_verify_nonce($_POST['tov_gallery_nonce'], 'tov_gallery_reorder')) {
            tov_handle_gallery_reorder();
        }
    }
    
    $gallery_images = get_option('tov_gallery_images', array());
    ?>
    <div class="wrap">
        <h1><?php echo esc_html__('Gallery Management', 'tov'); ?></h1>
        <p><?php echo esc_html__('Upload and manage up to 6 photos for your gallery. Use the [tov_gallery] shortcode to display the gallery on your website.', 'tov'); ?></p>
        
        <?php if (count($gallery_images) >= 6): ?>
            <div class="notice notice-warning">
                <p><strong><?php echo esc_html__('Gallery Full:', 'tov'); ?></strong> <?php echo esc_html__('You have reached the maximum of 6 images. Remove an image to upload a new one.', 'tov'); ?></p>
            </div>
        <?php endif; ?>
        
        <!-- Upload Form -->
        <div class="card" style="max-width: 800px;">
            <h2><?php echo esc_html__('Upload Images', 'tov'); ?></h2>
            <form method="post" enctype="multipart/form-data" id="gallery-upload-form">
                <?php wp_nonce_field('tov_gallery_upload', 'tov_gallery_nonce'); ?>
                <input type="hidden" name="action" value="upload_images">
                
                <table class="form-table">
                    <tr>
                        <th scope="row">
                            <label for="gallery_images"><?php echo esc_html__('Select Images', 'tov'); ?></label>
                        </th>
                        <td>
                            <input type="file" id="gallery_images" name="gallery_images[]" multiple accept="image/*" <?php echo count($gallery_images) >= 6 ? 'disabled' : ''; ?>>
                            <p class="description">
                                <?php echo esc_html__('You can select multiple images at once. Maximum 6 images total.', 'tov'); ?>
                                <?php if (count($gallery_images) >= 6): ?>
                                    <br><strong><?php echo esc_html__('Gallery is full. Remove an image first.', 'tov'); ?></strong>
                                <?php endif; ?>
                            </p>
                        </td>
                    </tr>
                </table>
                
                <p class="submit">
                    <input type="submit" name="submit" id="submit" class="button button-primary" value="<?php echo esc_attr__('Upload Images', 'tov'); ?>" <?php echo count($gallery_images) >= 6 ? 'disabled' : ''; ?>>
                </p>
            </form>
        </div>
        
        <!-- Current Gallery Images -->
        <div class="card" style="max-width: 1000px;">
            <h2><?php echo esc_html__('Current Gallery Images', 'tov'); ?> (<?php echo count($gallery_images); ?>/6)</h2>
            
            <?php if (empty($gallery_images)): ?>
                <p><?php echo esc_html__('No images uploaded yet.', 'tov'); ?></p>
            <?php else: ?>
                <div id="gallery-images-sortable" class="gallery-images-container">
                    <?php foreach ($gallery_images as $index => $image): ?>
                        <div class="gallery-image-item" data-image-id="<?php echo esc_attr($index); ?>">
                            <div class="gallery-image-preview">
                                <img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>" style="width: 150px; height: 150px; object-fit: cover;">
                            </div>
                            <div class="gallery-image-info">
                                <p><strong><?php echo esc_html__('Title:', 'tov'); ?></strong> <?php echo esc_html($image['title']); ?></p>
                                <p><strong><?php echo esc_html__('Alt Text:', 'tov'); ?></strong> <?php echo esc_html($image['alt']); ?></p>
                                <p><strong><?php echo esc_html__('Uploaded:', 'tov'); ?></strong> <?php echo esc_html($image['uploaded']); ?></p>
                            </div>
                            <div class="gallery-image-actions">
                                <form method="post" style="display: inline;">
                                    <?php wp_nonce_field('tov_gallery_remove', 'tov_gallery_nonce'); ?>
                                    <input type="hidden" name="action" value="remove_image">
                                    <input type="hidden" name="image_index" value="<?php echo esc_attr($index); ?>">
                                    <input type="submit" class="button button-secondary" value="<?php echo esc_attr__('Remove', 'tov'); ?>" onclick="return confirm('<?php echo esc_js(__('Are you sure you want to remove this image?', 'tov')); ?>');">
                                </form>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
                
                <style>
                .gallery-images-container {
                    display: grid;
                    grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
                    gap: 20px;
                    margin-top: 20px;
                }
                .gallery-image-item {
                    border: 1px solid #ddd;
                    padding: 15px;
                    border-radius: 5px;
                    background: #f9f9f9;
                    display: flex;
                    flex-direction: column;
                    align-items: center;
                    text-align: center;
                }
                .gallery-image-preview {
                    margin-bottom: 15px;
                }
                .gallery-image-info {
                    margin-bottom: 15px;
                    font-size: 14px;
                }
                .gallery-image-info p {
                    margin: 5px 0;
                }
                .gallery-image-actions {
                    margin-top: auto;
                }
                </style>
                
                <script>
                jQuery(document).ready(function($) {
                    // Make images sortable
                    $("#gallery-images-sortable").sortable({
                        placeholder: "ui-state-highlight",
                        update: function(event, ui) {
                            var newOrder = [];
                            $("#gallery-images-sortable .gallery-image-item").each(function() {
                                newOrder.push($(this).data('image-id'));
                            });
                            
                            // Send AJAX request to update order
                            $.post(ajaxurl, {
                                action: 'tov_reorder_gallery_images',
                                nonce: '<?php echo wp_create_nonce('tov_gallery_reorder'); ?>',
                                order: newOrder
                            });
                        }
                    });
                });
                </script>
            <?php endif; ?>
        </div>
        
        <!-- Shortcode Usage -->
        <div class="card" style="max-width: 800px;">
            <h2><?php echo esc_html__('How to Use', 'tov'); ?></h2>
            <p><?php echo esc_html__('To display the gallery on your website, use this shortcode:', 'tov'); ?></p>
            <code>[tov_gallery]</code>
            <p><?php echo esc_html__('You can also use these parameters:', 'tov'); ?></p>
            <ul>
                <li><code>[tov_gallery columns="2"]</code> - <?php echo esc_html__('Set number of columns (1-3)', 'tov'); ?></li>
                <li><code>[tov_gallery lightbox="true"]</code> - <?php echo esc_html__('Enable lightbox (true/false)', 'tov'); ?></li>
                <li><code>[tov_gallery size="medium"]</code> - <?php echo esc_html__('Image size (thumbnail, medium, large, full)', 'tov'); ?></li>
            </ul>
        </div>
    </div>
    <?php
}

/**
 * Handle gallery image uploads
 */
function tov_handle_gallery_upload() {
    if (!current_user_can('manage_options')) {
        wp_die(__('You do not have sufficient permissions to access this page.'));
    }
    
    $gallery_images = get_option('tov_gallery_images', array());
    $uploaded_count = 0;
    
    if (!empty($_FILES['gallery_images']['name'][0])) {
        $files = $_FILES['gallery_images'];
        
        for ($i = 0; $i < count($files['name']); $i++) {
            if (count($gallery_images) >= 6) {
                add_action('admin_notices', function() {
                    echo '<div class="notice notice-warning"><p>' . esc_html__('Maximum of 6 images reached. Some images were not uploaded.', 'tov') . '</p></div>';
                });
                break;
            }
            
            if ($files['error'][$i] === UPLOAD_ERR_OK) {
                $file = array(
                    'name' => $files['name'][$i],
                    'type' => $files['type'][$i],
                    'tmp_name' => $files['tmp_name'][$i],
                    'error' => $files['error'][$i],
                    'size' => $files['size'][$i]
                );
                
                $upload = wp_handle_upload($file, array('test_form' => false));
                
                if (!isset($upload['error'])) {
                    $gallery_images[] = array(
                        'url' => $upload['url'],
                        'title' => sanitize_text_field($file['name']),
                        'alt' => sanitize_text_field($file['name']),
                        'uploaded' => current_time('mysql')
                    );
                    $uploaded_count++;
                } else {
                    add_action('admin_notices', function() use ($upload) {
                        echo '<div class="notice notice-error"><p>' . esc_html__('Upload Error:', 'tov') . ' ' . esc_html($upload['error']) . '</p></div>';
                    });
                }
            }
        }
        
        update_option('tov_gallery_images', $gallery_images);
        
        if ($uploaded_count > 0) {
            add_action('admin_notices', function() use ($uploaded_count) {
                echo '<div class="notice notice-success"><p>' . sprintf(esc_html__('%d image(s) uploaded successfully.', 'tov'), $uploaded_count) . '</p></div>';
            });
        }
    }
}

/**
 * Handle gallery image removal
 */
function tov_handle_gallery_remove() {
    if (!current_user_can('manage_options')) {
        wp_die(__('You do not have sufficient permissions to access this page.'));
    }
    
    $image_index = intval($_POST['image_index']);
    $gallery_images = get_option('tov_gallery_images', array());
    
    if (isset($gallery_images[$image_index])) {
        unset($gallery_images[$image_index]);
        $gallery_images = array_values($gallery_images); // Re-index array
        update_option('tov_gallery_images', $gallery_images);
        
        add_action('admin_notices', function() {
            echo '<div class="notice notice-success"><p>' . esc_html__('Image removed successfully.', 'tov') . '</p></div>';
        });
    }
}

/**
 * Handle gallery image reordering via AJAX
 */
function tov_handle_gallery_reorder_ajax() {
    if (!wp_verify_nonce($_POST['nonce'], 'tov_gallery_reorder')) {
        wp_die('Security check failed');
    }
    
    if (!current_user_can('manage_options')) {
        wp_die('Insufficient permissions');
    }
    
    $new_order = $_POST['order'];
    $gallery_images = get_option('tov_gallery_images', array());
    $reordered_images = array();
    
    foreach ($new_order as $index) {
        if (isset($gallery_images[$index])) {
            $reordered_images[] = $gallery_images[$index];
        }
    }
    
    update_option('tov_gallery_images', $reordered_images);
    wp_send_json_success();
}
add_action('wp_ajax_tov_reorder_gallery_images', 'tov_handle_gallery_reorder_ajax');
