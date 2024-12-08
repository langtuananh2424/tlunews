<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <title>Chi tiết bài báo</title>
</head>
<body>
<?php if (isset($detail)): ?> 
        <div class="container mt-5">
            <h1 class="mb-4 text-center"><?= htmlspecialchars($detail->getTitle()) ?></h1>

            <div class="text-center mb-4">
                <img src="<?= PATH.htmlspecialchars($detail->getImage()) ?>" alt="Ảnh bài báo" class="img-fluid rounded" style="max-height: 400px;">
            </div>

            <div class="mb-4">
                <p><?= nl2br(htmlspecialchars($detail->getContent())) ?></p>
            </div>

            <div class="text-muted">
                <small>Ngày viết: <?= htmlspecialchars($detail->getCreated_at()) ?></small>
            </div>

            <div class="mt-4">
                <a href="index.php?controller=home&action=index" class="btn btn-primary">Quay lại danh sách tin tức</a>
            </div>
        </div>
    <?php else: ?>
        <div class="container mt-5">
            <p>Không tìm thấy bài báo.</p>
        </div>
    <?php endif; ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
