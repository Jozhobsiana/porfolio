<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?= isset($title) ? $title : 'Admin Dashboard' ?></title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <!-- <script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script> -->
    <script src="https://cdn.tiny.cloud/1/k9a52bx5s738tyzwak7tzd182k5pkv1cypabohwhh71558pe/tinymce/8/tinymce.min.js" referrerpolicy="origin" crossorigin="anonymous"></script>

    <!-- Place the following <script> and <textarea> tags your HTML's <body> -->
    <script>
    tinymce.init({
        selector: 'textarea',
        plugins: [
        // Core editing features
        'anchor', 'autolink', 'charmap', 'codesample', 'emoticons', 'image', 'link', 'lists', 'media', 'searchreplace', 'table', 'visualblocks', 'wordcount',
        // Your account includes a free trial of TinyMCE premium features
        // Try the most popular premium features until Aug 9, 2025:
        'checklist', 'mediaembed', 'casechange', 'formatpainter', 'pageembed', 'a11ychecker', 'tinymcespellchecker', 'permanentpen', 'powerpaste', 'advtable', 'advcode', 'editimage', 'advtemplate', 'ai', 'mentions', 'tinycomments', 'tableofcontents', 'footnotes', 'mergetags', 'autocorrect', 'typography', 'inlinecss', 'markdown','importword', 'exportword', 'exportpdf'
        ],
        toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table mergetags | addcomment showcomments | spellcheckdialog a11ycheck typography | align lineheight | checklist numlist bullist indent outdent | emoticons charmap | removeformat',
        tinycomments_mode: 'embedded',
        tinycomments_author: 'Author name',
        mergetags_list: [
        { value: 'First.Name', title: 'First Name' },
        { value: 'Email', title: 'Email' },
        ],
        ai_request: (request, respondWith) => respondWith.string(() => Promise.reject('See docs to implement AI Assistant')),
    });
    </script>

    <script>
    $(document).ready(function () {
        $('#table').DataTable();
    });
</script>
    <style>
        body {
            margin: 0;
            font-family: 'Roboto', sans-serif;
            background-color: #1f1f1f;
            color: #fff;
        }
        .sidebar {
            width: 250px;
            background-color: #2a2a2a;
            height: 100vh;
            position: fixed;
            padding: 20px;
            box-sizing: border-box;
        }
        .sidebar h2 {
            color: #ff6b6b;
            text-align: center;
        }
        .sidebar a {
            display: block;
            color: #ddd;
            padding: 10px;
            text-decoration: none;
            margin-bottom: 5px;
            border-radius: 5px;
            transition: 0.3s;
        }
        .sidebar a:hover {
            background-color: #444;
            color: #fff;
        }
        .main-content {
            margin-left: 250px;
            padding: 40px;
        }
        .main-content h1 {
            color: #ff6b6b;
        }
    .upload-wrapper {
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 10px;
    }

    .upload-preview {
        height: 120px;
        width: auto;
        border-radius: 8px;
        object-fit: cover;
        border: 1px solid #ccc;
        box-shadow: 0 2px 6px rgba(0,0,0,0.1);
    }

    .custom-file-upload {
        display: inline-block;
        padding: 8px 20px;
        cursor: pointer;
        background-color: #17a2b8;
        color: white;
        border-radius: 5px;
        font-size: 14px;
        transition: background-color 0.3s ease;
    }

    .custom-file-upload:hover {
        background-color: #138496;
    }

    #background {
        display: none;
    }

    .nav {
  display: flex;
  justify-content: space-between;
  align-items: center;
  background: #111;
  color: #fff;
  padding: 10px 20px;
  position: sticky;
  top: 0;
  z-index: 1000;
}

.nav-logo {
  font-size: 1.5rem;
  font-weight: bold;
}

.nav-toggle {
  display: none;
  font-size: 1.8rem;
  cursor: pointer;
}

nav {
  display: flex;
  gap: 15px;
}

nav a {
  color: #fff;
  text-decoration: none;
  padding: 8px;
  transition: background 0.3s;
}

nav a:hover {
  background: #333;
  border-radius: 5px;
}

/* Mobile styles */
@media (max-width: 768px) {
  .nav-toggle {
    display: block;
  }

  nav {
    display: none;
    flex-direction: column;
    width: 100%;
    background: #111;
    position: absolute;
    top: 60px;
    left: 0;
  }

  nav a {
    padding: 15px;
    border-top: 1px solid #333;
  }

  nav.show {
    display: flex;
  }
}

</style>

</head>
<body>

<div class="sidebar">
    <h2>Admin Panel</h2>
    <a href="<?= site_url('admin/home_index') ?>">Home</a>
    <a href="<?= site_url('admin/about_me_index') ?>">About Me</a>
    <a href="<?= site_url('admin/social_media_index') ?>">Social Media Content</a>
    <a href="<?= site_url('admin/video_index') ?>">Video</a>
    <a href="<?= site_url('admin/packaging_design_index') ?>">Packaging Design</a>
    <a href="<?= site_url('admin/module_design_index') ?>">Module Design</a>
    <a href="<?= site_url('admin/ecommerce_index') ?>">E-commerce Content</a>
    <a href="<?= site_url('admin/tarpaulin_index') ?>">Tarpaulin</a>
    <a href="<?= site_url('admin/logout') ?>">Logout</a>
</div>

<script>
    function previewFile() {
        const fileInput = document.getElementById('background');
        const file = fileInput.files[0];
        const preview = document.getElementById('previewImage');
        const reader = new FileReader();

        if (file && preview) {
            reader.onload = function (e) {
                preview.src = e.target.result;
                preview.style.display = 'block';
            };
            reader.readAsDataURL(file);
        } else if (preview) {
            preview.src = '';
            preview.style.display = 'none';
        }
    }
</script>
