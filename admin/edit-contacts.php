<?php
session_start();
$pageTitle = 'Contacts';
include './init.php';
if (isset($_SESSION['username'])) {
  $do = isset($_GET['do']) ? $_GET['do'] : 'dashboard';
  $ListContacts = $con->prepare("SELECT * FROM `contacts`  ORDER BY `contact_time` DESC");
  $ListContacts->execute();
  $Contacts = $ListContacts->fetchAll(PDO::FETCH_ASSOC);
  if ($do == 'dashboard') {
?>
    <div class="contacts">
      <div class="container">
        <h1>Messages</h1>
        <div class="table-responsive">
          <?php if (isset($_SESSION['message'])) : ?>
            <div id="message">
              <?php echo $_SESSION['message']; ?>
            </div>
          <?php unset($_SESSION['message']);
          endif; ?>
          <table class="table table-bordered">
            <thead>
              <tr class="text-bg-light">
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Subject</th>
                <th>Message</th>
                <th>Contact Time</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($Contacts as $contact) : ?>
                <tr>
                  <td>
                    <?php echo $contact['contact_id'] ?>
                  </td>
                  <td>
                    <?php echo $contact['name'] ?>
                  </td>
                  <td>
                    <?php echo $contact['email'] ?>
                  </td>
                  <td>
                    <?php echo $contact['subject'] ?>
                  </td>
                  <td>
                    <?php echo $contact['message'] ?>
                  </td>
                  <td>
                    <?php echo $contact['contact_time'] ?>
                  </td>
                  <td>
                    <form action="./edit-contacts.php?do=action" method="post">
                      <input type="hidden" name="id" value="<?php echo $contact['contact_id']; ?>">
                      <div class="d-grid gap-2 d-md-block">
                        <button type="submit" class="btn btn-danger" name="btn_delete"><i class="fa-solid fa-trash"></i>&nbsp;Delete</button>
                      </div>
                    </form>
                  </td>
                </tr>
              <?php endforeach; ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
    <?php
  } elseif ($do == 'action') {
    if (isset($_POST['btn_delete'])) {
      $id = $_POST['id'];
      $stmt = $con->prepare("DELETE FROM contacts WHERE `contacts`.`contact_id` = ?");
      $stmt->execute([$id]);
      show_message('Message deleted successfully', 'success');
      header('location: ' . $_SERVER['HTTP_REFERER']);
      exit();
    } else {
      header('location: edit-contacts.php');
      exit();
    }
  }
} 
include $tpl . 'footer.php'; ?>