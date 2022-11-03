<?php

require 'app/Repositories/ContactModelRepo.php';

$contacts = new ContactModelRepo();

?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Contacts</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
</head>

<body>
<main class="container my-5">
    <p class="mb-5">
        <a href="/">
            Home
        </a> /
    </p>

    <h1 class="mb-4">List of contacts</h1>

    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
        <a href="/views/contacts/create.php" class="btn btn-dark mb-4">Create new contact</a>
    </div>

    <div class="mb-4">
        <h2 class="mb-3">View all contacts</h2>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>First name</th>
                    <th>Last name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Created at</th>
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
                        <td><?= $contact->getCreatedAtTimestamp(); ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</main>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
</body>
</html>
