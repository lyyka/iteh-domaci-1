const deleteContact = (button, id) => {
    const req = new XMLHttpRequest();

    req.onreadystatechange = function () {
        if (this.readyState === 4 && this.status === 200) {
            const resp = JSON.parse(this.response);

            if(resp.success) {

                const row = button.closest('tr');
                row.parentElement.removeChild(row);

                const toastEl = document.querySelector("#contactDeleteSuccess");
                toastEl.style.display = 'flex';

                window.setTimeout(function() {
                    toastEl.style.display = 'none';
                }, 5000);

            } else if (resp.errors && resp.errors.id) {

                const toastEl = document.querySelector("#contactDeleteException");
                toastEl.textContent = resp.errors.id;
                toastEl.style.display = 'flex';

                window.setTimeout(function() {
                    toastEl.style.display = 'none';
                }, 5000);

            } else if (resp.message) {

                const toastEl = document.querySelector("#contactDeleteException");
                toastEl.textContent = resp.message;
                toastEl.style.display = 'flex';

                window.setTimeout(function() {
                    toastEl.style.display = 'none';
                }, 5000);

            }
        }
    }

    req.open("POST", "/app/Controllers/ContactDeleteController.php", true);
    req.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
    req.send(`id=${id}`);
};
