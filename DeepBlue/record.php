<head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.13/css/bootstrap-multiselect.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.2.0/css/bootstrap.min.css">
    <link href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css" rel="stylesheet" />
    <link href="./multiselect/jquery.multiselect.css" rel="stylesheet" />
</head>
<?php
include('security.php');
include('validation/security_val.php');
include('includes/header.php');
include('includes/security_navbar.php');
?>

<?php
$q1 = "SELECT * FROM dailyvisit WHERE row_id=(SELECT max(row_id) FROM dailyvisit)";
$q1_run = mysqli_query($connection, $q1);
$row1 = mysqli_fetch_assoc($q1_run);
?>

<div class="modal fade" id="addadminprofile" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add Visitor Data</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="visitor_record.php" method="POST" enctype="multipart/form-data">

                <div class="modal-body">
                    <!-- <div class="form-group">
                        <label> Id </label>
                        <input type="text" name="username" class="form-control" placeholder="Enter name" required>
                    </div> -->

                    <div class="form-group">
                        <label> Name </label>
                        <input type="text" name="edit_name" class="form-control" placeholder="Enter name" required>
                    </div>

                    <div class="form-group">
                        <label>House Number</label>
                        <input type="text" name="user_hNo[]" class="form-control checking_email" placeholder="Enter House Number where visting" required>
                        <small class="error_email" style="color: red;"></small>
                    </div>
                    <div class="form-group">
                        <label>Phone Number</label>
                        <input type="tel" name="edit_phNo" class="form-control checking_email" placeholder="Enter Phone Number" required>
                        <small class="error_email" style="color: red;"></small>
                    </div>


                    <div class="form-group">
                        <label>Visitor Type</label>
                        <select name="edit_dgNo" onchange="change(this);" id="type" required>
                            <option value="guests">Guests</option>
                            <option value="delivery person">Delivery Person</option>
                            <option value="others">Others</option>


                        </select>
                        <!-- <input type="number" name="edit_hNo" value="" class="form-control"> -->
                    </div>
                    <div class="form-group">
                        <label>Temperature</label>
                        <input type="number" name="edit_temp" value="<?php echo $row1['temp'] ?>" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Time</label>
                        <input type="datetime" name="edit_time" value="<?php echo $row1['time'] ?>" class="form-control">
                    </div>





                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" name="visitor_update_btn" class="btn btn-primary">Save</button>
                </div>
            </form>

        </div>
    </div>
</div>


<div class="container-fluid">
    <div class=".card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Entered Visitor Detail</h6>


        </div>
    </div>
    <div class="card-body">
        <?php
        function House_No($connection, $id)
        {
            $output = '';
            $sql = "SELECT visitor_id ,user_hNo FROM association_map where  visitor_id = $id ";
            $result = mysqli_query($connection, $sql);
            while ($row = mysqli_fetch_array($result)) {
                $output .= '<option value="' . $row["user_hNo"] . '">' . $row["user_hNo"] . '</option>';
            }
            return $output;
        }


        ?>

        <?php


        if (isset($_POST['edit_data_btn'])) {
           
            $id = $_POST['edit_id'];
            // echo $id;




            $query = "SELECT visitor.id,Name,houseNo,aadharNo,phoneNumber,designation,temp,time,date from visitor,dailyvisit  WHERE row_id = (SELECT max(row_id) FROM dailyvisit) and visitor.id = dailyvisit.id";
            $query_run = mysqli_query($connection, $query);
            $row = mysqli_fetch_assoc($query_run);

            if (mysqli_num_rows($query_run) > 0) {



        ?>

                <form action="visitor_record.php" id="framework_form" method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="edit_id" value="<?php echo $row['id'] ?>">

                    <div class="form-group">
                        <label>Name</label>
                        <input type="text" name="edit_name" value="<?php echo $row['Name'] ?>" class="form-control">
                    </div>
                    <div class="form-group" >

                        <label>House Number</label>
                        <select name="user_hNo[]" multiple="multiple" class="3col active"  >
                            <?php echo House_No($connection, $id); ?>
                        </select>

                        <!-- <select name="group_select" id="group_select">
                            <option value="a">A</option>
                            <option value="b">B</option>
                            <option value="c">C</option>
                        </select> -->



                        <!-- <input type="number" name="edit_hNo" value="" class="form-control"> -->
                    </div>
                    <div class="form-group">
                        <label>Phone Number</label>
                        <input type="tel" name="edit_phNo" value="<?php echo $row['phoneNumber'] ?>" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Aaadhar Number</label>
                        <input type="number" name="edit_aadharNo" value="<?php echo $row['aadharNo'] ?>" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Designatiom</label>
                        <input type="text" name="edit_dgNo" value="<?php echo $row['designation'] ?>" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Temperature</label>
                        <input type="number" name="edit_temp" value="<?php echo $row['temp'] ?>" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Time</label>
                        <input type="datetime" name="edit_time" value="<?php echo $row['time'] ?>" class="form-control">
                    </div>
                    
                        <input type="hidden" name="edit_date" value="<?php echo $row['date'] ?>" class="form-control">
                 


                    <!-- <a href="register.php" class="btn btn-danger">CANCEL</a> -->
                    <button type="submit" name="visitor_update_btn" class="btn btn-primary">Submit</button>
                </form>
            <?php
            } else {
                echo "Visitor is not Registered visitor";
                // echo $row1['id'];
            ?>
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addadminprofile">
                    Make Entry
                </button>
        <?php
            }
        }
        ?>
        <!-- <button type="submit" name="visitor_update_btn" class="btn btn-primary">Submit</button> -->

    </div>
</div>















<?php

include('includes/footer.php');
?>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.2.0/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.13/js/bootstrap-multiselect.js"></script>
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script src="./multiselect/jquery.multiselect.js"></script>
<!-- <script>
    $(document).ready(function() {
        $('#framework').multiselect({
            nonSelectedText: 'Select House Number',
            enableFiltering: true,
            enableCaseInsensitiveFiltering: true,
            buttonWidth: '400px'
        });

        // $(function() {
        //     var filter = $('#filter-select');
        //     filter.on('change', function() {
        //         if (this.selectedIndex) return; //not `Select All`
        //         filter.find('option:gt(0)').prop('selected', true);
        //         filter.find('option').eq(0).prop('selected', false);
        //     });
        // });

        $('#framework').change(function() {
            if ($(this).val() == 'all') {
                $('#framework option').prop('selected', true);
            }
        });

        // $('#framework').change(function() {
        //     if ($(this).val() != 'all') {
        //         $('#framework option').prop('unselected', false);
        //     }
        // });

        $('#framework_form').on('visitor_update_btn', function(event) {
            event.preventDefault();
            var form_data = $(this).serialize();
            $.ajax({
                url: "visitor_record.php",
                method: "POST",
                data: form_data,
                success: function(data) {
                    $('#framework option:selected').each(function() {
                        $(this).prop('selected', false);
                    });
                    $('#framework').multiselect('refresh');
                    alert(data);
                }
            });
        });


    });
</script> -->
<script>
    $(function() {
        $('select[multiple].active.3col').multiselect({
            columns: 3,
            placeholder: 'Select house no',
            search: true,
            searchOptions: {
                'default': 'Search house no'
            },
            selectAll: true
        });

    });
</script>