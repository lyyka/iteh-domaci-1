<?php

require_once $_SERVER["DOCUMENT_ROOT"] . "/app/Controllers/ContactEditController.php";

$controller = new ContactEditController();

$model = $controller->getContactById();

?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Update contact</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
</head>

<body>
<main class="container my-5">
    <nav aria-label="breadcrumb" class="mb-5">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Update contact</li>
        </ol>
    </nav>

    <h1 class="mb-4">Update contact</h1>

    <?php if($model) : ?>

        <div class="alert alert-danger" style="display: none;" role="alert" id="contactCreateException"></div>
        <div class="alert alert-success" style="display: none;" role="alert" id="contactCreateSuccess">
            Success!
        </div>

        <div class="mb-4">
            <form>
                <input type="hidden" id="id" value="<?= $model->getId() ?>" />

                <div class="row g-3">
                    <div class="col-md-6">
                        <label for="first_name" class="form-label">First name:</label>
                        <input type="text" class="form-control" placeholder="Jane"
                               value="<?= $model->getFirstName() ?>"
                               id="first_name" required>
                        <div class="invalid-feedback"></div>
                    </div>
                    <div class="col-md-6">
                        <label for="last_name" class="form-label">Last name:</label>
                        <input type="text" class="form-control" placeholder="Doe"
                               value="<?= $model->getLastName() ?>"
                               id="last_name" required>
                        <div class="invalid-feedback"></div>
                    </div>

                    <div class="col-md-6">
                        <label for="email" class="form-label">Email:</label>
                        <input type="email" class="form-control" placeholder="example@example.com"
                               value="<?= $model->getEmail() ?>"
                               id="email" required>
                        <div class="invalid-feedback"></div>
                    </div>
                    <div class="col-md-6">
                        <label for="phone" class="form-label">Phone:</label>
                        <input type="text" placeholder="123 123 123" class="form-control"
                               value="<?= $model->getPhone() ?>"
                               id="phone" required>
                        <div class="invalid-feedback"></div>
                    </div>
                </div>

                <div class="d-grid gap-2 d-md-flex justify-content-md-end mt-4">
                    <button type="button"
                            id="createContact"
                            class="btn btn-dark mb-4">Update</button>
                </div>
            </form>
        </div>

    <?php else : ?>
        <div class="alert alert-danger" role="alert" id="contactCreateException">
            Cannot load contact information :(
        </div>
    <?php endif; ?>
</main>

<script src="/views/contacts/js/create.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
</body>
</html>