<html>
<head>
<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:url" content="https://yesm.site/ImageSearch/public/index.php">
<meta name="twitter:site" content="LorL_ero">
<meta name="twitter:title" content="Twitter画像ダウンローダー">
<meta name="twitter:description" content="試してみてね！">
<meta name="twitter:image" content="https://www.axa-direct.co.jp/pet/pet-ms/img/media/2016/08/img_microchip_002.jpg">
</head>
<body>
</body>
</html>
<?php
if ($_SERVER["REQUEST_URI"] == '/ImageSearch/public/index?abcdef') {
        header("Location: https://yesm.site/ImageSearch/public");
        exit;
} else {
        echo 'error';
}
