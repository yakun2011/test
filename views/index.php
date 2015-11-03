<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title></title>
</head>
<body>

<?php foreach($items as $item): ?>
    <?php echo '<img src= ' . $item['path'] . ' style="max-width:200px;">'; ?><br />
<?php endforeach; ?>
<br />
<a href="/add.php">Добавить фото</a> 
</body>
</html>