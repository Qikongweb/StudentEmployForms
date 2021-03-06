function validateform() {
    // if (nameValidation() && emailValidation() && phoneNumValidation() && addressValidation() && cityValidation() && zipValidation() && checkboxValidation()) {
    if (checkboxValidation()) {
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

    // If presatation box is checked, it will show other box needed to be fill
    $(document).on('click',".presatation", function () {
        // event.stopPropagation();
        // event.stopImmediatePropagation();
        if ($(this).is(":checked")) {
            $(this).siblings(":last").css('display', 'block');
        }
        else {
            $(this).siblings(":last").css('display', 'none');
        }

    })
    var presetation_div = '';
    //Add another postion in the below
    $("#add_job").click(function () {
        var r = $('<button type="button" class="btn btn-danger job_title_delete" value="job_title_delete">Delete this job title</button>');
        var html = $('.field').html();
        if ($('.field0').length < 2) {
            $('.add_job_button').after(html);
        }
        else {
            $('.field0').last().after(html);

        }
        $('.field0').last().append(r);
        $('.job_title_delete').css('margin-bottom','10px');

    });
    $("body").on("click", ".job_title_delete", function () {
        $(this).parents(".field0").remove();
    });

    //Add another person in represatative
    $("#add_representative").click(function () {
        var r = $('<button type="button" class="btn btn-danger person_delete" value="person_delete">Delete this person</button>');
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
        $('.contact_person').last().attr('name','contact_person[]');
        $('.presatation_choose').last().attr('name','presatation_choose[]');
        $('.presatationDuringHour').last().attr('name','presatationDuringHour[]');
        $('.presatationTopic').last().attr('name','presatationTopic[]');

        $('.representative_field0_copy').last().append(r);
        $('.person_delete').css('margin','20px 0');

    });
    $("body").on("click", ".person_delete", function () {
        $(this).parents(".representative_field0_copy").remove();
    });


    $("#testbutton").on('click',function(){
        $("#test").attr('name','myname');
    })
});
