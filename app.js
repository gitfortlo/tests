document.getElementById("openModalBtn").addEventListener("click", function() {
    document.getElementById("modal").style.display = "block";
});

document.getElementById("updateRowBtn").addEventListener("click", function() {
    const rowNumber = document.getElementById("rowNumber").value;
    const timesheetEntry = document.getElementById("timesheetEntry").value;

    const tableRow = document.getElementById("timesheetBody").children[rowNumber - 1];
    if (tableRow) {
        tableRow.children[1].textContent = timesheetEntry;
    } else {
        alert("Invalid row number!");
    }
});

document.getElementById("addRowBtn").addEventListener("click", function() {
    const timesheetEntry = document.getElementById("timesheetEntry").value;

    const newRow = document.createElement("tr");
    const rowCount = document.getElementById("timesheetBody").children.length + 1;
    newRow.innerHTML = `<td>${rowCount}</td><td>${timesheetEntry}</td>`;

    document.getElementById("timesheetBody").appendChild(newRow);
});
