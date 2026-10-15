<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="<?= asset("css/bootstrap.css"); ?>">
    <link rel="stylesheet" href="<?= asset("css/global.css"); ?>">

</head>

<body>



    <?php include __DIR__ . "/../components/Navbar.php" ?>

    <section id="Register">
        <div class="container my-5">
            <form class="w-25 m-auto" method="POST" action="<?= route("/auth/register") ?>">
                <h1 class="text-center mb-4 text-success">Register</h1>
                <?= getSessionMsg('successfully', false) ?>
                <?= getSessionMsg('invalid') ?>
                <div class="mb-3">
                    <label for="Role" class="form-label">Role :</label>
                    <select class="form-control" id="Role" name="role">

                        <option value="" <?= oldSelect('role', ''); ?> hidden></option>

                        <?php

                        if (isAuth('admin')) {

                            $select = oldSelect('role', 'admin' , true);

                            echo "
                                <option value='admin' {$select} >Admin</option>
                                ";
                        } else {

                            $select = oldSelect('role', 'customer', true);

                            echo "
                                <option value='customer' {$select} >Customer</option>
                                ";
                        }
                        ?>

                    </select>
                    <?= getErrors('role') ?>
                </div>
                <div class="mb-3">
                    <label for="Name" class="form-label">Name :</label>
                    <input type="text" class="form-control" id="Name" name="name" value="<?= old('name') ?>">
                    <?= getErrors('name') ?>
                </div>
                <div class="mb-3">
                    <label for="Email" class="form-label">Email :</label>
                    <input type="text" class="form-control" id="Email" name="email" value="<?= old('email') ?>">
                    <?= getErrors('email') ?>
                </div>
                <div class="mb-3">
                    <label for="Password" class="form-label">Password :</label>
                    <input type="password" class="form-control" id="Password" name="password" value="<?= old('password') ?>">
                    <?= getErrors('password') ?>
                </div>
                <div class="mb-3">
                    <label for="Phone" class="form-label">Phone :</label>
                    <input type="text" class="form-control" id="Phone" name="phone" value="<?= old('phone') ?>">
                    <?= getErrors('phone') ?>
                </div>
                <div class="mb-3">
                    <label for="Gender" class="form-label">Gender :</label>
                    <select class="form-control" id="Gender" name="gender">
                        <option value="" <?= oldSelect('gender', "") ?> hidden></option>
                        <option value="male" <?= oldSelect('gender', "male") ?>>Male</option>
                        <option value="female" <?= oldSelect('gender', "female", true) ?>>Female</option>
                    </select>
                    <?= getErrors('gender') ?>
                </div>
                <button type="submit" class="btn btn-success w-100">Register</button>
            </form>
        </div>
    </section>

    <script src="<?= asset("js/bootstrap.js"); ?>"></script>
    <script src="<?= asset("js/jquery.js"); ?>"></script>

</body>

</html>