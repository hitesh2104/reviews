    <style>
        p{
            font-family:Tahoma, Geneva, sans-serif; font-size:14px;
        }
        textarea:focus, input:focus{
            outline: none;
            background-color: #e1e1e1;
        }
        .acknow-text {
            outline: none;
            border-top: none;
            border-right: none;
            border-left: none;
            border-bottom: 2px solid black;
            margin-bottom: 5px;
            background-color: #e1e1e1;
        }
        input[type="text"]::-webkit-input-placeholder {
        color: red !important;
        }
         
        input[type="text"]:-moz-placeholder { /* Firefox 18- */
        color: red !important;  
        }
         
        input[type="text"]::-moz-placeholder {  /* Firefox 19+ */
        color: red !important;  
        }
         
        input[type="text"]:-ms-input-placeholder {  
        color: red !important;

    </style>
    <br><br><br><br>
<div class="content-wrapper">
    <section class="content-header">
        <h1>Agreement</h1>
    </section>
    <section style="background: #e1e1e1" class="content" style="margin: 0px 100px 0px 100px;">
    <form id="myForm" action="<?= base_url() ?>Test/Agree" method="post">

        <p><strong>Dear</strong> Sir or Madam,</p> 
        
        <p>
        You will be participating in a psychometric assessment facilitated by Assessmenthouse.com. 
        </p>
        
        <p>The results of this assessment will be used for (please select the correct one): </p>
        <p><label><input type="radio" value="1" name="usedfor" id="" checked="checked"> Recruitment</label></p>
        <p><label><input type="radio" value="2" name="usedfor" id=""> Development </label></p>
        
        <p>
        In order to support making decisions in the best interest of the organization and yourself, also in designing programs to assist you and the organization in developing your full work potential, we request that you make your information available to the supervising Psychologist of AssessmentHouse.com, and the client who requested you to undergo psychometric testing. 
        </p>

        <p>
        Due to data confidentiality laws, we ask that you sign this form, either granting or not granting us permission to release your data. The latter means that you will not have access to the tests as you must grant the assigned client access to your results under the supervision of a registered Psychologist, and the organization that process the tests (if applicable). Further more, your results will not be released to any inappropriate/unqualified individual without the approval of the supervising Psychologist. The scoring of some of the psychometric test will depend on if you are successful in the interview, hence some of the test results will remain un-scored with no report available. 
        </p>

        <p>
        Psychometric tests are governed by the applicable legal entity that ensures validity and reliability of psychometric testing. Although all of the tests have valid and reliable norms, some of the tests are still under development/review as required from the entity governing psychometric tests. 
        </p>
        <p>
        Please tick the appropriate boxes below: 
        </p>
        <p class="text-danger">
            
        <label> 
            <input type="checkbox" class="acknow-text"  value="
            1" name="ackno1" id="" required="required">   
                <span>
                    I hereby acknowledge that I am voluntarily participating in this psychometric assessment.
                </span>
            </label>
        </p>
        <p class="text-danger">
            
        <label><input type="checkbox" name="ackno2" value="
        1" class="acknow-text" id=""  required="required">
            <span>
                I hereby agree to release my assessment results to the appropriate individuals for the use mentioned above; 
            </span>
        </label>
        </p>
        <p class="text-success">
            
            <label> 
                <input type="checkbox" class="acknow-text" value="
                1" name="ackno3" id=""  required="required">   
                <span>
                    I hereby agree that my results may be utilized for future research purposes, however ensuring confidentiality of my personal details;
                </span>
            </laSbel>
        </p>
        <p class="text-danger">
            <label>
                <input type="checkbox" class="acknow-text" name="ackno4" value="1" id="" required="required">
                <span>
                    I hereby acknowledge that I am entitled to feedback, however the cost of the feedback may be at my own expense. I also take into consideration that not all  results  are &nbsp;&nbsp;&nbsp;&nbsp; available for feedback, but that I am entitled to feedback on the results that have been generated;
                </span> 
            </label>
        </p>
        <p class="text-success">
        <label> 
                <input type="checkbox" name="" id="donotcheck" data-toggle="modal" data-backdrop="static" 
   data-keyboard="false" data-target="#myModal">
                <span>
                    I hereby do not agree to release my psychometric results. I hereby acknowledge that by not agreeing to the release of my results, the recruiter/assessor may have &nbsp;&nbsp;&nbsp;&nbsp; limited information about me, hence possibly reducing the likelihood of a successful employment. 
                </span>
            </label>
        </p>
        <br>
        <div class="row" style="text-align: center;">
            <div class="col-md-4">
                <input type="text" class="acknow-text" name="acknow_name" id="" required="required">
            </div>
            <div class="col-md-4">
                <input type="text" class="acknow-text" name="acknow_passport" id="" required="required">
            </div>
            <div class="col-md-4">    
                <input type="text" class="acknow-text" name="acknow_date"  id="Date" required="required">
            </div>
        </div>
        <div class="row" style="text-align: center;">
            <div class="col-md-4">Name and Surname</div>     
            <div class="col-md-4">ID/Passport Number</div>     
            <div class="col-md-4">Date</div>
        </div>
    
    <div id="myModal" class="modal fade" role="dialog">
    <div class="modal-dialog">

    <!-- Modal content-->
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title">Warning</h4>
          </div>
          <div class="modal-body">
            <p>You have selected not to release your psychometric results. If you click on Continue, you will be logged out immediately and won’t have access to your tests. If you click on Cancel, you will be allowed to select the appropriate options to release your test results and have access to the tests assigned to you.</p>
          </div>
          <div class="modal-footer">
            <button type="button" id="modalcancle" class="btn btn-default" data-dismiss="modal">cancel</button>
            <a href="<?= base_url() ?>dashbord/logout" class="btn btn-danger" data-dismiss="modal">Continue</a>
          </div>
        </div>

      </div>
    </div>
    <br><br>
    <div class="div" style="text-align: center;">
        <input value="submit" type="submit" id="submit" class="btn btn-primary btn-big">
    </div>
    <br><br>
    </form> 
    <script src="https://code.jquery.com/jquery-migrate-1.0.0.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.8/jquery-ui.min.js" type="text/javascript"></script>
    <link href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.8/themes/start/jquery-ui.css" rel="Stylesheet" type="text/css" />
    <script>
      $('document').ready(function(){
            $('.acknow-text').change(function(){
                if($(this).is(':checked'))
                {
                    $(this).parents("p:first").removeClass('text-danger');
                    $(this).parents("p:first").addClass('text-success');
                }
                else
                {
                    $(this).parents("p:first").removeClass('text-success');
                    $(this).parents("p:first").addClass('text-danger');
                }
            });

            $("#modalcancle").click(function(){
                $("#donotcheck").prop('checked', false);
                $("#donotcheck").parents("p:first").removeClass('text-danger');
                $("#donotcheck").parents("p:first").addClass('text-success');   
            });

            $("#donotcheck").change(function(){
                if($("#donotcheck").is(':checked'))
                {
                    $("#donotcheck").parents("p:first").removeClass('text-success');
                    $("#donotcheck").parents("p:first").addClass('text-danger');      
                }
            });

            $("#Date").datepicker({
            minDate: 0,
            maxDate:0,
            numberOfMonths: 1,
            onSelect: function (selected) {
                var dt = new Date(selected);
                dt.setDate(dt.getDate() + 1);
                $("#endDate").datepicker("option", "minDate", dt);
            }
        });
      });
      </script>
      <script>

      $(function () {
        $("#myForm").validate({
            errorElement: "span",
            errorClass: "error_msg",
            rules: {//set rules
                ackno1:{
                    required:true
                },
                ackno2:{
                    required:true
                },
                ackno3:{
                    required:false
                },
                ackno4:{
                    required:true
                },
                acknow_name:
                {
                    required:true
                },
                acknow_passport:
                {
                    required:true
                },
                acknow_date:
                {
                    required:true  
                }
            },
            messages: {//set messages to appear inline
                ackno1:{
                    required: "Oops! You must select this option."
                },
                ackno2:{
                    required: "Oops! You must select this option."
                },
                ackno3:{
                    required: "Oops! You must select this option."
                },
                ackno4:{
                    required: "Oops! You must select this option."
                },
                acknow_name:
                {
                    required:"Oops! Required."
                },
                acknow_passport:
                {
                    required:"Oops! Required."
                },
                acknow_date:
                {
                    required:"Oops! Required."
                }
            },
            errorPlacement: function(error, element) {
                if (element.attr("type") == "checkbox") {
                error.insertAfter($(element).parents('p:first'));
            } else {
                element.attr("placeholder",error.text());
            }
            }
        });
        });
  </script>
    </section>
</div>