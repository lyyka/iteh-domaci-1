<?php

require_once $_SERVER["DOCUMENT_ROOT"] . "/app/Controllers/Deals/DealEditController.php";

$controller = new DealEditController();

$deal = null;
$products = [];
$salesPeople = [];

try {
    $deal = $controller->getDealById();
    $products = $controller->getProductOptions();
    $salesPeople = $controller->getSalesPeopleOptions();
} catch (Exception $e) { }

$contact = $deal?->getContact();

?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>
        <?php if($deal): ?>
            Home / <?= $contact->getFullName() ?> / Deal #<?= $deal->getId() ?>
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
            <?php if($deal): ?>
                <li class="breadcrumb-item"><a href="/public/views/contacts/edit.php?id=<?= $contact->getId() ?>"><?= $contact->getFullName() ?></a></li>
                <li class="breadcrumb-item active" aria-current="page">Deal #<?= $deal->getId() ?></li>
            <?php endif; ?>
        </ol>
    </nav>

    <?php if($deal): ?>
        <h1 class="mb-4">Update deal</h1>

        <div class="alert alert-danger" style="display: none;" role="alert" id="dealCreateException"></div>
        <div class="alert alert-success" style="display: none;" role="alert" id="dealCreateSuccess">
            ✨ Success!
        </div>

        <div class="mb-4">
            <form>
                <input type="hidden" id="id" value="<?= $deal->getId() ?>" />

                <div class="row g-3">
                    <div class="col-md-4">
                        <label for="selected_contact_placeholder" class="form-label"><span class="text-danger">*</span> Contact:</label>
                        <input type="hidden" id="contact_id" value="<?= $contact->getId() ?>" />
                        <input type="text" class="form-control"
                               value="<?= $contact->getFullName() ?>"
                               disabled
                               id="selected_contact_placeholder">
                        <div class="invalid-feedback"></div>
                    </div>
                    <div class="col-md-4">
                        <label for="product_id" class="form-label"><span class="text-danger">*</span> Product:</label>
                        <select id="product_id" class="form-control">
                            <?php foreach($products as $productOption): ?>
                                <option
                                    <?= $deal->getProductId() == $productOption->getId() ? 'selected' : '' ?>
                                    value="<?= $productOption->getId() ?>"><?= $productOption->getProductName() ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label for="sales_person_id" class="form-label"><span class="text-danger">*</span> Sales person:</label>
                        <select id="sales_person_id" class="form-control">
                            <?php foreach($salesPeople as $salesPersonOption): ?>
                                <option
                                    <?= $deal->getSalesPersonId() == $salesPersonOption->getId() ? 'selected' : '' ?>
                                    value="<?= $salesPersonOption->getId() ?>"><?= $salesPersonOption->getName() ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="col-md-6">
                        <label for="deal_value_currency" class="form-label">Currency:</label>
                        <input type="text" class="form-control"
                               value="<?= $deal->getDealValueCurrency() ?>"
                               placeholder="EUR" id="deal_value_currency">
                        <div class="invalid-feedback"></div>
                    </div>
                    <div class="col-md-6">
                        <label for="deal_value" class="form-label">Value:</label>
                        <input type="number" step=".01" min="0"
                               value="<?= $deal->getDealValue() ?>"
                               placeholder="1.500" class="form-control" id="deal_value">
                        <div class="invalid-feedback"></div>
                    </div>

                    <div>
                        <label for="notes" class="form-label">Notes:</label>
                        <textarea id="notes" class="form-control"
                                  placeholder="Appointment set for Tuesday @ 2PM"><?= $deal->getNotes() ?></textarea>
                        <div class="invalid-feedback"></div>
                    </div>
                </div>

                <div class="d-grid gap-2 d-md-flex justify-content-md-end mt-4">
                    <button type="button"
                            id="createDeal"
                            class="btn btn-dark mb-4">Update deal</button>
                </div>
            </form>
        </div>
    <?php else: ?>
        <div class="alert alert-danger" role="alert">
            Cannot load deal information.
        </div>
    <?php endif; ?>
</main>

<?php if($deal): ?>
    <script src="/public/js/create.js"></script>
    <script src="/public/js/deals/create.js"></script>
<?php endif; ?>
</body>
</html>
