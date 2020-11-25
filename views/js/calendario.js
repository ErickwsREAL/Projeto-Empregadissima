function loadControl(month, year) {

    addMonths(month);
    addYears(year);

    let firstDay = (new Date(year, month)).getDay();

     // body of the calendar
    var tbl = document.querySelector("#calendarBody");
    // clearing all previous cells
    tbl.innerHTML = "";


    var monthAndYear = document.getElementById("monthAndYear");
    // filing data about month and in the page via DOM.
    monthAndYear.innerHTML = months[month] + " " + year;


    selectYear.value = year;
    selectMonth.value = month;

    // creating the date cells here
    let date = 1;

    selectedDates.push((month + 1).toString() + '/' + date.toString() + '/' + year.toString());

    // there will be maximum 6 rows for any month
    for (let rowIterator = 0; rowIterator < 6; rowIterator++) {

        // creates a new table row and adds it to the table body
        let row = document.createElement("tr");

        //creating individual cells, filing them up with data.
        for (let cellIterated = 0; cellIterated < 7 && date <= daysInMonth(month, year); cellIterated++) {

            // create a table data cell
            cell = document.createElement("td");
            let textNode = "";

            // check if this is the valid date for the month
            if (rowIterator !== 0 || cellIterated >= firstDay) {
                cell.id = (month + 1).toString() + '/' + date.toString() + '/' + year.toString();
                cell.class = "clickable";
                textNode = date;

                // this means that highlightToday is set to true and the date being iterated it todays date,
                // in such a scenario we will give it a background color
                if (highlightToday
                    && date === today.getDate() && year === today.getFullYear() && month === today.getMonth()) {
                    cell.classList.add("today-color");
                }

                // set the previous dates to be selected
                // if the selectedDates array has the dates, it means they were selected earlier. 
                // add the background to it.
                if (selectedDates.indexOf((month + 1).toString() + '/' + date.toString() + '/' + year.toString()) >= 0) {
                    cell.classList.add(highlightClass);
                }

                date++;
            }

            cellText = document.createTextNode(textNode);
            cell.appendChild(cellText);
            row.appendChild(cell);
        }

        tbl.appendChild(row); // appending each row into calendar body.
    }

    // this adds the button panel at the bottom of the calendar
    addButtonPanel(tbl);

    // function when the date cells are clicked
    $("#calendarBody tr td").click(function (e) {
        var id = $(this).attr('id');
        // check the if cell clicked has a date
        // those with an id, have the date
        if (typeof id !== typeof undefined) {
            var classes = $(this).attr('class');
            if (typeof classes === typeof undefined || !classes.includes(highlightClass)) {
                var selectedDate = new Date(id);
                selectedDates.push((selectedDate.getMonth() + 1).toString() + '/' + selectedDate.getDate().toString() + '/' + selectedDate.getFullYear());
            }
            else {
                var index = selectedDates.indexOf(id);
                if (index > -1) {
                    selectedDates.splice(index, 1);
                }
            }

            $(this).toggleClass(highlightClass);
        }

        // sort the selected dates array based on the latest date first
        var sortedArray = selectedDates.sort((a, b) => {
            return new Date(a) - new Date(b);
        });

        // update the selectedValues text input
        document.getElementById('selectedValues').value = datesToString(sortedArray);
    });


    var $search = $('#selectedValues');
    var $dropBox = $('#parent');

    $search.on('blur', function (event) {
        //$dropBox.hide();
    }).on('focus', function () {
        $dropBox.show();
    });
}
