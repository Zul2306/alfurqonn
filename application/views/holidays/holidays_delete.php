<!DOCTYPE html>
<html>
<head>
    <title>Hapus Data</title>
</head>
<body>
    <h1>Hapus Data</h1>
    <p>Apakah Anda yakin ingin menghapus data berikut?</p>
    <form method="post" action="<?php echo site_url('holidays/delete'); ?>">
        <input type="hidden" name="id" value="<?php echo $user->id; ?>">
        <p>
            <strong>Nama:</strong> <?php echo $user->name; ?>
        </p>
        <p>
            <strong>Email:</strong> <?php echo $user->email; ?>
        </p>
        <p>
            <input type="submit" value="Hapus" style="background-color: red; color: white;">
            <a href="<?php echo site_url('holidays'); ?>">Batal</a>
        </p>
    </form>
</body>
</html>