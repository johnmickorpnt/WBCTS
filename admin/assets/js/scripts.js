const separator = document.querySelectorAll('.separator');
const dropdown = document.querySelector('.dropdown');
const chevronIcon = document.querySelector('.fa-chevron-down');


separator.forEach((el) => {
    // console.log(el.querySelector(".dropdown"), el.querySelector('.fa-chevron-down'));
    el.addEventListener("click", () => {
        el.querySelector('.dropdown').classList.toggle("open");
        el.querySelector('.fa-chevron-down').classList.toggle('rotate-icon');
    })
});

document.addEventListener('DOMContentLoaded', function () {
    var viewButtons = document.querySelectorAll('.view-button');
    var modal = document.getElementById('modal');
    var form = document.getElementById('data-form');

    viewButtons.forEach(function (button) {
        button.addEventListener('click', function () {
            var row = this.closest('tr');
            var rowData = Array.from(row.cells).map(function (cell, index) {
                if (index === 0) {
                    id = cell.textContent; // Assuming the ID is in the first column
                }
                return cell.textContent;
            });

            // Clear previous form inputs
            form.innerHTML = '';

            rowData.forEach(async function (data, index) {
                if ((index + 1) === rowData.length) return;

                try {
                    let th = row.parentNode.parentNode.querySelector('th:nth-child(' + (index + 1) + ')');
                    let elId;
                    let input;

                    let label = document.createElement('label');
                    label.textContent = th.textContent;

                    if (th.getAttribute("data-type") === 'textarea') {
                        input = document.createElement('textarea');
                        input.value = data;
                    }

                    else if (th.getAttribute("data-type") === 'datetime') {
                        input = document.createElement('input');
                        input.setAttribute('type', 'datetime');
                        input.classList.add("datetime");
                        input.value = data;
                    }
                    else if (th.getAttribute("data-type") === 'select') {
                        input = document.createElement('select');
                        input.setAttribute("name", index);
                        // Assuming you have an array of options
                        // Example AJAX request using Fetch API
                        let tbl = th.getAttribute("data-table");
                        let tblJson = await fetchTblData(tbl, null);
                        tblJson.forEach(function (obj) {
                            // Create an option element
                            var option = document.createElement('option');

                            // Set the text and value of the option
                            option.textContent = obj.role;
                            option.value = obj.id;

                            input.appendChild(option);
                        });
                    }

                    else {
                        input = document.createElement('input');
                        input.setAttribute('type', 'text');
                        input.value = data;
                    }

                    input.setAttribute("name", th.getAttribute("col-name"));
                    input.setAttribute("id", th.getAttribute("col-name"));

                    let div = document.createElement('div');
                    div.appendChild(label);
                    div.appendChild(input);

                    form.appendChild(div);
                } catch (e) {
                    console.error(e)
                }
            });

            // Show the modal
            modal.showModal();
        });
    });

    // Close the modal when the close button is clicked
    var closeButton = document.querySelector('.close-modal');
    closeButton.addEventListener('click', function () {
        modal.close();
    });

});

function setOptions() {

}

function showAddModal() {
}

function showModal() {
}

let fetchTblData = async (table, id) => {
    var params = new URLSearchParams();
    params.append("table", table);

    if (id !== null)
        params.append("id", id);


    return fetch('http://localhost/wbcts/admin/php/functions/view.php', {
        method: 'POST',
        body: params,
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded'
        }
    })
        .then(res => res.json())
        .catch(error => {
            console.error('Error:', error);
            alert(error);
        });
}


function delete_row(id, table) {
    var params = new URLSearchParams();
    params.append("id", id);
    params.append("table", table);

    let conf = confirm("Are you sure to delete this row?");

    if (!conf) return;
    fetch('http://localhost/wbcts/admin/php/functions/delete.php', {
        method: 'POST',
        body: params,
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded'
        }
    })
        .then(res => res.json())
        .finally((data) => {
            alert("data");
            location.reload();
        })
        .catch(error => {
            console.error('Error:', error);
            alert(error);
        });
}