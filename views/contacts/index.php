<?php

require_once $_SERVER["DOCUMENT_ROOT"] . "/app/Repositories/ContactModelRepo.php";

$contacts = new ContactModelRepo();

?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Home</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
</head>

<body>
<main class="container my-5">
    <nav aria-label="breadcrumb" class="mb-5">
        <ol class="breadcrumb">
            <li class="breadcrumb-item active" aria-current="page">Home</li>
        </ol>
    </nav>

    <h1 class="mb-4">List of contacts</h1>

    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
        <a href="/views/contacts/create.php" class="btn btn-dark mb-4">Create new contact</a>
    </div>

    <div class="mb-4">
        <h2 class="mb-3">View all contacts</h2>
        <div class="alert alert-danger" style="display: none;" role="alert" id="contactDeleteException"></div>
        <div class="alert alert-success" style="display: none;" role="alert" id="contactDeleteSuccess">
            Success!
        </div>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>First name</th>
                    <th>Last name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Last update</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($contacts->getAll() as $contact): ?>
                    <tr>
                        <td><?= $contact->getId(); ?></td>
                        <td><?= $contact->getFirstName(); ?></td>
                        <td><?= $contact->getLastName(); ?></td>
                        <td><?= $contact->getEmail(); ?></td>
                        <td><?= $contact->getPhone(); ?></td>
                        <td><?= $contact->getUpdatedAtTimestamp(); ?></td>
                        <td>
                            <a href="/views/contacts/edit.php?id=<?= $contact->getId(); ?>"
                                class="btn btn-primary"
                            >
                                View
                            </a>

                            <button
                                onclick="deleteContact(this, <?= $contact->getId(); ?>)"
                                class="btn btn-danger"
                            >
                                Delete
                            </button>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</main>

<script src="/views/contacts/js/delete.js"></script>
</body>
</html>
