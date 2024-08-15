<!DOCTYPE html>
<html>
<head>
    <title>Hapus User</title>
</head>
<body>
    <h1>Hapus User</h1>
    <p>Apakah Anda yakin ingin menghapus user berikut?</p>
    <form method="post" action="<?php echo site_url('user/delete'); ?>">
        <input type="hidden" name="id" value="<?php echo $user->id; ?>">
        <p>
            <strong>Nama:</strong> <?php echo $user->name; ?>
        </p>
        <p>
            <strong>Email:</strong> <?php echo $user->email; ?>
        </p>
        <p>
            <input type="submit" value="Hapus" style="background-color: red; color: white;">
            <a href="<?php echo site_url('user'); ?>">Batal</a>
        </p>
    </form>
</body>
</html>