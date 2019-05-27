function validateform() {
    if (checkboxValidation() && nameValidation() && emailValidation()) {
        return true;
    }
    else {
        return false;
    }

}

function nameValidation() {
    var name = $("#companyName").val();
    if (name === null || name.match(/^ *$/) !== null) {  //check not null and no white space
        $("#companyName").css('border', '2px red solid');
        $("#nameHelp").html("<i class='falert alert-danger alert-dismissible fade show'><strong>Error: </strong>This field is required.</i>");
        return false;
    }
    else {
        $("#companyName").css('border', '1px black solid');
        $("#nameHelp").html("<br>");
        return true;
    }
}

function nameRepresentativeValidation() {
    var name = $(".representative_firstname").val();
    if (name === null || name.match(/^ *$/) !== null) {  //check not null and no white space
        $(".representative_firstname").css('border', '2px red solid');
        $(".representative_firstname_help").html("<i class='falert alert-danger alert-dismissible fade show'><strong>Error: </strong>This field is required.</i>");
        return false;
    }
    else {
        $(".representative_firstname").css('border', '1px black solid');
        $(".representative_firstname_help").html("");
        return true;
    }
}

function emailValidation() {
    var emailRGEX = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
    if (!emailRGEX.test($("#companyEmail").val())) {
        $('#companyEmail').css('border', '2px red solid');
        $("#emailHelp").html("<i class='falert alert-danger alert-dismissible fade show'><strong>Error: </strong>Email is invalid or already taken.</i>");
        return false;
    }
    else {
        $('#companyEmail').css('border', '1px black solid');
        $("#emailHelp").html("<br>");
        return true;
    }
}

function phoneNumValidation() {
    // var phoneNumRGEX = /^\(?([0-9]{3})\)?[-. ]?([0-9]{3})[-. ]?([0-9]{4})$/;
    var phoneNumRGEX = /^(\([0-9]{3}\)|[0-9]{3}-)[0-9]{3}-[0-9]{4}$/; // eg 902-414-1875
    if (!phoneNumRGEX.test($("#companyPhone").val())) {
        $('#companyPhone').css('border', '2px red solid');
        $("#phoneHelp").html("<i class='falert alert-danger alert-dismissible fade show'><strong>Error: </strong>Phone number's format is invalid.(eg. 902-xxx-xxxx)</i>");
        return false;
    }
    else {
        $('#companyPhone').css('border', '1px black solid');
        $("#phoneHelp").html("<i>Eg. 902-xxx-xxxx");
        return true;
    }
}

function addressValidation() {
    var name = $("#companyAddress").val();
    if (name === null || name.match(/^ *$/) !== null) {  //check not null and no white space
        $("#companyAddress").css('border', '2px red solid');
        $("#addressHelp").html("<i class='falert alert-danger alert-dismissible fade show'><strong>Error: </strong>This field is required.</i>");
        return false;
    }
    else {
        $("#companyAddress").css('border', '1px black solid');
        $("#addressHelp").html("<br>");
        return true;
    }
}

function cityValidation() {
    var city = $("#companyCity").val();
    if (city === null || city.match(/^ *$/) !== null) {  //check not null and no white space
        $("#companyCity").css('border', '2px red solid');
        $("#cityHelp").html("<i class='falert alert-danger alert-dismissible fade show'><strong>Error: </strong>This field is required.</i>");
        return false;
    }
    else {
        $("#companyCity").css('border', '1px black solid');
        $("#cityHelp").html("<br>");
        return true;
    }
}

function zipValidation() {
    var zipRGEX = /^(\d{5}(-\d{4})?|[A-Z]\d[A-Z] \d[A-Z]\d)$/;
    if (!zipRGEX.test($("#companyZip").val())) {
        $("#companyZip").css('border', '2px red solid');
        $("#cityHelp").html("<i class='falert alert-danger alert-dismissible fade show'><strong>Error: </strong>Post Code is required. (eg. B3S 3H2)</i>");
        return false;
    }
    else {
        $('#companyZip').css('border', '1px black solid');
        $("#cityHelp").html("<br>");
        return true;
    }
}

