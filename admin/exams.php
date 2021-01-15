<?php
include "../dbConnect.php";
include "_header.php";
include "_navbar.php";
?>

<div class="row">
    <span class="title1" style="margin-left:40%;font-size:30px;"><b>Enter Exam Details</b></span><br /><br />
    <div class="col-md-3"></div>
    <div class="col-md-6">
        <form class="form-horizontal title1" name="form" action="update.php?q=addquiz" method="POST">
            <fieldset>

                <!-- Text input-->
                <div class="form-group">
                    <label class="col-md-12 control-label" for="name"></label>
                    <div class="col-md-12">
                        <select>
                        <option>
                        
                        </option>
                        </select>

                    </div>
                </div>

                <!-- Text input-->
                <div class="form-group">
                    <label class="col-md-12 control-label" for="total"></label>
                    <div class="col-md-12">
                        <input id="total" name="total" placeholder="Enter total number of questions" class="form-control input-md" type="number">

                    </div>
                </div>

                <!-- Text input-->
                <div class="form-group">
                    <label class="col-md-12 control-label" for="time"></label>
                    <div class="col-md-12">
                        <input id="time" name="time" placeholder="Enter time limit for test in minute" class="form-control input-md" min="1" type="number">
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-md-12 control-label" for=""></label>
                    <div class="col-md-12">
                        <input type="submit" style="margin-left:45%" class="btn btn-primary" value="Next" class="btn btn-primary" />
                    </div>
                </div>

            </fieldset>
        </form>
    </div>

    <!-- JavaScripts -->

    <?php
    include("_footer.php");
    ?>