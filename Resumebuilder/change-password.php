

<?php
$title = "Change Password | Resume Builder";
require './assets/includes/header.php';
$fn->nonAuthPage();
?>

<style>
  .form-signin {
            max-width: 550px;
            padding: 1rem;
        }
</style>

<div class="d-flex align-items-center p-3" style="height:100vh">

    <div class="w-100">
        <main class="form-signin w-100 m-auto bg-white shadow rounded">
            <form action="actions/changepassword.action.php" method="post">
                <div class="d-flex gap-2 justify-content-center">
                    <img class="mb-4" src="./assets/images/logo.png" alt="" height="70">

                    <div>
                        <h1 class="h3 fw-normal my-1"><b>Resume</b> Builder</h1>
                        <p class="m-0">Change Password</p>

                    </div>
                </div>


                <div class="mb-3">
                    <span class="mb-3 fw-bold"><?=$fn->getSession('email')==''?$fn->redirect('forgot-password.php'):$fn->getSession('email')?></span>
                </div>
                <div class="form-floating mb-4">
                    <input type="text" class="form-control" id="floatingEmail" name="password" placeholder="name@example.com" required>
                    <label for="floatingInput"><i class="bi bi-key"></i> Enter new password</label>
                </div>



                <button class="btn btn-primary w-100 py-2" type="submit"> Change Password

                </button>
                <div class="d-flex justify-content-between my-3">

                    <a href="register.php" class="text-decoration-none">Register</a>
                    <a href="login.php" class="text-decoration-none">Login</a>

                </div>

            </form>
        </main>

    </div>

    </div>
    <?php
require './assets/includes/footer.php';
?>