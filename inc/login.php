<form method="POST" class="form-signin" style="margin-top: -160px;">
    <img src="admin/images/logo.svg">
    <p class="mb-4 mt-4 font-weight-normal">All your files in one place</p>
    <label for="inputNumber" class="sr-only">Student number</label>
    <input type="text" class="mb-3 form-control" placeholder="Number" name="employee_no" required autofocus>
    <label for="inputPassword" class="sr-only">Password</label>
    <input type="password" class="form-control" placeholder="Password" name="password" required>
    <?php include 'login_query.php'?>
    <button class="btn mt-4 btn-lg dark-button btn-block" name="login">Login</button>
</form>
