<!-- application/views/user_edit.php -->
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Hari Libur</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

<body>
    <div class="container mt-5">
        <h1 class="mb-4">Edit Hari libur</h1>
        <form action="<?php echo site_url('holidays/update'); ?>" method="post">
    <input type="hidden" name="id" value="<?php echo $holidays->id; ?>">
    <div class="form-group">
        <label for="tanggal">Tanggal:</label>
        <input type="date" name="tanggal" id="tanggal" class="form-control" value="<?php echo $holidays->tanggal; ?>">
    </div>
    <div class="form-group">
        <label for="keterangan">Keterangan:</label>
        <input type="text" name="keterangan" id="keterangan" class="form-control" value="<?php echo $holidays->keterangan; ?>">
    </div>
    <button type="submit" class="btn btn-primary">Update</button>
	<a href="<?php echo base_url('holidays/index'); ?>" class="btn btn-secondary">Kembali ke Daftar</a>
</form>

    </div>
</body>

</html>
