<?php

/**
 * Provide a admin area view for the plugin
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @link       dream.team
 * @since      1.0.0
 *
 * @package    Amazing
 * @subpackage Amazing/admin/partials
 */

/* Add new row into DB */

global $wpdb;
$table_name = $wpdb->prefix . 'slider_item';

/* Add slider */

if(array_key_exists("submit_slider_item", $_POST))
{
    $website = $_POST["website"];
    $description = $_POST["description"];
    $img = & $_FILES['img_add'];
    Amazing_Admin::addNewSlider($wpdb, $table_name, $img, $website, $description );
    ?>
    <div id="setting_error-settings_updated" class="updated settings-error notice is_dismissible">
        New Slider Successfully Added
    </div>
<?php } 

/* Update slider */

elseif(array_key_exists("update_slider_by_id", $_POST))
{
    $id = $_POST["id"];
    $website = $_POST["website"];
    $description = $_POST["description"];
    $img = & $_FILES['img_path'];
    Amazing_Admin::updateSlider($wpdb, $table_name, $id, $img, $website, $description );
    ?>
    <div id="setting_error-settings_updated" class="updated settings-error notice is_dismissible">
        Slider Successfully Updated
    </div>
<?php } 

/* Delete slider from DB */

elseif(array_key_exists("delete_slider_by_id", $_POST))
{
    $id = $_POST["id"];
    Amazing_Admin::deleteSlider($wpdb, $table_name, $id);
}
    
?>

<!-- This file should primarily consist of HTML with a little bit of PHP. -->

<div class="wrap">
    <h2>Admin Settings</h2>
    <h3> For using following slider please add shortcode '[custom_slider]' </h3>
    <hr>

<!-- Show Preview from db -->
    <h2>Your future sliders</h2>

<?php if(!Amazing_Admin::displaySlider($wpdb)) : ?>
    <div class="preview-table">Here will be your slides</div>
<?php else: ?>
    <div class="preview-table">
        <?php foreach(Amazing_Admin::displaySlider($wpdb) as $item){ ?>
            <li class="preview-table-item">
                <h4>Current slider # <?php echo $item->id; ?></h4>
                <img class="img" src="<?php echo $item->img_path;?>" alt="">
                <div class="web-site">
                    <a href="https://<?php echo $item->website; ?>" target="_blank">
                    <?php echo $item->website; ?>
                </a></div>
                <span class="partners-title"><?php echo $item->description; ?></span>
                <span class="date"><?php echo $item->new_date; ?></span>
                <div class="preview-table-button">
                    <span class="common-button update-button" onclick="showModal(true, <?php echo $item->id; ?>)" >EDIT</span>
                    <div class="edit-table hide" >
                        <div class="title-box">
                            <button class="common-button close-button position" onclick="showModal(false, <?php echo $item->id; ?>)">X</button>
                            <h2>To Edit current slide <?php echo $item->id; ?> please fill up following fields</h2>
                        </div>
                        <form class="update_slider" enctype="multipart/form-data" method="post" action="">
                            <?php wp_nonce_field( 'img_path', 'fileup_nonce' ); ?>
                            <label for="upload-img" class="common-button upload-img button">load image...</label>
                            <input type="file" name="img_path" id="upload-img"></input>
                            <label for="website">Website</label>
                            <textarea name="website" class="large-text" placeholder="Put your website here"></textarea>
                            <label for="description">Description</label>
                            <textarea name="description" class="large-text" placeholder="Put your description here"></textarea>
                            <input type="submit" name="update_slider_by_id" class="common-button update-button mrg" value="SUBMIT" />
                            <input type="hidden" name="id" value="<?php echo $item->id; ?>" />
                    </form>
                </div>
                    <form method="post" action="">
                        <input type="submit" name="delete_slider_by_id" class="common-button delete-button" value="DELETE" />
                        <input type="hidden" name="id" value="<?php echo $item->id; ?>" />
                    </form>
                </div>
            </li>
        <?php } ?>
        </div>
<?php endif ?>

<!-- Add new slider -->

    <div>
        <h2>Please fill up following fields</h2>

        <form method="post" enctype="multipart/form-data" action="" id="add_new_slider" >
            <?php wp_nonce_field( 'img_add', 'fileup_nonce' ); ?>
            <label for="upload-img" class="upload-img button">load image...</label>
            <input type="file" name="img_add" id="upload-img"></input>
            <label for="website">Website</label>
            <textarea type="text" name="website" class="large-text" placeholder="Put your website here"></textarea>
            <label for="description">Description</label>
            <textarea type="text" name="description" class="large-text" placeholder="Put your description here"></textarea>
            <input type="submit" name="submit_slider_item" class="button button-primary submit-button" value="ADD SLIDER"></input>
        </form>
    </div>
</div>
