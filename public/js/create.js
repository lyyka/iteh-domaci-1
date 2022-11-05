const jsonToRequestBody = (json) => {
    const keys = Object.keys(json);
    let res = "";
    keys.forEach(k => {
        res += `${k}=${json[k]}&`;
    });
    return res;
};

const create = (form, route, body, id, successAlertId, exceptionAlertId) => {
    const req = new XMLHttpRequest();

    req.onreadystatechange = function () {
        if (this.readyState === 4 && this.status === 200) {
            const resp = JSON.parse(this.response);

            form.querySelectorAll('.form-control').forEach(field => {
                field.classList.remove('is-invalid');

                const invalidLbl = field
                    .parentElement
                    .querySelector('.invalid-feedback');

                if(invalidLbl) {
                    invalidLbl.textContent = "";
                }
            });

            if(resp.success) {
                if(!id) form.reset();

                const toastEl = document.querySelector(successAlertId);
                toastEl.style.display = 'flex';

                window.setTimeout(function() {
                    toastEl.style.display = 'none';
                }, 5000);

            } else if (resp.errors) {
                const keys = Object.keys(resp.errors);

                if(keys.length > 0) {
                    keys.forEach(k => {
                        const formField = document.querySelector(`#${k}`);

                        formField.classList.add('is-invalid');

                        formField
                            .parentElement
                            .querySelector('.invalid-feedback')
                            .textContent = resp.errors[k];
                    });
                }
            } else if (resp.message) {

                const toastEl = document.querySelector(exceptionAlertId);
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
        route,
        true
    );
    req.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
    req.send(jsonToRequestBody(body));
};
