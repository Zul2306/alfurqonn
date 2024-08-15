<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Daftar User</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
</head>

<body>
  <div class="container mt-5">
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
            }}
</script>
</html>