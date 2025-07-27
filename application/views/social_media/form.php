<?php $this->load->view('admin_header', [
    'title' => isset($social_media) ? 'Edit Social Media Section' : 'Create Social Media Section'
]); ?>

<div class="main-content">
    <h2 style="text-align: center; margin-bottom: 20px;">
        <?= isset($social_media) ? 'Edit Social Media Section' : 'Create New Social Media Section' ?>
    </h2>

    <form action="<?= site_url('admin/save_social_media' . (isset($social_media['id']) ? '/' . $social_media['id'] : '')) ?>" method="post" enctype="multipart/form-data">
        <div style="margin-bottom: 20px;">
            <label style="font-weight: bold; display: block; margin-bottom: 8px;">Content File (Image or Video)</label>
            <div class="upload-wrapper">
                <?php if (!empty($social_media['filename'])): ?>
                    <?php
                        $ext = pathinfo($social_media['filename'], PATHINFO_EXTENSION);
                        $is_video = in_array(strtolower($ext), ['mp4', 'webm', 'ogg']);
                    ?>
                    <?php if ($is_video): ?>
                        <video width="320" height="240" controls style="display:block; margin-bottom: 10px;">
                            <source src="<?= base_url('assets/uploads/' . $social_media['filename']) ?>" type="video/<?= $ext ?>">
                            Your browser does not support the video tag.
                        </video>
                    <?php else: ?>
                        <img id="previewImage"
                             src="<?= base_url('assets/uploads/' . $social_media['filename']) ?>"
                             class="upload-preview"
                             alt="Preview Image"
                             style="max-width: 200px; display: block; margin-bottom: 10px;">
                    <?php endif; ?>
                <?php endif; ?>

                <label for="background" class="custom-file-upload">📁 Choose File</label>
                <input type="file" name="media" id="background" accept="image/*,video/*" onchange="previewFile()">
            </div>
        </div>

        <div style="text-align: center; margin-top: 25px;">
            <button type="submit" style="padding: 10px 20px; background-color: #007bff; border: none; color: white; border-radius: 4px; cursor: pointer;">
                <?= isset($social_media) ? 'Update' : 'Create' ?>
            </button>
            <a href="<?= site_url('admin/save_social_media') ?>" style="margin-left: 15px; padding: 10px 20px; background-color: #6c757d; color: white; text-decoration: none; border-radius: 4px;">Cancel</a>
        </div>
    </form>
</div>

</body>
</html>
