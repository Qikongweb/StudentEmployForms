
$(document).ready(function () {
    $('[data-toggle="tooltip"]').tooltip();
    var actions = '<a title="Add" data-toggle="tooltip"><input type="submit" class="btn btn-success add" id="save-btn" name="submit" value="Submit"></a>' +
        '<a title="Edit" data-toggle="tooltip"><input type="button" class="edit" value="Edit"> </a>' +
        '<a title="Delete" data-toggle="tooltip"><input type="submit" class="btn btn-danger delete" name="delete" value="Delete"></a>';
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
        // all inputs in the whole row,give the border style if empty or not
        var input = $(this).parents("tr").find('input[type="text"]');
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
        else {
            event.preventDefault();
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


    });
    // Delete row on delete button click
    $(document).on("click", ".delete", function () {
        // give the delte row number to delete input value
        var deleteID = $(this).parents("tr").find(".qu_id").val();
        $('#save_delete_id').val(deleteID);

        $(".add-new").removeAttr("disabled");

    });


});
