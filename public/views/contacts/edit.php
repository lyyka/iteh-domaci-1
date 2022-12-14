<?php

require_once $_SERVER["DOCUMENT_ROOT"] . "/app/Controllers/Contacts/ContactEditController.php";

$controller = new ContactEditController();

$model = null;
$deals = null;

try {
    $model = $controller->getContactById();
    $deals = $model ? $controller->getDealsForContact($model) : [];
} catch (Exception $e) { }

?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>
        <?php if($model) : ?>
            <?= 'Home / ' . $model->getFullName() ?>
        <?php else: ?>
            Home / Error
        <?php endif; ?>
    </title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
</head>

<body>
<main class="container my-5">
    <nav aria-label="breadcrumb" class="mb-5">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/">Home</a></li>
            <?php if($model) : ?>
                <li class="breadcrumb-item active" aria-current="page">
                    <?= $model->getFullName() ?>
                </li>
            <?php endif; ?>
        </ol>
    </nav>

    <?php if($model) : ?>
        <div class="mb-4">
            <h2 class="mb-4">Update contact</h2>

            <div class="alert alert-danger" style="display: none;" role="alert" id="contactCreateException"></div>
            <div class="alert alert-success" style="display: none;" role="alert" id="contactCreateSuccess">
                ✨ Success!
            </div>

            <form>
                <input type="hidden" id="id" value="<?= $model->getId() ?>" />

                <div class="row g-3">
                    <div class="col-md-6">
                        <label for="first_name" class="form-label"><span class="text-danger">*</span> First name:</label>
                        <input type="text" class="form-control" placeholder="Jane"
                               value="<?= $model->getFirstName() ?>"
                               id="first_name" required>
                        <div class="invalid-feedback"></div>
                    </div>
                    <div class="col-md-6">
                        <label for="last_name" class="form-label"><span class="text-danger">*</span> Last name:</label>
                        <input type="text" class="form-control" placeholder="Doe"
                               value="<?= $model->getLastName() ?>"
                               id="last_name" required>
                        <div class="invalid-feedback"></div>
                    </div>

                    <div class="col-md-6">
                        <label for="email" class="form-label"><span class="text-danger">*</span> Email:</label>
                        <input type="email" class="form-control" placeholder="example@example.com"
                               value="<?= $model->getEmail() ?>"
                               id="email" required>
                        <div class="invalid-feedback"></div>
                    </div>
                    <div class="col-md-6">
                        <label for="phone" class="form-label"><span class="text-danger">*</span> Phone:</label>
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

        <hr class="my-3" />

        <div class="mb-4">

            <div class="d-grid gap-2 d-md-flex justify-content-md-end mt-4">
                <a href="/public/views/deals/create.php?contact_id=<?= $model->getId() ?>"
                        class="btn btn-dark mb-4">+ New deal</a>
            </div>

            <h2 class="mb-4">Deals</h2>

            <?php if($deals !== null): ?>
                <div class="alert alert-danger" style="display: none;" role="alert" id="dealDeleteException"></div>
                <div class="alert alert-success" style="display: none;" role="alert" id="dealDeleteSuccess">
                    ✨ Success!
                </div>

                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Product</th>
                        <th>Sales Person</th>
                        <th>Value</th>
                        <th>Notes</th>
                        <th>Last update</th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach($deals as $deal): ?>
                        <tr>
                            <td><?= $deal->getId(); ?></td>
                            <td><?= $deal->getProduct()->getProductName(); ?></td>
                            <td><?= $deal->getSalesPerson()->getName(); ?></td>
                            <td><?= $deal->getDealValueLabel(); ?></td>
                            <td><?= $deal->getNotes(); ?></td>
                            <td><?= $deal->getUpdatedAtTimestamp(); ?></td>
                            <td>
                                <a href="/public/views/deals/edit.php?id=<?= $deal->getId(); ?>"
                                   class="btn btn-primary"
                                >
                                    Edit
                                </a>

                                <button
                                        onclick="deleteRow(this, <?= $deal->getId(); ?>,
                                                '/app/Controllers/Deals/DealDeleteController.php',
                                                '#dealDeleteException', '#dealDeleteSuccess')"
                                        class="btn btn-danger"
                                >
                                    Delete
                                </button>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            <?php else: ?>
                <div class="alert alert-danger" role="alert">
                    Cannot load deals!
                </div>
            <?php endif; ?>
        </div>
    <?php else : ?>
        <div class="alert alert-danger" role="alert">
            Cannot load contact information.
        </div>
    <?php endif; ?>
</main>

<?php if($model) : ?>
    <script src="/public/js/create.js"></script>
    <script src="/public/js/contacts/create.js"></script>
<?php endif; ?>

<?php if($deals): ?>
    <script src="/public/js/delete.js"></script>
<?php endif; ?>
</body>
</html>
