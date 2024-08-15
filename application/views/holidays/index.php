<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Daftar Holidays</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
</head>

<body>
	<div class="container mt-5">
		<h1 class="mb-4">Daftar Holidays</h1>
		<?php if ($this->session->flashdata('success')): ?>
			<div id="successMessage" class="alert alert-success">
				<?= $this->session->flashdata('success') ?>
			</div>
		<?php endif; ?>
		<?php if ($this->session->flashdata('error')): ?>
			<div id="errorMessage" class="alert alert-danger">
				<?= $this->session->flashdata('error') ?>
			</div>
		<?php endif; ?>

		<!-- Button trigger modal -->
		<div class="d-flex justify-content-end mb-3">
			<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
				Tambah Hari Libur
			</button>
		</div>

		<!-- Modal -->
		<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="exampleModalLabel">Tambah Hari Libur</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
						<?= form_open('holidays/store') ?>
						<div class="form-group">
							<label for="tanggal">Tanggal:</label>
							<input type="date" name="tanggal" id="tanggal" class="form-control" value="<?= set_value('tanggal') ?>" required>
							<?= form_error('tanggal', '<div class="text-danger">', '</div>') ?>
						</div>
						<div class="form-group">
							<label for="keterangan">Keterangan:</label>
							<input type="text" name="keterangan" id="keterangan" class="form-control" value="<?= set_value('keterangan') ?>">
							<?= form_error('keterangan', '<div class="text-danger">', '</div>') ?>
						</div>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
						<button type="submit" class="btn btn-primary">Save changes</button>
						<?= form_close() ?>
					</div>
				</div>
			</div>
		</div>
		<table class="table table-bordered">
			<thead>
				<tr>
					<th>ID</th>
					<th>Tanggal</th>
					<th>Keterangan</th>
					<th>Aksi</th>
				</tr>
			</thead>
			<tbody>
				<?php foreach ($holidays as $holiday): ?>
					<tr>
						<td><?php echo $holiday->id; ?></td>
						<td><?php echo $holiday->tanggal; ?></td>
						<td><?php echo $holiday->keterangan; ?></td>

						<td>
							<button class="btn btn-primary btn-sm" onclick="redirectToEditPage(<?= $holiday->id; ?>)">Edit</button>
							<a href="<?php echo site_url('holidays/delete/' . $holiday->id); ?>" class="btn btn-danger btn-sm" onclick="confirmDelete('Apakah Anda yakin ingin menghapus data ini?')">Delete</a>
						</td>
					</tr>
				<?php endforeach; ?>
			</tbody>
		</table>
	</div>

	<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>

	<script>
		function redirectToEditPage(holidayId) {
			window.location.href = '<?= base_url('holidays/edit/'); ?>' + holidayId;
		}

		function confirmDelete(holidayId) {
			if (confirm('Apakah Anda yakin ingin menghapus data ini?')) {
				window.location.href = '<?= base_url('holidays/delete/'); ?>' + holidayId;
			}
		}
	</script>
	<script>
		document.addEventListener("DOMContentLoaded", function() {
			// Set timeout duration in milliseconds
			var timeoutDuration = 5000; // 5 seconds

			// Hide success message after timeout
			var successMessage = document.getElementById('successMessage');
			if (successMessage) {
				setTimeout(function() {
					successMessage.style.opacity = '0';
					setTimeout(function() {
						successMessage.style.display = 'none';
					}, 600); // Match this delay with the transition duration
				}, timeoutDuration);
			}

			// Hide error message after timeout
			var errorMessage = document.getElementById('errorMessage');
			if (errorMessage) {
				setTimeout(function() {
					errorMessage.style.opacity = '0';
					setTimeout(function() {
						errorMessage.style.display = 'none';
					}, 600); // Match this delay with the transition duration
				}, timeoutDuration);
			}
		});
	</script>

</body>

</html>