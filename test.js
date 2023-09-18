let buttonAdder = document.getElementById('issue_button');

// Fires on button click
buttonAdder.addEventListener('click', function (event) {

    let table = document.getElementById('issue_reports');
    let rows = table.rows;

    // Loop through each row(except the header)
    for (let i = 1; i < rows.length; i++) {

        let cols = rows[i].cells;
        let lastCol = rows[i]['cells'][cols.length - 1];

        // Create a new button element
        let button = document.createElement('button');
        button.innerText = 'In Progress';

        // Attach sayHi() function to 'onclick' attribute
        button.setAttribute('onclick', 'sayHi()');

        // Append the button to the last column
        lastCol.appendChild(button);

    }
});


// Fires on 'View' button click
function sayHi() {
    alert('This ticket is in progress by another technician');
}