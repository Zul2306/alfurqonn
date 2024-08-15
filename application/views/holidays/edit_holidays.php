<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Edit Pengguna</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body>
	<div class="container mt-5">
		<h1 class="mb-4">Edit Pengguna</h1>
		<form method="post" action="<?= base_url('user/update'); ?>">
			<input type="hidden" name="id" value="<?= $user->id; ?>">

			<div class="form-group">
				<label for="name">Nama:</label>
				<input type="text" name="name" id="name" class="form-control" value="<?= set_value('name', $user->name); ?>" required>
				<?= form_error('name', '<div class="text-danger">', '</div>'); ?>
			</div>

			<div class="form-group">
				<label for="email">Email:</label>
				<input type="email" name="email" id="email" class="form-control" value="<?= set_value('email', $user->email); ?>" required>
				<?= form_error('email', '<div class="text-danger">', '</div>'); ?>
			</div>

			<div class="form-group">
				<label for="password">Password (kosongkan jika tidak ingin diubah):</label>
				<input type="password" name="password" id="password" class="form-control">
				<?= form_error('password', '<div class="text-danger">', '</div>'); ?>
			</div>

			<button type="submit" class="btn btn-primary">Simpan</button>
			<a href="<?= base_url('user/list'); ?>" class="btn btn-secondary">Kembali ke Daftar</a>
		</form>
	</div>

	<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>