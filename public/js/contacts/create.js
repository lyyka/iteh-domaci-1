window.addEventListener('DOMContentLoaded', function () {
    const button = document.querySelector("#createContact");

    button.addEventListener('click', () => {
        const idField = document.querySelector('#id');
        const id = idField ? idField.value : '';

        const firstName = document.querySelector('#first_name').value;
        const lastName = document.querySelector('#last_name').value;
        const email = document.querySelector('#email').value;
        const phone = document.querySelector('#phone').value;

        const successAlertId = "#contactCreateSuccess";
        const exceptionAlertId = "#contactCreateException";
        const route = "/app/Controllers/Contacts/ContactCreateController.php";
        const query = `id=${id}&first_name=${firstName}&last_name=${lastName}&email=${email}&phone=${phone}`;

        create(button.closest('form'), route, query, id, successAlertId, exceptionAlertId);
    });
});
