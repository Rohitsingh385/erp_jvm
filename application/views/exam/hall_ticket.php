<style>
    table tr td,
    th {
        color: #000 !important;
        padding-top: 0px !important;
    }

    body {
        font-family: 'Verdana', sans-serif;
    }
</style>

<ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="#">Hall Ticket</a> <i class="fa fa-angle-right"></i></li>
</ol>

<div style="padding-left: 25px; background-color: white"><br /><br />
    <form method="POST" action="print" autocomplete="off" >
        <div class="row">


            <div class="col-sm-2">
                <span>Class</span>
                <select class="form-control" onchange="classes(this.value)" id="classs" required>
                    <option value=''>Select</option>
                    <?php
                    if (isset($class_data)) {
                        foreach ($class_data as $data) {
                    ?>
                            <option value="<?php echo $data['Class_no']; ?>"><?php echo $data['classnm']; ?></option>
                    <?php
                        }
                    }
                    ?>
                </select>
            </div>


            <input type="hidden" name="Class_No" id="Class_No" placeholder="Class_No">
            <input type="hidden" name="ExamMode" id="ExamMode" placeholder="ExamMode">
            <input type="hidden" name="view_max_markss" id="view_max_markss" placeholder="subcode">

            <div class="col-sm-2">
                <span>Sec</span>

                <select class="form-control" name="sec" id="sec" onchange="secc(this.value)" required>
                    <option value=''>Select</option>
                </select>
            </div>


            <div class="col-sm-4">
                <span>Exam Type</span>

                <input class="form-control" type="text" name ="exm_typ" id="exm_typ" oninput="this.value = this.value.toUpperCase()" required>

            </div>

            <div class="col-sm-2">
                <span>Sort By</span>

                <select class="form-control" id="sortby" name="sortby" required>
                    <option value=''>Select</option>
                    <option value='adm_no'>Admission No</option>
                    <option value='stu_name'>Student Name</option>
                    <option value='roll_no'>Roll No</option>
                </select>
            </div>

        </div>
        <br>
        <br>
        <div class="row" style="text-align: center;">
            <div class="col-sm-12">
                <button type="submit" class="btn btn-success">PRINT</button>
            </div>
        </div>
    </form>


</div><br /><br />
<div class="clearfix"></div>


<script>
    function classes(val) {
        $.post("<?php echo base_url('Hall_ticket/classess'); ?>", {
            val: val
        }, function(data) {
            var fill = $.parseJSON(data);
            $("#sec").html(fill[0]);
            $("#Class_No").val(fill[1]);
            $("#ExamMode").val(fill[2]);
        });
    }

    function secc(val) {
        var Class_No = $("#Class_No").val();
        $.post("<?php echo base_url('Hall_ticket/section'); ?>", {
            val: val,
            Class_No: Class_No
        }, function(data) {
            $("#exm_typ").html(data);
        });
    }



    //   function exam_type(ExamCode){
    // 	 var Class_No = $("#Class_No").val();
    // 	 var sec      = $("#sec").val();
    // 	 var ExamMode = $("#ExamMode").val();
    // 	 $.post("<?php echo base_url('Hall_ticket/subject'); ?>",{ExamCode:ExamCode,Class_No:Class_No,sec:sec,ExamMode:ExamMode},function(data){
    // 		 var fill = $.parseJSON(data);
    // 		 $("#sub").html(fill[0]);
    // 		 $("#view_max_markss").val(fill[1]);
    // 	 });
    //   }


    //   function sorybyview(val){
    // 	  $("#loading2").show();
    // 	  $("#stu_list").html('');
    // 	  var sortval  = val;
    // 	  var opt_code = $("#sub").val();
    // 	  var Class_No = $("#Class_No").val();
    // 	  var sec      = $("#sec").val();
    // 	  var exm_code = $("#exm_typ").val();
    // 	  var ExamMode = $("#ExamMode").val();
    // 	  var subcode = $("#sub").find(':selected').attr('data-id');

    // 	  $.post("<?php echo base_url('Marks_entry/stu_list'); ?>",{sortval:sortval,opt_code:opt_code,Class_No:Class_No,sec:sec,exm_code:exm_code,ExamMode:ExamMode,subcode:subcode},function(data){
    // 		  $("#loading2").hide();
    // 		  var fill = $.parseJSON(data);
    // 		  $("#stu_list").html(fill[0]);
    // 		  $("#view_max_marks").text(fill[1]);
    // 		  $("#view_max_marks").show();
    // 	  });
    //   }

    //   function marks(value){
    // 	var val = value.id;
    // 	var splt= val.split("_");
    // 	var spltval = splt[1];

    // 	var vall = $("#marks_"+spltval).val(); 
    // 	var mxmrks = $("#view_max_marks").text();
    //     var splt =  mxmrks.split(" ");
    // 	var MaxMarks = Number(splt[2]);

    // 	if((MaxMarks >= vall) || (vall == 'ab') || (vall == 'AB')){
    // 		var adm_no = $("#adm_"+spltval).val();
    // 		var exm_typ = $("#exm_typ").val();
    // 		var subcode = $("#sub").find(':selected').attr('data-id');
    // 		var classs = $("#classs").val();
    // 		var sec = $("#sec").val();
    // 		var entr_val = $("#marks_"+spltval).val();
    // 		var mxm = splt[2];
    // 		$.post("<?php echo base_url('Marks_entry/sv_nd_upd'); ?>",{adm_no:adm_no,exm_typ:exm_typ,subcode:subcode,classs:classs,sec:sec,entr_val:entr_val,mxm:mxm},function(data){
    // 			//alert(data);
    // 		});
    // 	}else{
    // 		alert('Invalid Entry');
    // 		var tmrk = $("#tmarks_"+spltval).val();
    // 		$("#marks_"+spltval).val(tmrk);
    // 	}
    //   }

    //   function approve(Class_No,sec,sorting,exm_code,subcode,trm,opt_code){
    // 	  $.ajax({
    // 		  url : "<?php echo base_url('Marks_entry/verifyMarks'); ?>",
    // 		  type: "POST",
    // 		  data: {Class_No:Class_No,sec:sec,sorting:sorting,exm_code:exm_code,subcode:subcode,trm:trm,opt_code:opt_code},
    // 		  success:function(data){
    // 			  $(".modal-body").html(data);
    // 			  $("#myModal").modal({
    // 				   backdrop: 'static',
    //                    keyboard: false
    // 			  });
    // 		  }
    // 	  });
    //   }
</script>