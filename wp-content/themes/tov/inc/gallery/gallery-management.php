<?php
/**
 * Gallery Management System
 * 
 * Handles the backend logic for the custom gallery management system.
 * Allows uploading and managing unlimited photos for the gallery (max 2.5MB per image).
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
 * Enqueue jQuery UI Sortable for gallery page
 */
function tov_enqueue_gallery_admin_scripts($hook) {
    // Only load on gallery management page
    if ($hook !== 'toplevel_page_tov-gallery') {
        return;
    }
    
    // Enqueue jQuery UI Sortable
    wp_enqueue_script('jquery-ui-sortable');
}
add_action('admin_enqueue_scripts', 'tov_enqueue_gallery_admin_scripts');

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
        <p><?php echo esc_html__('Upload and manage unlimited photos for your gallery. Each image must be less than 2.5MB. Use the [tov_gallery] shortcode to display the gallery on your website.', 'tov'); ?></p>
        
        
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
                            <input type="file" id="gallery_images" name="gallery_images[]" multiple accept="image/*">
                            <p class="description">
                                <?php echo esc_html__('You can select multiple images at once. Each image must be less than 2.5MB.', 'tov'); ?>
                            </p>
                        </td>
                    </tr>
                </table>
                
                <p class="submit">
                    <input type="submit" name="submit" id="submit" class="button button-primary" value="<?php echo esc_attr__('Upload Images', 'tov'); ?>">
                </p>
            </form>
        </div>
        
        <!-- Current Gallery Images -->
        <div class="card" style="max-width: 1000px;">
            <h2><?php echo esc_html__('Current Gallery Images', 'tov'); ?> (<?php echo count($gallery_images); ?>)</h2>
            
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
                                <div class="gallery-title-edit" style="margin-bottom: 10px;">
                                    <label style="display: block; margin-bottom: 5px;"><strong><?php echo esc_html__('Title:', 'tov'); ?></strong></label>
                                    <input type="text" 
                                           class="gallery-title-input" 
                                           data-image-index="<?php echo esc_attr($index); ?>"
                                           value="<?php echo esc_attr($image['title']); ?>" 
                                           style="width: 100%; padding: 5px; border: 1px solid #ddd; border-radius: 3px;">
                                    <button type="button" 
                                            class="button button-small save-title-btn" 
                                            data-image-index="<?php echo esc_attr($index); ?>"
                                            style="margin-top: 5px;">
                                        <?php echo esc_html__('Save Title', 'tov'); ?>
                                    </button>
                                </div>
                                <p><strong><?php echo esc_html__('Alt Text:', 'tov'); ?></strong> <span class="alt-text-display"><?php echo esc_html($image['alt']); ?></span></p>
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
                    // Make images sortable (only if jQuery UI is loaded)
                    if ($.fn.sortable) {
                        $("#gallery-images-sortable").sortable({
                            placeholder: "ui-state-highlight",
                            update: function(event, ui) {
                                var newOrder = [];
                                $("#gallery-images-sortable .gallery-image-item").each(function() {
                                    newOrder.push($(this).data('image-id'));
                                });
                                
                                // Get AJAX URL
                                var ajaxUrl = typeof ajaxurl !== 'undefined' ? ajaxurl : '<?php echo admin_url('admin-ajax.php'); ?>';
                                
                                // Send AJAX request to update order
                                $.post(ajaxUrl, {
                                    action: 'tov_reorder_gallery_images',
                                    nonce: '<?php echo wp_create_nonce('tov_gallery_reorder'); ?>',
                                    order: newOrder
                                });
                            }
                        });
                    }
                    
                    // Handle title update using event delegation
                    $(document).on('click', '.save-title-btn', function(e) {
                        e.preventDefault();
                        var button = $(this);
                        var imageIndex = button.data('image-index');
                        var titleInput = $('.gallery-title-input[data-image-index="' + imageIndex + '"]');
                        var newTitle = titleInput.val().trim();
                        var altTextDisplay = button.closest('.gallery-image-item').find('.alt-text-display');
                        
                        if (!newTitle) {
                            alert('<?php echo esc_js(__('Title cannot be empty.', 'tov')); ?>');
                            return;
                        }
                        
                        // Disable button and show loading
                        button.prop('disabled', true).text('<?php echo esc_js(__('Saving...', 'tov')); ?>');
                        
                        // Get AJAX URL
                        var ajaxUrl = typeof ajaxurl !== 'undefined' ? ajaxurl : '<?php echo admin_url('admin-ajax.php'); ?>';
                        
                        // AJAX request to update title
                        $.ajax({
                            url: ajaxUrl,
                            type: 'POST',
                            data: {
                                action: 'tov_update_gallery_title',
                                nonce: '<?php echo wp_create_nonce('tov_gallery_update_title'); ?>',
                                image_index: imageIndex,
                                title: newTitle
                            },
                            dataType: 'json',
                            success: function(response) {
                                if (response && response.success) {
                                    // Update alt text display to match title
                                    altTextDisplay.text(newTitle);
                                    
                                    // Update the img alt attribute
                                    button.closest('.gallery-image-item').find('img').attr('alt', newTitle);
                                    
                                    // Show success message
                                    var successMsg = $('<div class="notice notice-success inline" style="margin: 5px 0; padding: 5px 10px;"><p>Title updated successfully!</p></div>');
                                    button.after(successMsg);
                                    
                                    // Reload the page after showing success message to ensure all data is refreshed
                                    setTimeout(function() {
                                        location.reload();
                                    }, 1000);
                                } else {
                                    var errorMsg = (response && response.data) ? response.data : 'Error updating title. Please try again.';
                                    alert(errorMsg);
                                    button.prop('disabled', false).text('<?php echo esc_js(__('Save Title', 'tov')); ?>');
                                }
                            },
                            error: function(xhr, status, error) {
                                console.error('AJAX Error:', status, error);
                                console.error('Response:', xhr.responseText);
                                alert('<?php echo esc_js(__('An error occurred. Please try again.', 'tov')); ?>');
                                button.prop('disabled', false).text('<?php echo esc_js(__('Save Title', 'tov')); ?>');
                            }
                        });
                    });
                    
                    // Allow Enter key to save title using event delegation
                    $(document).on('keypress', '.gallery-title-input', function(e) {
                        if (e.which === 13) {
                            e.preventDefault();
                            $(this).siblings('.save-title-btn').click();
                        }
                    });
                    
                    // File size validation before upload
                    $('#gallery_images').on('change', function() {
                        var files = this.files;
                        var maxSize = 2.5 * 1024 * 1024; // 2.5MB in bytes
                        var validFiles = [];
                        var invalidFiles = [];
                        
                        for (var i = 0; i < files.length; i++) {
                            if (files[i].size > maxSize) {
                                invalidFiles.push(files[i].name + ' (' + (files[i].size / (1024 * 1024)).toFixed(2) + ' MB)');
                            } else {
                                validFiles.push(files[i]);
                            }
                        }
                        
                        if (invalidFiles.length > 0) {
                            alert('The following files are too large (maximum 2.5MB):\n' + invalidFiles.join('\n'));
                        }
                        
                        // Replace the file input with only valid files
                        if (invalidFiles.length > 0 && validFiles.length > 0) {
                            var dt = new DataTransfer();
                            for (var i = 0; i < validFiles.length; i++) {
                                dt.items.add(validFiles[i]);
                            }
                            this.files = dt.files;
                        } else if (invalidFiles.length > 0 && validFiles.length === 0) {
                            this.value = '';
                        }
                    });
                });
                </script>
            <?php endif; ?>
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
    $skipped_count = 0;
    $max_file_size = 2.5 * 1024 * 1024; // 2.5MB in bytes
    
    if (!empty($_FILES['gallery_images']['name'][0])) {
        $files = $_FILES['gallery_images'];
        
        for ($i = 0; $i < count($files['name']); $i++) {
            if ($files['error'][$i] === UPLOAD_ERR_OK) {
                // Check file size
                if ($files['size'][$i] > $max_file_size) {
                    $skipped_count++;
                    add_action('admin_notices', function() use ($files, $i) {
                        $file_size_mb = round($files['size'][$i] / (1024 * 1024), 2);
                        echo '<div class="notice notice-warning"><p>' . sprintf(esc_html__('File "%s" (%s MB) is too large. Maximum file size is 2.5MB.', 'tov'), esc_html($files['name'][$i]), $file_size_mb) . '</p></div>';
                    });
                    continue;
                }
                
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
                    add_action('admin_notices', function() use ($upload, $files, $i) {
                        echo '<div class="notice notice-error"><p>' . sprintf(esc_html__('Upload Error for "%s": %s', 'tov'), esc_html($files['name'][$i]), esc_html($upload['error'])) . '</p></div>';
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
        
        if ($skipped_count > 0) {
            add_action('admin_notices', function() use ($skipped_count) {
                echo '<div class="notice notice-warning"><p>' . sprintf(esc_html__('%d image(s) were skipped due to file size exceeding 2.5MB.', 'tov'), $skipped_count) . '</p></div>';
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

/**
 * Handle gallery title update via AJAX
 */
function tov_handle_gallery_update_title_ajax() {
    // Check if nonce is provided
    if (!isset($_POST['nonce']) || !wp_verify_nonce($_POST['nonce'], 'tov_gallery_update_title')) {
        wp_send_json_error(array('message' => 'Security check failed'));
        return;
    }
    
    // Check permissions
    if (!current_user_can('manage_options')) {
        wp_send_json_error(array('message' => 'Insufficient permissions'));
        return;
    }
    
    // Get and validate image index
    if (!isset($_POST['image_index'])) {
        wp_send_json_error(array('message' => 'Image index is required'));
        return;
    }
    
    $image_index = intval($_POST['image_index']);
    
    // Get and validate title
    if (!isset($_POST['title'])) {
        wp_send_json_error(array('message' => 'Title is required'));
        return;
    }
    
    $new_title = sanitize_text_field($_POST['title']);
    
    if (empty($new_title)) {
        wp_send_json_error(array('message' => 'Title cannot be empty'));
        return;
    }
    
    // Get gallery images
    $gallery_images = get_option('tov_gallery_images', array());
    
    // Check if image exists
    if (!isset($gallery_images[$image_index])) {
        wp_send_json_error(array('message' => 'Image not found'));
        return;
    }
    
    // Update title and alt text to match
    $gallery_images[$image_index]['title'] = $new_title;
    $gallery_images[$image_index]['alt'] = $new_title; // Alt text matches title
    
    // Save updated gallery images
    $updated = update_option('tov_gallery_images', $gallery_images);
    
    if ($updated !== false) {
        wp_send_json_success(array(
            'message' => 'Title updated successfully',
            'title' => $new_title,
            'alt' => $new_title
        ));
    } else {
        wp_send_json_error(array('message' => 'Failed to save title'));
    }
}
add_action('wp_ajax_tov_update_gallery_title', 'tov_handle_gallery_update_title_ajax');
