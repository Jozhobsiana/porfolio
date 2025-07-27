<?php $this->load->view('admin_header', ['title' => isset($home) ? 'Edit Home Section' : 'Create Home Section']); ?>

<div class="main-content">
    <h2 style="text-align: center; margin-bottom: 20px;">
        <?= isset($home) ? 'Edit Home Section' : 'Create New Home Section' ?>
    </h2>

    <form action="<?= site_url('admin/update_home/' .@$home['id']) ?>" method="post" enctype="multipart/form-data">
        <div style="margin-bottom: 15px;">
            <label for="title" style="display: block; font-weight: bold; margin-bottom: 5px;">Title</label>
            <input type="text" name="title" id="title" value="<?= @$home['title'] ?>" required style="width: 100%; padding: 8px; border: 1px solid #ccc; border-radius: 4px;">
        </div>

        <div style="margin-bottom: 15px;">
            <label for="content" style="display: block; font-weight: bold; margin-bottom: 5px;">Content</label>
            <textarea name="content" id="content" rows="6" required style="width: 100%; padding: 8px; border: 1px solid #ccc; border-radius: 4px;"><?= @$home['content'] ?></textarea>
        </div>
        <div style="margin-bottom: 20px;">
            <label style="font-weight: bold; display: block; margin-bottom: 8px;">Image</label>
            <div class="upload-wrapper">
                <img id="previewImage" 
                    src="<?= !empty($home['background']) ? base_url('assets/uploads/' . $home['background']) : '' ?>" 
                    class="upload-preview"
                    alt="Preview Image"
                    onerror="this.style.display='none'">

                <label for="background" class="custom-file-upload">📁 Choose Image</label>
                <input type="file" name="background" id="background" accept="image/*" onchange="previewFile()">
            </div>
        </div>
        <div style="text-align: center; margin-top: 25px;">
            <button type="submit" style="padding: 10px 20px; background-color: #007bff; border: none; color: white; border-radius: 4px; cursor: pointer;">
                <?= isset($home) ? 'Update' : 'Create' ?>
            </button>
            <a href="<?= site_url('admin/home_index') ?>" style="margin-left: 15px; padding: 10px 20px; background-color: #6c757d; color: white; text-decoration: none; border-radius: 4px;">Cancel</a>
        </div>
    </form>
</div>

</body>
</html>
