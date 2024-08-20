<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">

	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Daftar Hari Libur</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
	<style>
		body {
			font-family: 'Source Sans Pro', sans-serif;
			background-color: #ffffff;
			background-size: cover;
			background-repeat: no-repeat;
			background-attachment: fixed;
			background-position: center;
			padding: 20px;
		}

		.container {
			max-width: 1200px;
			margin: auto;
		}

		.card {
			background-color: #ffffff;
			border: 1px solid #dee2e6;
			border-radius: 0.25rem;
			box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05);
			margin-bottom: 20px;
		}
	</style>
	<style>
		.navbar {
			z-index: 1;
			position: fixed;
			width: 100%;
			top: 0;
			left: 0;
			background-color: #007bff;
			/* Primary color from Bootstrap */
		}

		.navbar-brand {
			color: #ffffff !important;
			font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
			font-size: 1.5rem;
			font-weight: bold;
			text-transform: uppercase;
			display: flex;
			align-items: center;
		}

		.navbar-brand img {
			max-height: 40px;
			margin-right: 10px;
		}

		.navbar-brand:hover {
			color: #d0d0d0 !important;
		}

		.navbar-nav .nav-link {
			color: #ffffff !important;
			font-size: 1.2rem;
			/* Larger font size for nav links */
			font-weight: 500;
			/* Medium weight for better readability */
		}

		.navbar-nav .nav-link:hover {
			color: #d0d0d0 !important;
		}

		.navbar-nav .nav-item.active .nav-link {
			font-weight: bold;
			/* Emphasize the active link */
			color: #f8f9fa !important;
			/* Lighter color for active link */
		}

		.container {
			margin-top: 80px;
			/* Adjust the margin-top to provide space for the fixed navbar */

		}

		.navbar-nav .nav-item.logout {
			margin-left: auto;
			/* Push the logout button to the right */
		}

		@media (max-width: 768px) {
			.navbar {
				background-color: #007bff;
			}

			.navbar-nav .nav-link {
				color: #ffffff !important;
				font-size: 1.1rem;
				/* Slightly smaller font size for mobile */
			}

			.navbar-nav .nav-link:hover {
				color: #d0d0d0 !important;
			}
		}
	</style>
</head>

<body>

	<nav class="navbar navbar-expand-lg navbar-dark bg-success">
		<div class="container-fluid">
			<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>
			<div class="collapse navbar-collapse" id="navbarNavDropdown">

				<ul class="navbar-nav">
					<li class="nav-item active">
						<a class="nav-link" href="<?php echo site_url('home'); ?>">Home </a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="<?php echo site_url('user/list'); ?>">User List</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="<?php echo site_url('holidays/index'); ?>">Holidays <span class="visually-hidden"></a>
					</li>

				</ul>
			</div>
			<ul class="navbar-nav ms-auto">
				<li class="nav-item logout">
					<a class="btn btn-danger" href="<?php echo site_url('auth/logout'); ?>">Logout <span class="visually-hidden"></a>
				</li>
			</ul>
		</div>
	</nav>

	<div class="container content ">
		<div class="card">
			<h1 class="mb-4 text-center">Daftar Holidays</h1>
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
				<button type="button" class="btn btn-success" data-toggle="modal" data-target="#exampleModal" style="margin-right: 20px;">
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