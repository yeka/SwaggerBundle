var GuruCMSWordpress = GuruCMSWordpress || {};
GuruCMSWordpress.ImageCategory = function()
{
    var featuredImage = '';
    this.init = function()
    {
        var selected_image = document.getElementById('cat_meta_img').getAttribute('value');
        if (isNaN(selected_image)) {
            selected_image = '';
        }
        wp.media.featuredImage.set(selected_image);
        featuredImage = wp.media.featuredImage.frame();
        featuredImage.on('select', onImageSelection);
        document.getElementById('remove-post-thumbnail').onclick = onRemoveImage;
        switchButton(selected_image == '' ? 1 : 0);
    }

    onImageSelection = function()
    {
        var attachment = featuredImage.state().get('selection').first().toJSON();
        var img = attachment.sizes.category_image_thumb || attachment.sizes.thumbnail || attachment.sizes.full;
        wp.media.featuredImage.set(attachment.id);
        document.getElementById('cat_meta_img').setAttribute('value', attachment.id);
        document.getElementById('cat_image').innerHTML = '<img src="' + img.url + '" />';
        switchButton(0);
    }

    onRemoveImage = function()
    {
        wp.media.featuredImage.set('');
        document.getElementById('cat_meta_img').setAttribute('value', '');
        document.getElementById('cat_image').innerHTML = '';
        switchButton(1);
        return false;
    }

    switchButton = function(showSetButton)
    {
        if (showSetButton) {
            document.getElementById('set-post-thumbnail').style.display = '';
            document.getElementById('remove-post-thumbnail').style.display = 'none';
        } else {
            document.getElementById('set-post-thumbnail').style.display = 'none';
            document.getElementById('remove-post-thumbnail').style.display = '';
        }
    }
}

var image_category = new GuruCMSWordpress.ImageCategory();
image_category.init();