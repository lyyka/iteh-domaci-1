window.addEventListener('DOMContentLoaded', function () {
    const button = document.querySelector("#createDeal");

    button.addEventListener('click', () => {
        const idField = document.querySelector('#id');
        const id = idField ? idField.value : '';

        const contactId = document.querySelector('#contact_id').value;
        const productId = document.querySelector('#product_id').value;
        const salesPersonId = document.querySelector('#sales_person_id').value;
        const dealValueCurrency = document.querySelector('#deal_value_currency').value ?? 'null';
        const dealValue = document.querySelector('#deal_value').value ?? 'null';
        const notes = document.querySelector('#notes').value;

        const successAlertId = "#dealCreateSuccess";
        const exceptionAlertId = "#dealCreateException";
        const route = "/app/Controllers/Deals/DealCreateController.php";
        const query = `id=${id}&contact_id=${contactId}&product_id=${productId}&sales_person_id=${salesPersonId}&deal_value_currency=${dealValueCurrency}&deal_value=${dealValue}&notes=${notes}`;

        create(button.closest('form'), route, query, id, successAlertId, exceptionAlertId);
    });
});
