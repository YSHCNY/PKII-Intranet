


<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/choices.js/public/assets/styles/choices.min.css" />


<div>

    <div class="row p-4">
    
        <div class="col">
            <label for="Select">Personnel:</label>
            <select name="selectedUser" class="w-100" id = 'myChoiceSelect'>
                <option value="0" Selected Disabled>Select Personnel to Appoint</option>
                <?php
                    $GetName = "SELECT * FROM tblcontact";
                    $getResult = $dbh2->query($GetName);

                    if ($getResult->num_rows > 0){
                        while($rowthis = $getResult->fetch_assoc()){
                            $Last = $rowthis['name_last']; 
                            $Name = $rowthis['name_first']; 
                            $Middle = $rowthis['name_middle'];
                            $empid = $rowthis['employeeid'];
                            echo "<option value = '".$empid."'>". $Last.", ". $Name ." ".$Middle." (".$empid.")</option>";
                        }
                    }
                
                ?>

            </select>
        </div>
        <div class="col">
        <label for="Select">for Department:</label>

        <select name="selectedDept" id="SelectDept" class="">
        <option value="0" Selected Disabled>Select Department</option>
                <?php
                    $GetDepartment = "SELECT * FROM tbldeptcd";
                    $getDeptResult = $dbh2->query($GetDepartment);

                    if ($getDeptResult->num_rows > 0){
                        while($rowdept = $getDeptResult->fetch_assoc()){
                            $code = $rowdept['code']; 
                            $deptname = $rowdept['name']; 
                          
                            echo "<option value = '".$code."'>" .$deptname." (" .$code.")</option>";
                        }
                    }
                
                ?>

        </select>

        
        </div>

        <div class="col">
        <label for="Select">Pin </label>

      <input name = 'pinapprt' placeholder = 'pin here..' class = 'form-control'>
        </div>

    </div>
   
</div>
<script src="https://cdn.jsdelivr.net/npm/choices.js/public/assets/scripts/choices.min.js"></script>
    <script>
        // Initialize Choices.js on the select element
        const choices = new Choices('#myChoiceSelect', {
            searchEnabled: true, // Enable searching
            itemSelectText: 'Select this user', // Message on hover
            removeItemButton: true, // Allow removing selected items
        });

        const choices2 = new Choices('#SelectDept', {
            searchEnabled: true, // Enable searching
            itemSelectText: 'Select this Department', // Message on hover
            removeItemButton: true, // Allow removing selected items
        });
    </script>

