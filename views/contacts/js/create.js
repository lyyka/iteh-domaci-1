window.addEventListener('DOMContentLoaded', function () {
    const button = document.querySelector("#createContact");

    button.addEventListener('click', () => {
        const req = new XMLHttpRequest();

        req.onreadystatechange = function () {
            if (this.readyState === 4 && this.status === 200) {
                const resp = JSON.parse(this.response);

                if(resp.success) {
                    button.closest('form').reset();

                    button.classList.remove('btn-dark');
                    button.classList.add('btn-success');
                    button.innerHTML = 'Success!';

                    window.setTimeout(function() {
                        button.classList.remove('btn-success');
                        button.classList.add('btn-dark');
                        button.innerHTML = 'Create new contact';
                    }, 1500);
                }
            }
        }

        const firstName = document.querySelector('#first_name').value;
        const lastName = document.querySelector('#last_name').value;
        const email = document.querySelector('#email').value;
        const phone = document.querySelector('#phone').value;

        req.open("POST", "/app/Controllers/ContactCreateController.php", true);
        req.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
        req.send(`first_name=${firstName}&last_name=${lastName}&email=${email}&phone=${phone}`);
    });
});
