<?php $this->load->view('admin_header', ['title' => 'Manage Module Design Section']); ?>
<div class="main-content">
    <h1>Manage Module Design Section</h1>

    <!-- Add Button -->
    <div style="margin-bottom: 15px;">
        <a href="<?= site_url('admin/module_design_form') ?>" 
            style="display: inline-block; padding: 8px 16px; background-color: #28a745; color: white; text-decoration: none; border-radius: 4px; font-size: 14px;">
            ➕ Add New Post
        </a>
    </div>

    <table id="table" class="display">
        <thead>
            <tr>
                <th>ID</th>
                <th>Content</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($module_design as $value): ?>
                <tr>
                    <td><?= $value['id'] ?></td>
                    <td>
                        <?php if (!empty($value['filename'])): ?>
                            <img src="<?= base_url('assets/uploads/' . $value['filename']) ?>" style="height: 40px;">
                        <?php endif; ?>
                    </td>
                    <td>
                        <a href="<?= site_url('admin/module_design_form/' . $value['id']) ?>" 
                            style="display: inline-block; padding: 6px 12px; background-color: #007bff; color: white; text-decoration: none; border-radius: 4px; font-size: 14px;">
                            ✏️ Edit
                        </a>

                        <a href="<?= site_url('admin/delete_module_design/' . $value['id']) ?>"
                            onclick="return confirm('Are you sure you want to delete this entry?');"
                            style="display: inline-block; padding: 6px 12px; background-color: #dc3545; color: white; text-decoration: none; border-radius: 4px; font-size: 14px; margin-left: 5px;">
                            🗑️ Delete
                        </a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
