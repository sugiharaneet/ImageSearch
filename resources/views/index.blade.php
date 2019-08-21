<html>
<head>
<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:url" content="http://good-1.xyz/ImageSearch/public/index.php">
<meta name="twitter:site" content="LorL_ero">
<meta name="twitter:title" content="Twitter画像ダウンローダー">
<meta name="twitter:description" content="試してみてね！">
<meta name="twitter:image" content="https://www.fnn.jp/image/program/00421750CX?n=1s=12_l">
</head>
<body>
</body>
</html>
<?php
if ($_SERVER["REQUEST_URI"] == '/ImageSearch/public/index') {
        header("Location: http://good-1.xyz/ImageSearch/public");
        exit;
} else {
        echo 'error';
}
