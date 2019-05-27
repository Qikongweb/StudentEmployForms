$(document).ready(function () {
    $('[data-toggle="tooltip"]').tooltip();
    var actions = '<a title="Add" data-toggle="tooltip"><button type="button" class="add" name="submit_add" value="Done">Done</button></a>' +
        '<a title="Edit" data-toggle="tooltip"><button type="button" class="edit" value="Edit">Edit</button> </a>' +
        '<a title="Delete" data-toggle="tooltip"><button type="button" class="delete" name="delete" value="Delete">Delete</button></a>';
    // Append table with add row form on add new button click
    $(".add-new").click(function () {
        $(this).attr("disabled", "disabled");
        var index = $("table tbody tr:last-child").index();

        var row = '<tr>' +
            `<td><input class="qu_id" value="${index + 2}" readonly type="number" name="questionID[]"></td>` +
            '<td><select name="type_orginal[]" class="form-control status_change"><option selected>Rating</option><option>Text</option></select></td>' +
            '<input type="hidden" name="type[]" class="type_middle" value="Rating">'+
            '<td><input type="text" name="questions[]" class="qu_id status_change" ></td>' +
            '<td>' + actions + '</td>' +
            '</tr>';
        $("table").append(row);
        // eq means nth tr, chose new tr.
        $("table tbody tr").eq(index + 1).find(".status_change").css("border", "1px solid");
        $("table tbody tr").eq(index + 1).find(".add, .edit").toggle();
        $('[data-toggle="tooltip"]').tooltip();

        $("select:last").on('change',function () {
            $(".type_middle:last").prop("value",`${this.value}`);
        })

    });
    // Add row on add button click
    $(document).on("click", ".add", function () {
        var empty = false;
        var input = $(this).parents("tr").find('input[type="text"]');
        // var input_option = $(this).parents("tr").find('select:selectd');
        input.each(function () {
            if (!$(this).val()) {

                $(this).parents("tr").find(".status_change:last").css("border", "1px solid red");
                $(this).parents("tr").find(".status_change:last").css("background-color", "#FFCECE");
                empty = true;
            } else {
                $(this).parents("tr").find(".status_change:last").css("border", "1px solid black");
                $(this).parents("tr").find(".status_change:last").css("background-color", "white");
            }
        });
        if (!empty) {
            var type = $('.type').find(":selected").text();

            // before give disabled input, give the option value to hidden input
            $(this).parents("tr").find(".type").on('change',function () {
                var selected_option = $(this).parents("tr").find(":selected").text();
                $(this).parents("tr").find(".type_middle").prop("value",`${selected_option}`);
            })

            $(this).parents("tr").find(".status_change:last").attr("readonly", true);
            $(this).parents("tr").find(".status_change").first().attr("disabled", true);
            $(this).parents("tr").find(".status_change").css("border", "hidden");

            $(this).parents("tr").find(".add, .edit").toggle();
            $(".add-new").removeAttr("disabled");
        }
        $('#save-btn').attr('disabled',false);
    });
    // Edit row on edit button click
    $(document).on("click", ".edit", function () {

        // change 2nd and 3rd readonly statue and give border;
        $(this).parents("tr").find(".status_change").attr("readonly", false);
        $(this).parents("tr").find(".status_change").attr("disabled", false);
        $(this).parents("tr").find(".status_change").css("border", "1px solid");

        $(this).parents("tr").find(".add, .edit").toggle();
        $(".add-new").attr("disabled", "disabled");  // can not add a row now
        // give a selected value to input hidden
        $(this).parents("tr").find(".type").on('change',function () {
            var selected_option = $(this).parents("tr").find(":selected").text();
            $(this).parents("tr").find(".type_middle").prop("value",`${selected_option}`);
        })

        // can't submit when edit status
        event.preventDefault();

    });
    // Delete row on delete button click
    $(document).on("click", ".delete", function () {
        $(this).parents("tr").remove();
        $(".add-new").removeAttr("disabled");

        // when delete middle row, number will be arranged.
        var items = $.map($("table td:first-child"), function (ele, index) {
            return $(ele).html(`${index + 1}`);
        });
        $('#save-btn').attr('disabled',false);

    });
    $('#save-btn').attr('disabled',true);


});