<?php
$title = "Forgot Password ? | Resume Builder";
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
            <form action="actions/sendcode.action.php" method="post">
                <div class="d-flex gap-2 justify-content-center">
                    <img class="mb-4" src="./assets/images/logo.png" alt="" height="70">

                    <div>
                        <h1 class="h3 fw-normal my-1"><b>Resume</b> Builder</h1>
                        <p class="m-0">Forgot your password</p>

                    </div>
                </div>



                <div class="form-floating mb-4">
                    <input type="email" class="form-control" id="floatingEmail" placeholder="name@example.com" name="email_id" required>
                    <label for="floatingInput"><i class="bi bi-envelope"></i> Email address</label>
                </div>



                <button class="btn btn-primary w-100 py-2" type="submit"><i class="bi bi-send"></i> Send Verification
                    Code

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