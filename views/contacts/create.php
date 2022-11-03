<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Create new contact</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
</head>

<body>
<main class="container my-5">
    <p class="mb-5">
        <a href="/">
            Home
        </a> / Create new contact
    </p>

    <h1 class="mb-4">Create new contact</h1>

    <div class="mb-4">
        <form>
            <div class="row g-3">
                <div class="col-md-6">
                    <label for="first_name" class="form-label">First name:</label>
                    <input type="text" class="form-control" placeholder="Jane" id="first_name" required>
                </div>
                <div class="col-md-6">
                    <label for="last_name" class="form-label">Last name:</label>
                    <input type="text" class="form-control" placeholder="Doe" id="last_name" required>
                </div>

                <div class="col-md-6">
                    <label for="email" class="form-label">Email:</label>
                    <input type="email" class="form-control" placeholder="example@example.com" id="email" required>
                </div>
                <div class="col-md-6">
                    <label for="phone" class="form-label">Phone:</label>
                    <input type="text" placeholder="123 123 123" class="form-control" id="phone" required>
                </div>
            </div>

            <div class="d-grid gap-2 d-md-flex justify-content-md-end mt-4">
                <button type="button"
                        id="createContact"
                        class="btn btn-dark mb-4">Create new contact</button>
            </div>
        </form>
    </div>
</main>

<script src="/views/contacts/js/create.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
</body>
</html>