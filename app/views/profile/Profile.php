<?php
require_once __DIR__ . '/components/function.php';
require_once __DIR__ . '/components/edit_popups.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile | <?= ucfirst(auth('role')) ?></title>

    <link rel="stylesheet" href="<?= asset("css/all.min.css"); ?>">
    <link rel="stylesheet" href="<?= asset("css/bootstrap.css"); ?>">
    <link rel="stylesheet" href="<?= asset("css/global.css"); ?>">
    <link rel="stylesheet" href="<?= asset("css/font.css"); ?>">



</head>

<body>

    <?php include __DIR__ . "/../components/Navbar.php"; ?>


    <section id="Profile" class="py-4">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-3">
                    <div class="item">
                        <div class="card px-2 py-3 rounded-4">
                            <img src=" <?= asset("/images/" . auth('role') . ".png") ?>" style="width: 100px" class="card-img-top m-auto d-block" alt="...">
                            <div class="card-body">

                                <h5 class="card-title mb-4 text-center d-flex align-items-center justify-content-center gap-2">

                                    <span class="fw-semibold">
                                        <?= auth('name') ?>
                                    </span>

                                    <button type="button"
                                        class="btn btn-light text-info rounded-circle p-0 shadow-sm"
                                        style="width: 30px; height: 30px;"
                                        data-bs-toggle="modal"
                                        data-bs-target="#editProfileNameModal"
                                        title="Edit Name">

                                        <i class="fa-solid fa-pen-to-square"></i>

                                    </button>

                                </h5>

                                <div class="row align-items-center py-2 border-bottom">

                                    <div class="col-5">
                                        <div class="d-flex align-items-center gap-3">

                                            <div class="text-info">
                                                <i class="fa-solid fa-envelope"></i>
                                            </div>

                                            <span class="fw-semibold text-secondary">
                                                Email :
                                            </span>

                                        </div>
                                    </div>

                                    <div class="col-7">
                                        <div class="d-flex align-items-center justify-content-between gap-3">

                                            <span class="text-dark text-truncate">
                                                <?= auth('email') ?>
                                            </span>

                                            <button type="button"
                                                class="btn btn-light text-info rounded-circle p-0 shadow-sm"
                                                style="width: 30px; height: 30px;"
                                                data-bs-toggle="modal"
                                                data-bs-target="#editProfileEmailModal"
                                                title="Edit Email">

                                                <i class="fa-solid fa-pen-to-square"></i>

                                            </button>

                                        </div>
                                    </div>

                                </div>

                                <div class="row align-items-center py-2 border-bottom">
                                    <div class="col-5">
                                        <div class="d-flex align-items-center gap-3">

                                            <i class="fa-solid fa-person-half-dress text-info fs-5"></i>

                                            <span class="fw-semibold text-secondary">
                                                Gender :
                                            </span>

                                        </div>
                                    </div>

                                    <div class="col-7">
                                        <div class="d-flex align-items-center justify-content-between gap-3">

                                            <span class="text-dark">
                                                <?= auth('gender') ?>
                                            </span>

                                            <button type="button"
                                                class="btn btn-light text-info rounded-circle p-0 shadow-sm"
                                                style="width: 30px; height: 30px;"
                                                data-bs-toggle="modal"
                                                data-bs-target="#editProfileGenderModal"
                                                title="Edit Gender">

                                                <i class="fa-solid fa-pen-to-square"></i>

                                            </button>

                                        </div>
                                    </div>
                                </div>

                                <div class="row align-items-center py-2 border-bottom">
                                    <div class="col-5">
                                        <div class="d-flex align-items-center gap-3">

                                            <i class="fa-solid fa-phone text-info"></i>

                                            <span class="fw-semibold text-secondary">
                                                Phone :
                                            </span>

                                        </div>
                                    </div>

                                    <div class="col-7">
                                        <div class="d-flex align-items-center justify-content-between gap-3">

                                            <span class="text-dark">
                                                <?= auth('phone') ?>
                                            </span>

                                            <button type="button"
                                                class="btn btn-light text-info rounded-circle p-0 shadow-sm"
                                                style="width: 30px; height: 30px;"
                                                data-bs-toggle="modal"
                                                data-bs-target="#editProfilePhoneModal"
                                                title="Edit Phone">

                                                <i class="fa-solid fa-pen-to-square"></i>

                                            </button>

                                        </div>
                                    </div>
                                </div>

                                <div class="row align-items-center py-2">
                                    <div class="col-5">
                                        <div class="d-flex align-items-center gap-3">

                                            <i class="fa-solid fa-lock text-info"></i>

                                            <span class="fw-semibold text-secondary">
                                                Password
                                            </span>

                                        </div>
                                    </div>

                                    <div class="col-7">
                                        <div class="d-flex align-items-center justify-content-between gap-2">

                                            <span class="text-dark">
                                                ••••••••
                                            </span>

                                            <button type="button"
                                                class="btn btn-light text-info rounded-circle p-0 shadow-sm"
                                                style="width: 30px; height: 30px;"
                                                data-bs-toggle="modal"
                                                data-bs-target="#editProfilePasswordModal"
                                                title="Change Password">

                                                <i class="fa-solid fa-pen-to-square"></i>

                                            </button>

                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-9">
                    <?php 
                        if(isAuth('admin')){
                            include __DIR__ . "/components/admin_links.php";
                        }elseif(isAuth('customer')){
                            include __DIR__ . "/components/customer_links.php";
                        }
                    ?>
                </div>
            </div>
        </div>
    </section>


    <script src="<?= asset("js/bootstrap.js"); ?>"></script>
    <script src="<?= asset("js/jquery.js"); ?>"></script>
    <script src="<?= asset("js/sweetalert.js"); ?>"></script>
    <script src="<?= asset("js/profile/function.js"); ?>"></script>
    <script src="<?= asset("js/profile/profile.js"); ?>"></script>

    <?php 
    if(isAuth('customer')){
        echo "<script src='". asset('js/profile/customer.js') ."'></script>";
    }
    ?>


    <?php
    $editAlert = $_SESSION['editAlert'] ?? null;
    unset($_SESSION['editAlert']);
    ?>

    <script>
        isError(<?= json_encode($editAlert) ?? null ?>);
    </script>


</body>

</html>