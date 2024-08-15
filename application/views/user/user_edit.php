<!-- application/views/user_edit.php -->
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Pengguna</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h1 class="mb-4">Edit Pengguna</h1>
        <form method="post" action="<?php echo base_url('user/update'); ?>">
        <input type="hidden" name="id" value="<?php echo $user->id; ?>">
            
            <div class="form-group">
                <label for="name">Nama:</label>
                <input type="text" name="name" id="name" class="form-control" value="<?= $user->name; ?>">
            </div>
            
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" name="email" id="email" class="form-control" value="<?= $user->email; ?>">
            </div>
            
            <div class="form-group">
                <label for="password">Password (kosongkan jika tidak ingin diubah):</label>
                <input type="password" name="password" id="password" class="form-control">
            </div>
            
            <button type="submit" class="btn btn-primary">Simpan</button>
            <a href="<?php echo base_url('user/list'); ?>" class="btn btn-secondary">Kembali ke Daftar</a>
        </form>
    </div>
</body>

</html>