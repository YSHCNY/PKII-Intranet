<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PKII Billing Statement</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
</head>
<body>
    
<style>
    /* .begone{
        visibility: hidden !important;
    } */
    

</style>


<div class="container-fluid my-5">
    <div class="border border-black">
        <div class="p-3">
       <p class="text-muted text-center begone" id = 'toggleElement'>BILLING STATEMENT</p> 
       </div>
       <form action="">
       <p class="text-center begone text-danger fs-6" id = 'toggleElement'><i>Note: This interface is only for placeholder as guide for printing</i></p>
       <!-- RECIEPT HEADER -->
        <div class="row">
            <div class="col-6">
                <div class="begone " id = 'toggleElement'>
                  <img src="img/newlogo.png" class = 'w-50' alt="" srcset="">
                </div>
                <div class = 'w-75 begone' id = 'toggleElement'>
                <h4 class = ' text-uppercase'>U3301 & 3302, 33rd Floor Corporate Finance Plaza Condominium Ruby Road Corner Topaz St. Ortigas Center San Antonio 1600 city of Pasig NCR, SECOND DISTRICT PHILIPPINES </h4>
                <h6 class="text-capitalize">Telephone No: +63 2 8396-8882</h6>
                <h6 class="">Email: mails@philkoei.com.ph &nbsp;&nbsp;&nbsp;&nbsp;<span>Website: www.philkoei.com.ph</span></h6>
                </div>
            </div>
           
            <div class="col-6">
                <div class = 'text-end'>
                <span class = 'begone ' id = 'toggleElement'>Reciept No. </span>
                <input class = 'border-0 printableArea' name = 'recnum' type="text">

                </div>

                
            </div>

                 <div class = 'text-end'>
                  <input name = 'longdate' type="text" class = 'border-0 printableArea'><span>,</span> <span>20</span><input type="text" name = 'shortdate' class = 'border-0 printableArea' size='5' placeholder = '00' maxlength="2" name="" id="">
                </div>


                <div class = 'p-5'>
                    <div class="ps-4">
                   
                <span class = 'begone'>CUSTOMER :</span><input type="text" name = 'cust' class = 'border-0 printableArea'><br>
                <span class = 'begone'>ADDRESS :</span><input type="text" name = 'addr' class = 'border-0 printableArea'><br>
                <span class = 'begone'>BUSS.NAME/STYLE :</span><input type="text" name = 'busn' class = 'border-0 printableArea'><br>
                <span class = 'begone'>TIN  :</span><input type="text" name = 'tin' class = 'border-0 printableArea'><br>
                
                </div>
                </div>

                <div>
                <style>
    .wide-column {
        width: 80%; /* Larger width for the PARTICULARS column */
    }
    .narrow-column {
        width: 20%; /* Smaller width for the AMOUNT column */

        @media print {

    body * {
        display: none; /* Hides everything by default */
    }

    .printableArea, .printableArea * {
        display: block; /* Only displays elements within .printableArea */
    }

    .printableArea {
        position: absolute;
        left: 0;
        top: 0;
        width: 100%;
    }
}
    }
</style>
                    <table class = ' table table-bordered border-dark'>
                        <thead class = 'begone' id = 'toggleElement'>
                            <tr class = 'text-center'>
                                <th class = 'wide-column'>P A R T I C U L A R S</th>
                                <th class = 'narrow-column'>A M O U N T</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><input type="text" class = 'border-0 w-100 printableArea' name="partic"></td>
                                <td><input type="text" class = 'border-0 w-100 printableArea' name="amnt"></td>
                            </tr>
                            <tr>
                                <td><input type="text" class = 'border-0 w-100 printableArea' name="partic"></td>
                                <td><input type="text" class = 'border-0 w-100 printableArea' name="amnt"></td>
                            </tr>
                            <tr>
                                <td><input type="text" class = 'border-0 w-100 printableArea' name="partic"></td>
                                <td><input type="text" class = 'border-0 w-100 printableArea' name="amnt"></td>
                            </tr>
                            <tr>
                                <td><input type="text" class = 'border-0 w-100 printableArea' name="partic"></td>
                                <td><input type="text" class = 'border-0 w-100 printableArea' name="amnt"></td>
                            </tr>
                            <tr>
                                <td><input type="text" class = 'border-0 w-100 printableArea' name="partic"></td>
                                <td><input type="text" class = 'border-0 w-100 printableArea' name="amnt"></td>
                            </tr>
                            <tr>
                                <td><input type="text" class = 'border-0 w-100 printableArea' name="partic"></td>
                                <td><input type="text" class = 'border-0 w-100 printableArea' name="amnt"></td>
                            </tr>
                            <tr>
                                <td><input type="text" class = 'border-0 w-100 printableArea' name="partic"></td>
                                <td><input type="text" class = 'border-0 w-100 printableArea' name="amnt"></td>
                            </tr>
                            <tr>
                                <td><input type="text" class = 'border-0 w-100 printableArea' name="partic"></td>
                                <td><input type="text" class = 'border-0 w-100 printableArea' name="amnt"></td>
                            </tr>
                            <tr>
                                <td><input type="text" class = 'border-0 w-100 printableArea' name="partic"></td>
                                <td><input type="text" class = 'border-0 w-100 printableArea' name="amnt"></td>
                            </tr>
                            <tr>
                                <td><input type="text" class = 'border-0 w-100 printableArea' name="partic"></td>
                                <td><input type="text" class = 'border-0 w-100 printableArea' name="amnt"></td>
                            </tr>
                            <tr>
                                <td><input type="text" class = 'border-0 w-100 printableArea' name="partic"></td>
                                <td><input type="text" class = 'border-0 w-100 printableArea' name="amnt"></td>
                            </tr>
                            <tr>
                                <td><input type="text" class = 'border-0 w-100 printableArea' name="partic"></td>
                                <td><input type="text" class = 'border-0 w-100 printableArea' name="amnt"></td>
                            </tr>
                            <tr>
                                <td><input type="text" class = 'border-0 w-100 printableArea' name="partic"></td>
                                <td><input type="text" class = 'border-0 w-100 printableArea' name="amnt"></td>
                            </tr>
                            <tr>
                                <td><input type="text" class = 'border-0 w-100 printableArea' name="partic"></td>
                                <td><input type="text" class = 'border-0 w-100 printableArea' name="amnt"></td>
                            </tr>
                            <tr>
                                <td><input type="text" class = 'border-0 w-100 printableArea' name="partic"></td>
                                <td><input type="text" class = 'border-0 w-100 printableArea' name="amnt"></td>
                            </tr>
                            <tr>
                                <td class = 'text-end'><i>Amount Due</i></td>
                                <td><input type="text" class = 'border-0 w-100 printableArea' name="amntfinal"></td>
                            </tr>
                        </tbody>
                    </table>
                </div>

<div class = 'my-2 text-end'>
    <button onclick="toggleVisibility()" class = 'begone text-white btn bg-primary text-decoration-none text-end'>Save & Print</button>
</div>
                </form>
        </div>
      
    </div>
</div>



<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>

<script>
function printPage() {
   // This JavaScript function triggers the browser's print dialog
}

function toggleVisibility() {
window.print();
    
  
}
</script>
</body>
</html>