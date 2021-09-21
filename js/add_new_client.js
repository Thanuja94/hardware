var confirmed = false;


$("#btn_submit").on("click", function (e) {
    e.preventDefault();
    if (validate()) {
        Swal.fire({
            title: 'Are you sure?',
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, Submit it!'
        }).then((result) => {
            if (result.value) {
                $("#client_data").submit();
            }
        })
    }
});


$('#business_div').hide();
var nic = /((^|, )([0-9]{9}[X|x|V|v]|[0-9]{12})+$)/;
var numbersReg = /^[0-9]{1,3}$/;
var tpReg = /^[0-9]{10}$/;

$('#loan_reason').on('change', function () {
    var ptp = $('#loan_reason').val();
    if (ptp == "Business Loan") {
        $('#business_div').show();
    } else {
        $('#business_div').hide();
    }
});

window.setInterval(() => {
    if ($('#client_name').val() != "" && $('#client_name').val() != null) {

        // $('#client_name').attr('style', "");
        $('#client_name').removeClass("parsley-error");
        $('#client_name_span').html('<span></span>');
    }

    if ($('#nic').val() != "" && $('#nic').val() != null && ($('#nic').val().match(nic))) {
        $('#nic').removeClass("parsley-error");
        $('#nic_span').html('<span></span>');
    }
    if ($('#election_address').val() != "" && $('#election_address').val() != null) {
        $('#election_address').removeClass("parsley-error");
        $('#election_address_span').html('<span></span>');
    }
    if ($('#current_address').val() != "" && $('#current_address').val() != null) {
        $('#current_address').removeClass("parsley-error");
        $('#current_address_span').html('<span></span>');
    }
    if ($('#tp').val() != "" && $('#tp').val() != null && ($('#tp').val().match(tpReg))) {
        $('#tp').removeClass("parsley-error");
        $('#tp_span').html('<span></span>');
    }
    if ($('#job_title').val() != "" && $('#job_title').val() != null) {
        $('#job_title').removeClass("parsley-error");
        $('#job_title_span').html('<span></span>');
    }
    if ($('#monthly_income').val() != "" && $('#monthly_income').val() != null) {
        $('#monthly_income').removeClass("parsley-error");
        $('#monthly_income_span').html('<span></span>');
    }
    if ($('#steward_name').val() != "" && $('#steward_name').val() != null) {
        $('#steward_name').removeClass("parsley-error");
        $('#steward_name_span').html('<span></span>');
    }
    if ($('#steward_address').val() != "" && $('#steward_address').val() != null) {
        $('#steward_address').removeClass("parsley-error");
        $('#steward_address_span').html('<span></span>');
    }
    if ($('#steward_nic').val() != "" && $('#steward_nic').val() != null && ($('#steward_nic').val().match(nic))) {
        $('#steward_nic').removeClass("parsley-error");
        $('#steward_nic_span').html('<span></span>');
    }
    if ($('#steward_tp').val() != "" && $('#steward_tp').val() != null && ($('#steward_tp').val().match(tpReg))) {
        $('#steward_tp').removeClass("parsley-error");
        $('#steward_tp_span').html('<span></span>');
    }
    if ($('#non_relation_name').val() != "" && $('#non_relation_name').val() != null) {
        $('#non_relation_name').removeClass("parsley-error");
        $('#non_relation_name_span').html('<span></span>');
    }
    if ($('#non_relation_address').val() != "" && $('#non_relation_address').val() != null) {
        $('#non_relation_address').removeClass("parsley-error");
        $('#non_relation_address_span').html('<span></span>');
    }
    if ($('#non_relation_tp').val() != "" && $('#non_relation_tp').val() != null && ($('#non_relation_tp').val().match(tpReg))) {
        $('#non_relation_tp').removeClass("parsley-error");
        $('#non_relation_tp_span').html('<span></span>');
    }
    if ($('#number_of_family_members').val() != "" && $('#number_of_family_members').val() != null && ($('#number_of_family_members').val().match(numbersReg))) {
        $('#number_of_family_members').removeClass("parsley-error");
        $('#number_of_family_members_span').html('<span></span>');
    }

    if ($('#business_type').val() != "" && $('#business_type').val() != null) {
        // $('#business_type').attr('style', "");
        $('#business_type').removeClass("parsley-error");
        $('#business_type_span').html('<span></span>');
    }
    if ($('#business_monthly_income').val() != "" && $('#business_monthly_income').val() != null) {
        // $('#business_monthly_income').attr('style', "");
        $('#business_monthly_income').removeClass("parsley-error");
        $('#business_monthly_income_span').html('<span></span>');
    }
    if ($('#business_monthly_outcome').val() != "" && $('#business_monthly_outcome').val() != null) {
        // $('#business_monthly_outcome').attr('style', "");
        $('#business_monthly_outcome').removeClass("parsley-error");
        $('#business_monthly_outcome_span').html('<span></span>');
    }
    if ($('#business_profit').val() != "" && $('#business_profit').val() != null) {
        // $('#business_profit').attr('style', "");
        $('#business_profit').removeClass("parsley-error");
        $('#business_profit_span').html('<span></span>');
    }

    // validate();


}, 500);


