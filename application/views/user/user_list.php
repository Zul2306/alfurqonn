<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Daftar User</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
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
  <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
    <div class="container-fluid">

      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNavDropdown">

        <ul class="navbar-nav">
          <li class="nav-item active">
            <a class="nav-link" href="<?php echo site_url('home'); ?>">Home <span class="sr-only">(current)</span></a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="<?php echo site_url('user/list'); ?>">User List <span class="visually-hidden"></a>
          <li class="nav-item">
            <a class="nav-link" href="<?php echo site_url('holidays/index'); ?>">Holidays </span></a>
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

  <div class="container content">
    <h1 class="mb-4">Daftar User</h1>
    <table class="table table-bordered">
      <thead>
        <tr>
          <th>ID</th>
          <th>Name</th>
          <th>Email</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($users as $user): ?>
          <tr>
            <td><?php echo $user->id; ?></td>
            <td><?php echo $user->name; ?></td>
            <td><?php echo $user->email; ?></td>
            <td>

              <!-- Tambahkan tombol tanpa link untuk pengujian -->

              <button class="btn btn-primary btn-sm" onclick="redirectToEditPage(<?= $user->id; ?>)">Edit</button>
              <button class="btn btn-danger btn-sm" onclick="confirmDelete(<?= $user->id; ?>)">Delete</button>
            </td>

          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>

  </div>
  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</body>

<script>
  function redirectToEditPage(userId) {
    window.location.href = '<?= base_url('user/edit/'); ?>' + userId;
  }
</script>

<script>
  function confirmDelete(userId) {
    if (confirm('Apakah Anda yakin ingin menghapus user ini?')) {
      // Redirect ke URL penghapusan jika user menekan "OK"
      window.location.href = '<?= base_url('user/delete/'); ?>' + userId;
    }
  }
</script>

</html>