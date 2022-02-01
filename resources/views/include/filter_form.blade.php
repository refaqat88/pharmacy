<div class="row bor-sep">

    <div class="col-sm-4 col-lg-4 pl-0 form-group">

        <input type="radio" checked class="report_name" name="report_name" value="0">
        Quick Report

        <input type="radio" class="report_name ml-3" name="report_name" value="1">
        By Date Range

    </div>
    <div class="col-md-2 col-lg-2 form-group mobile pl-0">

        <input type="text" class="form-control" placeholder="Enter Mobile" name="mobile" value="">

    </div>
    <div class="col-sm-4 col-lg-4 pr-2 form-group quickrangeDiv">


        <input type="radio" checked class="report_type ml-1" name="report_type" value="Daily">

        Daily
        <input type="radio" class="report_type ml-1" name="report_type" value="Weekly">


        Weekly


        <input type="radio" class="report_type ml-1" name="report_type" value="Monthly">


        Monthly



    </div>
    <div class="col-sm-4 col-lg-4 pl-0 daterangeDiv" style="display:none">

        <div class="pr-0 mr-0">
            <div class="form-group from_date" style="width:50%;float:left">
            <input type="text" class="form-control datepicker" placeholder="Enter from date" name="from_date" >
            </div>

            <div class="form-group to_date" style="width:50%;float:left; padding-left:10px">
            <input type="text" class="form-control datepicker" placeholder="Enter to date" name="to_date"   >
            </div>



        </div>

    </div>

    <div class="col-sm-2 col-lg-2 pl-2 pull-right">
        <button type="submit" class="pull-right  btn btn-round btn-outline-choice" id="selBtn"
        >Generate
        </button>
    </div>

</div>