function validate() {
    // alert("came");
    var error;


    if ($('#client_name').val() == "" || $('#client_name').val() == null) {

        // $('#client_name').attr('style', "border-radius: 5px; border:#FF0000 1px solid;");
        $('#client_name').addClass("parsley-error");
        $('#client_name_span').html('<span style="color:red;">Client Name is required</span>');
        error = true;
    }

    var nicValue = $('#nic').val();

    if ($('#nic').val() == "" || $('#nic').val() == null || (!nicValue.match(nic))) {
        $('#nic').addClass("parsley-error");
        $('#nic_span').html('<span style="color:red;">NIC is required</span>');
        error = true;
    }
    if ($('#election_address').val() == "" || $('#election_address').val() == null) {
        $('#election_address').addClass("parsley-error");
        $('#election_address_span').html('<span style="color:red;">Election Address is required</span>');
        error = true;
    }
    if ($('#current_address').val() == "" || $('#current_address').val() == null) {
        $('#current_address').addClass("parsley-error");
        $('#current_address_span').html('<span style="color:red;">Current Address is required</span>');
        error = true;
    }
    if ($('#tp').val() == "" || $('#tp').val() == null || (!$('#tp').val().match(tpReg))) {
        $('#tp').addClass("parsley-error");
        $('#tp_span').html('<span style="color:red;">Telephone Number is required</span>');
        error = true;
    }
    if ($('#job_title').val() == "" || $('#job_title').val() == null) {
        $('#job_title').addClass("parsley-error");
        $('#job_title_span').html('<span style="color:red;">job Title is required</span>');
        error = true;
    }
    if ($('#monthly_income').val() == "" || $('#monthly_income').val() == null) {
        $('#monthly_income').addClass("parsley-error");
        $('#monthly_income_span').html('<span style="color:red;">Monthly income is required</span>');
        error = true;
    }
    if ($('#steward_name').val() == "" || $('#steward_name').val() == null) {
        $('#steward_name').addClass("parsley-error");
        $('#steward_name_span').html('<span style="color:red;">Steward Name is required</span>');
        error = true;
    }
    if ($('#steward_address').val() == "" || $('#steward_address').val() == null) {
        $('#steward_address').addClass("parsley-error");
        $('#steward_address_span').html('<span style="color:red;">Steward Address is required</span>');
        error = true;
    }
    if ($('#steward_nic').val() == "" || $('#steward_nic').val() == null || (!$('#steward_nic').val().match(nic))) {
        $('#steward_nic').addClass("parsley-error");
        $('#steward_nic_span').html('<span style="color:red;">Steward NIC is required</span>');
        error = true;
    }
    if ($('#steward_tp').val() == "" || $('#steward_tp').val() == null || (!$('#steward_tp').val().match(tpReg))) {
        $('#steward_tp').addClass("parsley-error");
        $('#steward_tp_span').html('<span style="color:red;">Steward Telephone Number is required</span>');
        error = true;
    }
    if ($('#non_relation_name').val() == "" || $('#non_relation_name').val() == null) {
        $('#non_relation_name').addClass("parsley-error");
        $('#non_relation_name_span').html('<span style="color:red;">Non Relation Name is required</span>');
        error = true;
    }
    if ($('#non_relation_address').val() == "" || $('#non_relation_address').val() == null) {
        $('#non_relation_address').addClass("parsley-error");
        $('#non_relation_address_span').html('<span style="color:red;">Non Relation Address is required</span>');
        error = true;
    }
    if ($('#non_relation_tp').val() == "" || $('#non_relation_tp').val() == null || (!$('#non_relation_tp').val().match(tpReg))) {
        $('#non_relation_tp').addClass("parsley-error");
        $('#non_relation_tp_span').html('<span style="color:red;">Non Relation  Telephone Number is required</span>');
        error = true;
    }
    if ($('#number_of_family_members').val() == "" || $('#number_of_family_members').val() == null || (!$('#number_of_family_members').val().match(numbersReg))) {
        $('#number_of_family_members').addClass("parsley-error");
        $('#number_of_family_members_span').html('<span style="color:red;">Number of Family Members is required</span>');
        error = true;
    }
    //if (!text.match(nic))

    var ptp = $('#loan_reason').val();

    if (ptp == "Business Loan") {
        if ($('#business_type').val() == "" || $('#business_type').val() == null) {
            // $('#business_type').attr('style', "border-radius: 5px; border:#FF0000 1px solid;");
            $('#business_type').addClass("parsley-error");
            $('#business_type_span').html('<span style="color:red;">Business Type is required</span>');
            error = true;
        }
        if ($('#business_monthly_income').val() == "" || $('#business_monthly_income').val() == null) {
            $('#business_monthly_income').addClass("parsley-error");
            $('#business_monthly_income_span').html('<span style="color:red;">Monthly Income is required</span>');
            error = true;
        }
        if ($('#business_monthly_outcome').val() == "" || $('#business_monthly_outcome').val() == null) {
            $('#business_monthly_outcome').addClass("parsley-error");
            $('#business_monthly_outcome_span').html('<span style="color:red;">Business Outcome is required</span>');
            error = true;
        }
        if ($('#business_profit').val() == "" || $('#business_profit').val() == null) {
            $('#business_profit').addClass("parsley-error");
            $('#business_profit_span').html('<span style="color:red;">Business Profit is required</span>');
            error = true;
        }
    } else {
        $('#business_div').hide();
    }
    return !error;



}


$('#client_data').on('keyup keypress', function(e) {
    var keyCode = e.keyCode || e.which;
    if (keyCode === 13) {
        e.preventDefault();
        return false;
    }
});
