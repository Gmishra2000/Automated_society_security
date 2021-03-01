 <!-- Bootstrap core JavaScript-->
 <script src="vendor/jquery/jquery.min.js"></script>
 <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

 <!-- Core plugin JavaScript-->
 <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

 <!-- Custom scripts for all pages-->
 <script src="js/sb-admin-2.min.js"></script>

 <!-- <script src="https://code.jquery.com/jquery-3.5.1.js"></script> -->

 <!-- Page level plugins -->
 <!-- 2<script src="vendor/datatables/jquery.dataTables.min.js"></script> -->
 <!-- 3<script src="vendor/datatables/dataTables.bootstrap4.min.js"></script> -->

 <!-- Page level custom scripts -->
 <!-- <script src="js/demo/datatables-demo.js"></script> -->
 <!-- <script src="cdn.datatables.net/1.10.23/js/jquery.dataTables.min.js"></script> -->


 <!-- Page level plugins -->
 <!-- <script src="vendor/chart.js/Chart.min.js"></script> -->
 <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
 <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>

 <script src="js/sweetalert.min.js"></script>


 <?php
    if (isset($_SESSION['status']) && $_SESSION['status'] != '') {
    ?>

     <script>
         swal({
             title: "<?php echo $_SESSION['status']; ?>",
             //text: "You clicked the button!",
             icon: "<?php echo $_SESSION['status_code']; ?>",
             button: "Aww yiss!",
         });
     </script>
 <?php
        unset($_SESSION['status']);
    }


    ?>

 <script>
     function change(selBox) {
         for (var i, j = 0; i = selBox.options[j]; j++) {
             if (i.value == "security" && selBox.selectedIndex != 0) {
                 alert("Put your choice House No for security person");

             }
         }
     }
 </script>

 <!-- <script>
     $(document).ready(function() {
         $('#datatable').DataTable();
     });
 </script> -->

 <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
 <script type="text/javascript" src="https://cdn.datatables.net/1.10.23/js/jquery.dataTables.min.js"></script>

 <script>
     jQuery(document).ready(function() {
         jQuery.noConflict();
         var table = jQuery('#dataTable').DataTable();
     });
 </script>