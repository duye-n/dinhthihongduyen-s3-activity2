<?php

function validate_message($message)
{
    $message = trim($message); // Loại bỏ các khoảng trắng thừa
    if (strlen($message) < 10) {
        return "Message must be at least 10 characters long";
    }
    return "";
}

function validate_username($username)
{
    $username = trim($username); // Loại bỏ các khoảng trắng thừa
    if (empty($username)) {
        return "Please enter a username";
    }
    if (!ctype_alnum($username)) {
        return "Username should contain only letters and numbers";
    }
    return "";
}

function validate_email($email)
{
    $email = trim($email); // Loại bỏ các khoảng trắng thừa
    if (empty($email)) {
        return "Please enter an email";
    }
    if (!strpos($email, '@')) {
        return "Email have to has '@'";
    }
    return "";
}

$user_error = "";
$email_error = "";
$terms_error = "";
$message_error = "";
$username = "";
$email = "";
$message = "";

$form_valid = false;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = htmlspecialchars($_POST['username']);
    $email = htmlspecialchars ($_POST['email']);
    $message = htmlspecialchars  ($_POST['message']);

    // Kiểm tra các trường dữ liệu
    $message_error = validate_message($message);
    $username_error = validate_username($username);
    $email_error = validate_email($email);

    // Kiểm tra checkbox "Terms of Service"
    if (!isset($_POST['terms'])) {
        $terms_error = "You must accept the Terms of Service";
    }

    // Kiểm tra nếu không có lỗi
    if (empty($message_error) && empty($username_error) && empty($email_error) && empty($terms_error)) {
        $form_valid = true;
    }
}
?>

<form action="#" method="post">
    <div class="row mb-3 mt-3">
        <div class="col">
            <input type="text" class="form-control" placeholder="Enter Name" name="username" value="<?php echo $username; ?>">
            <small class="form-text text-danger"> <?php echo isset($username_error) ? $username_error : ''; ?></small>
        </div>
        <div class="col">
            <input type="text" class="form-control" placeholder="Enter email" name="email" value="<?php echo $email; ?>">
            <small class="form-text text-danger"> <?php echo isset($email_error) ? $email_error : ''; ?></small>
        </div>
    </div>
    <div class="mb-3">
        <textarea name="message" placeholder="Enter message" class="form-control"><?php echo $message; ?></textarea>
        <small class="form-text text-danger"> <?php echo isset($message_error) ? $message_error : ''; ?></small>
    </div>
    <div class="mb-3">
        <input type="checkbox" class="form-control-check" name="terms" id="terms" value="terms"> <label for="terms">I accept the Terms of Service</label>
        <small class="form-text text-danger"> <?php echo isset($terms_error) ? $terms_error : ''; ?></small>
    </div>
    <div class="d-grid">
        <button type="submit" class="btn btn-primary">Submit</button>
    </div>
</form>

<hr>

<?php
if ($form_valid) :
?>
    <div class="card">
        <div class="card-header">
            <p><?php echo $username; ?></p>
            <p><?php echo $email; ?></p>
        </div>
        <div class="card-body">
            <p class="card-text"><?php echo $message; ?></p>
        </div>
    </div>
<?php
endif;
?>