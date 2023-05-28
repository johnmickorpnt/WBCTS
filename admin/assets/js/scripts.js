const separator = document.querySelectorAll('.separator');
const dropdown = document.querySelector('.dropdown');
const chevronIcon = document.querySelector('.fa-chevron-down');
const dialogOverlay = document.getElementById('dialogOverlay');

separator.forEach((el) => {
    // console.log(el.querySelector(".dropdown"), el.querySelector('.fa-chevron-down'));
    el.addEventListener("click", () => {
        el.querySelector('.dropdown').classList.toggle("open");
        el.querySelector('.fa-chevron-down').classList.toggle('rotate-icon');
    })
});

document.addEventListener('DOMContentLoaded', function () {
    var viewButtons = document.querySelectorAll('.view-button');
    var editButtons = document.querySelectorAll('.edit-button');
    var addButtons = document.querySelectorAll('.add-button');

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
            form.setAttribute("mode", "view");
            var fetchPromises = []; // Array to store fetch promises
            var inputs = []; // Array to store input elements

            rowData.forEach(async function (data, index) {
                if ((index + 1) === rowData.length) return;

                try {
                    let th = row.parentNode.parentNode.querySelector('th:nth-child(' + (index + 1) + ')');

                    let label = document.createElement('label');
                    label.textContent = th.textContent;

                    var input; // Declare the input variable

                    if (th.getAttribute("data-type") === 'textarea') {
                        input = document.createElement('textarea');
                        input.setAttribute("disabled", "disabled");

                        input.value = data;
                    }
                    else if (th.getAttribute("data-type") === 'datetime') {
                        input = document.createElement('input');
                        input.setAttribute("disabled", "disabled");
                        input.setAttribute("type", "text");

                        flatpickr(`#${th.getAttribute("col-name")}`, {
                            enableTime: true,
                            dateFormat: "Y-m-d H:i:s",
                            altInput: true,
                            altFormat: "F j, Y H:i:s",
                            static: true
                        });
                    }
                    else if (th.getAttribute("data-type") === 'select') {
                        input = document.createElement('select');
                        input.setAttribute("name", index);
                        input.setAttribute("disabled", "disabled");
                        let tbl = th.getAttribute("data-table");

                        // Push the fetch promise to the array
                        fetchPromises.push(fetchTblData(tbl, null));

                        // Store the input element in the array
                        inputs.push(input);
                    }
                    else {
                        input = document.createElement('input');
                        input.setAttribute('type', 'text');
                        input.setAttribute("disabled", "disabled");

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

            // Wait for all fetch requests to complete
            Promise.all(fetchPromises)
                .then(results => {
                    results.forEach((tblJson, index) => {
                        tblJson.forEach(function (obj) {
                            var option = document.createElement('option');
                            option.textContent = obj.role ?? obj.id;

                            option.value = obj.id;
                            inputs[index].appendChild(option); // Use the corresponding input element
                        });
                    });
                    // Show the modal
                    dialogOverlay.style.display = 'block';
                    modal.show();
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert(error);
                });
        });
    });

    editButtons.forEach(function (button) {
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
            form.setAttribute("method", "POST");
            var fetchPromises = []; // Array to store fetch promises
            var inputs = []; // Array to store input elements

            rowData.forEach(async function (data, index) {
                if ((index + 1) === rowData.length) return;
                let tableId = button.getAttribute("target-table");
                var table = document.getElementById(tableId);
                if (!table) {
                    console.error('Table not found');
                    return;
                }
                form.setAttribute("action", table.getAttribute("form-update-action"));
                // form.setAttribute("action", table.getAttribute("form-add-action"));
                try {
                    let th = row.parentNode.parentNode.querySelector('th:nth-child(' + (index + 1) + ')');

                    let label = document.createElement('label');
                    label.textContent = th.textContent;

                    var input; // Declare the input variable

                    if (th.getAttribute("data-type") === 'textarea') {
                        input = document.createElement('textarea');
                        input.value = data;
                    }
                    else if (th.getAttribute("data-type") === 'datetime') {
                        input = document.createElement('input');
                        input.setAttribute("type", "text");

                        console.log(`#${th.getAttribute("col-name")}`)
                        flatpickr(`#${th.getAttribute("col-name")}`, {
                            enableTime: true,
                            dateFormat: "Y-m-d H:i:s",
                            altInput: true,
                            altFormat: "F j, Y H:i:s",
                            static: true
                        });
                    }
                    else if (th.getAttribute("data-type") === 'select') {
                        input = document.createElement('select');
                        input.setAttribute("name", index);

                        let tbl = th.getAttribute("data-table");

                        // Push the fetch promise to the array
                        fetchPromises.push(fetchTblData(tbl, null));

                        // Store the input element in the array
                        inputs.push(input);
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

            // Wait for all fetch requests to complete
            Promise.all(fetchPromises)
                .then(results => {
                    results.forEach((tblJson, index) => {
                        tblJson.forEach(function (obj) {
                            var option = document.createElement('option');
                            option.textContent = obj.role ?? obj.id;
                            option.value = obj.id;
                            inputs[index].appendChild(option); // Use the corresponding input element
                        });
                    });

                    // Add the submit button after the loop
                    var submitButton = document.createElement('button');
                    submitButton.setAttribute('type', 'submit');
                    submitButton.textContent = 'Submit';
                    form.appendChild(submitButton);

                    // Show the modal
                    dialogOverlay.style.display = 'block';
                    modal.show();
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert(error);
                });
        });
    });

    addButtons.forEach(function (button) {
        button.addEventListener('click', function () {
            // Clear previous form inputs
            form.innerHTML = '';
            form.setAttribute("mode", "update");
            form.setAttribute("method", "POST");
            // Get the table ID from the data attribute
            var tableId = button.getAttribute('data-table');

            // Find the table using the table ID
            var table = document.getElementById(tableId);
            if (!table) {
                console.error('Table not found');
                return;
            }
            form.setAttribute("action", table.getAttribute("form-add-action"));

            // Get the table headers
            var headers = Array.from(table.querySelectorAll('th:not(:last-child)'));

            // Extract the column names from the headers
            var columns = headers.map(function (header) {
                return header.getAttribute('col-name');
            });

            // Loop through each column
            columns.forEach(function (column) {
                if (column === "id") return;
                try {
                    let th = table.querySelector('th[col-name="' + column + '"]');
                    let input;

                    let label = document.createElement('label');
                    label.textContent = th.innerHTML;

                    if (th.getAttribute("data-type") === 'textarea') {
                        input = document.createElement('textarea');
                    } else if (th.getAttribute("data-type") === 'datetime') {
                        input = document.createElement('input');
                        input.setAttribute("type", "text");
                        input.classList.add("datetime");
                    } else if (th.getAttribute("data-type") === 'select') {
                        input = document.createElement('select');
                        input.setAttribute("name", column);

                        // Assuming you have an array of options
                        // Example AJAX request using Fetch API

                        if (!th.hasAttribute("data-table") && th.hasAttribute("data-options")) {

                        }
                        let tbl = th.getAttribute("data-table");
                        fetchTblData(tbl, null, function (data) {
                            data.forEach(function (obj) {
                                // Create an option element
                                var option = document.createElement('option');

                                // Set the text and value of the option
                                option.textContent = obj.role ?? obj.id;
                                option.value = obj.id;

                                input.appendChild(option);
                            });
                        });
                    } else {
                        input = document.createElement('input');
                        input.setAttribute('type', 'text');
                    }

                    input.setAttribute("name", th.getAttribute("col-name"));
                    input.setAttribute("id", th.getAttribute("col-name"));

                    let div = document.createElement('div');
                    div.appendChild(label);
                    div.appendChild(input);

                    form.appendChild(div);
                } catch (e) {
                    console.error(e);
                }
            });

            flatpickr(".datetime", {
                enableTime: true,
                dateFormat: "Y-m-d H:i:s",
                altInput: true,
                altFormat: "F j, Y H:i:s",
            });

            var submitButton = document.createElement('button');
            submitButton.setAttribute('type', 'submit');
            submitButton.textContent = 'Submit';
            form.appendChild(submitButton);

            // Show the modal
            dialogOverlay.style.display = 'block';
            modal.show();
        });
    });

    var closeButton = document.querySelector('.close-modal');
    closeButton.addEventListener('click', function () {
        dialogOverlay.style.display = 'none';
        modal.close();
    });
});

function showAddModal() {
}

function showModal() {
}

let fetchTblData = async (table, id, fn) => {
    var params = new URLSearchParams();
    params.append("table", table);

    if (id !== null)
        params.append("id", id);

    return await fetch('php/functions/view.php', {
        method: 'POST',
        body: params,
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded'
        }
    })
        .then(res => res.json())
        .then(data => {
            if (typeof fn === 'function') {
                fn(data); // Pass the data to the callback function
            }
            return data; // Return the data from the fetch function
        })
        .catch(error => {
            console.error('Error:', error);
            alert(error);
        });
}

function archive_row(id, table) {
    var params = new URLSearchParams();
    params.append("id", id);
    params.append("table", table);

    let conf = confirm("Are you sure to archive this row?");

    if (!conf) return;
    fetch('php/functions/archive.php', {
        method: 'POST',
        body: params,
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded'
        }
    })
        .then(res => res.json())
        .finally((data) => {
            location.reload();
        })
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
    fetch('php/functions/delete.php', {
        method: 'POST',
        body: params,
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded'
        }
    })
        .then(res => res.json())
        .finally((data) => {
            location.reload();
        })
        .catch(error => {
            console.error('Error:', error);
            alert(error);
        });
}