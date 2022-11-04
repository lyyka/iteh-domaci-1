window.addEventListener('DOMContentLoaded', function () {
    const button = document.querySelector("#createContact");
    const form = button.closest('form');

    button.addEventListener('click', () => {
        const req = new XMLHttpRequest();

        const id = document.querySelector('#id').value;
        const firstName = document.querySelector('#first_name').value;
        const lastName = document.querySelector('#last_name').value;
        const email = document.querySelector('#email').value;
        const phone = document.querySelector('#phone').value;

        req.onreadystatechange = function () {
            if (this.readyState === 4 && this.status === 200) {
                form.classList.remove('was-validated');
                const resp = JSON.parse(this.response);

                if(resp.success) {
                    if(!id) form.reset();

                    const toastEl = document.querySelector("#contactCreateSuccess");
                    toastEl.style.display = 'flex';

                    window.setTimeout(function() {
                        toastEl.style.display = 'none';
                    }, 5000);

                } else if (resp.errors) {
                    const keys = Object.keys(resp.errors);

                    if(keys.length > 0) {
                        form.classList.add('was-validated');

                        keys.forEach(k => {
                            document.querySelector(`#${k}`)
                                .parentElement
                                .querySelector('.invalid-feedback')
                                .textContent = resp.errors[k];
                        });
                    }
                } else if (resp.message) {

                    const toastEl = document.querySelector("#contactCreateException");
                    toastEl.textContent = resp.message;
                    toastEl.style.display = 'flex';

                    window.setTimeout(function() {
                        toastEl.style.display = 'none';
                    }, 5000);

                }
            }
        }

        req.open(
            "POST",
            "/app/Controllers/ContactCreateController.php",
            true
        );
        req.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
        req.send(`id=${id}&first_name=${firstName}&last_name=${lastName}&email=${email}&phone=${phone}`);
    });
});