function checkboxValidation() {
    if (!$("#agreeCheckBox").is(":checked")) {
        $("#agreeCheckBox").css('outline-color', 'red');
        $("#agreeCheckBox").css('outline-style', 'solid');
        return false;
    }
    else {
        $("#agreeCheckBox").css('outline-style', 'none');
        return true;
    }
}

$(document).ready(function () {


    // company name validation on 'change' and 'click'
    $("#companyName").on('change', function () {
        nameValidation();
    })

    $("#companyEmail").on('change', function () {
        emailValidation()
    })

    $("#companyPhone").on('change', function () {
        phoneNumValidation()
    })

    $("#companyAddress").on('change', function () {
        addressValidation();
    })

    $("#companyCity").on('change', function () {
        cityValidation()
    })
    $("#companyZip").on('change', function () {
        zipValidation()
    })

    // Presatation time option
    for (var i = 1; i <= 12; i++) {
        $("#presatationHour1,#presatationHour2").append(`<option value="${i}">${i}</option>`);
    }

    for (var i = 0; i <= 50; i += 10) {
        let min = i == 0 ? "00" : i;
        $("#presatationMin1,#presatationMin2").append(`<option value="${min}">${min}</option>`);
        i += 0;
    }


    //Add another postion in the below
    $("#add_job").click(function () {

        var r = $('<button type="button" class="btn btn-danger job_title_delete" value="job_title_delete">Delete this job position</button>');
        var html = $('.field').html();
        var name = $('.job_pay_yes').last().attr("name");
        var job_length = $('.job_full_time').last().attr('name');
        if ($('.field0').length < 2) {
            $('.add_job_button').after(html);
        }
        else {
            $('.field0').last().after(html);

        }
        $('.field0').last().append(r);
        // $('.field0').last().before('<hr />');
        $('.job_title').last().before('<hr/>');

        // give the number to job type
        var job_pay_num = Number(name.match(/\d+/)[0]) + 1;
        $('.job_pay_yes').last().attr('name',`job_pay${job_pay_num}[]`);
        $('.job_pay_no').last().attr('name',`job_pay${job_pay_num}[]`);

        //give the number to job length
        var job_length_num = Number(job_length.match(/\d+/)[0]) +1;
        $('.job_full_time').last().attr('name',`job_length${job_length_num}[]`);
        $('.job_part_time').last().attr('name',`job_length${job_length_num}[]`);

        $('.job_title_delete').css('margin-bottom','10px');
        $('html,body').animate({scrollTop:$(".field0").last().offset().top}, 500);       

    });
    $("body").on("click", ".job_title_delete", function () {
        $(this).parents(".field0").remove();
        $('html,body').animate({scrollTop:$(".field0").last().offset().top}, 500);

    });

    //Add another person in represatative
    var count_person = 1;
    $("#add_representative").click(function () {

        var delete_button = $('<button type="button" class="btn btn-danger person_delete" value="person_delete">Delete this person</button>');
        var html = $('.representative_field_copy').html();
        if ($('.representative_field0_copy').length < 2) {
            $('.add_representative_button').after(html);
        }
        else {
            $('.representative_field0_copy').last().after(html);
        }
        $('.representative_firstname').last().attr('name','representative_firstname[]');
        $('.representative_lastname').last().attr('name','representative_lastname[]');
        $('.representative_email').last().attr('name','representative_email[]');
        $('.representative_phone').last().attr('name','representative_phone[]');
        $('.contact_person').last().attr('name','contact_person'+(count_person+1));
        //$('.presatation_choose').last().attr('name','presatation_choose');

        $('.representative_field0_copy').last().append(delete_button);
        $('.person_delete').css('margin','20px 0');
        count_person++;
        $('html,body').animate({scrollTop:$(".representative_field0_copy").last().offset().top}, 500); 
    });

    $("body").on("click", ".person_delete", function () {
        $(this).parents(".representative_field0_copy").remove();
        getName();
        //count_person--;
        $('html,body').animate({scrollTop:$(".representative_field0_copy").last().offset().top}, 500); 

    });
    /*
    $("#submit1").click(function () {
        console.log(document.getElementsByClassName("form-check-input contact_person"));
    });
    $("#submit").click(function () {
        for (var i = 1; i<=count_person; i++) {
            //$(document).getElementById("submit").attributes('name',"contact_person"+i );
            console.log(i);
            document.getElementsByClassName("form-check-input contact_person")[i - 1].setAttribute("name", "contact_person" + i)
        }
        console.log(document.getElementsByClassName("form-check-input contact_person"));
    });
    */

    // open or close the position hiring information, Company Amassador, presentation parts
    $('.show_down').on('click',function(){
        $(this).siblings().toggle();
        if(!$(this).children().find("i").hasClass( "fa-plus" )){
            $(this).children().find("i").removeClass( "fa-minus" ).addClass( "fa-plus" );
        }
        else {
            $(this).children().find("i").removeClass( "fa-plus" ).addClass( "fa-minus" );
        }
        
    });


    // contact person checkbox and presentation checkbox
    $(document).on('change',".presatation_choose", function () {
        if ($(this).is(":checked")) {
            $(this).attr('value', "give_presentation");
            $(".presentation_detail").css('display','block');
        }
        else {
            $(this).attr('value', "not_give_presentation");
            $(".presentation_detail").css('display','none');
        }
        getName();

    })
    // add option in the presenter name
    $(document).on('change',".contact_person", function () {
        if ($(this).is(":checked")) {
            $(this).attr('value', "is_contact_person");
        }
        else {
            $(this).attr('value', "is_not_contact_person");
        }

    })
    // change last name add options in the presenter name
    $(document).on('change',".representative_lastname",function(){
        getName();
    })

    // add a presentation
    var counter = 0;

    $(document).on('click',"#addrow",function(){
        // $("#addrow").on("click", function () {
        var newRow = $("<tr>");
        var cols = "";

        cols += '<td><input type="text" class="form-control" name="presentation_topic[]' + counter + '"/></td>';
        cols += '<td><select id="presenter_name" name="presenter_name[]' + counter + '[]" class="form-control presenter_name"></select></td>';
        cols += '<td><input type="button" class="ibtnDel btn btn-md btn-danger "  value="Delete"></td>';
        newRow.append(cols);
        $("table.order-list").append(newRow);
        counter++;
        getName();
    });



    $("table.order-list").on("click", ".ibtnDel", function (event) {
        $(this).closest("tr").remove();
        counter -= 1
    });

});

function calculateRow(row) {
    var price = +row.find('input[name^="price"]').val();

}

function calculateGrandTotal() {
    var grandTotal = 0;
    $("table.order-list").find('input[name^="price"]').each(function () {
        grandTotal += +$(this).val();
    });
    $("#grandtotal").text(grandTotal.toFixed(2));
}

// get all names from representitive parts
function getName() {
    //clear all options at the beginning
    $('select.presenter_name option').remove();
    var firstName = $('input[type="text"].representative_firstname');
    var lastName = $('input[type="text"].representative_lastname');
    var test = $("select#presenter_name option").map(function() {return $(this).text();}).get();

    for(var i = 0; i < lastName.length; i++){
        if($(lastName[i]).val() != ""){
            var fullName = $(lastName[i]).val() + " " + $(firstName[i]).val();
            var nameRecord = $(lastName[i]).val() + "_" + $(firstName[i]).val();
            if(!test.includes(fullName)){
                $('.presenter_name').append(`<option value="${nameRecord}" name="${nameRecord}">${fullName}</option>`);
            }
        }
    }


}
