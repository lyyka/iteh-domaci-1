const deleteRow = (button, id, route, alertExceptionId, alertSuccessId) => {
    const req = new XMLHttpRequest();

    req.onreadystatechange = function () {
        if (this.readyState === 4 && this.status === 200) {
            const resp = JSON.parse(this.response);

            if(resp.success) {

                const row = button.closest('tr');
                row.parentElement.removeChild(row);

                const toastEl = document.querySelector(alertSuccessId);
                toastEl.style.display = 'flex';

                window.setTimeout(function() {
                    toastEl.style.display = 'none';
                }, 5000);

            } else if (resp.errors && resp.errors.id) {

                const toastEl = document.querySelector(alertExceptionId);
                toastEl.textContent = resp.errors.id;
                toastEl.style.display = 'flex';

                window.setTimeout(function() {
                    toastEl.style.display = 'none';
                }, 5000);

            } else if (resp.message) {

                const toastEl = document.querySelector(alertExceptionId);
                toastEl.textContent = resp.message;
                toastEl.style.display = 'flex';

                window.setTimeout(function() {
                    toastEl.style.display = 'none';
                }, 5000);

            }
        }
    }

    req.open("POST", route, true);
    req.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
    req.send(`id=${id}`);
};
