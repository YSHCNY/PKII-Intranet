
<script>
document.addEventListener("DOMContentLoaded", function() {
    var rows = document.querySelectorAll(".clickable-row");
    rows.forEach(function(row) {
        row.addEventListener("click", function() {
            window.location.href = this.dataset.href;
        });
    });
});
</script>


<?php

$res11query = "SELECT tblproject1.projectid, tblproject1.proj_num, tblproject1.proj_code, tblproject1.proj_fname, tblproject1.proj_sname, tblproject1.proj_services, tblproject1.proj_period, tblproject1.proj_duty, tblproject1.proj_relation0, tblproject1.proj_relation1, tblproject1.proj_relation2, tblproject1.proj_relation3, tblproject1.proj_class, tblproject1.pkiictgcd FROM tblproject1 ORDER BY tblproject1.proj_code DESC, tblproject1.proj_period DESC, tblproject1.proj_code desc";
$result11 = $dbh2->query($res11query);

if ($result11->num_rows > 0) {
    while ($myrow11 = $result11->fetch_assoc()) {
        $pid = $myrow11['projectid'];
        $proj_num = $myrow11['proj_num'];
        $proj_code = $myrow11['proj_code'];
        $proj_fname = $myrow11['proj_fname'];
        $proj_sname = $myrow11['proj_sname'];
        $proj_services = $myrow11['proj_services'];
        $proj_period = $myrow11['proj_period'];
        $proj_duty = $myrow11['proj_duty'];
        $proj_relation0 = $myrow11['proj_relation0'];
        $proj_relation1 = $myrow11['proj_relation1'];
        $proj_relation2 = $myrow11['proj_relation2'];
        $proj_relation3 = $myrow11['proj_relation3'];
        $proj_class = $myrow11['proj_class'];
        $pkiictgcd = $myrow11['pkiictgcd'];

     ?>

<tr class="clickable-row" data-href="moreinfoproj.php?pid=<?php echo $pid; ?>&loginid=<?php echo $loginid; ?>" target="_blank">
<?php
        echo "<td>$proj_code</td>";
        echo "<td>$proj_sname</td>";
        echo "<td>$proj_fname</td>";
        echo "<td>$proj_services</td>";
        echo "<td>$proj_period</td>";
        echo "<td>$pkiictgcd</td>";
        echo "<td>";

        if ($proj_relation0 != "" || $proj_relation0 != "-") {
            if ($proj_relation1 != "" || $proj_relation1 != "-") {
                $res6query = "SELECT name FROM tblprojrelref WHERE code=\"$proj_relation1\" AND level=1";
                $result6 = $dbh2->query($res6query);

                if ($result6->num_rows > 0) {
                    while ($myrow6 = $result6->fetch_assoc()) {
                        $found6 = 1;
                        $name6 = $myrow6['name'];
                        if ($proj_relation0 == "others") {
                            echo "$name6";
                        }
                    }
                }

                if ($proj_relation2 != "" || $proj_relation2 != "-") {
                    $res7query = "SELECT name FROM tblprojrelref WHERE code=\"$proj_relation2\" AND level=2 LIMIT 1";
                    $result7 = $dbh2->query($res7query);
                    if ($result7->num_rows > 0) {
                        while ($myrow7 = $result7->fetch_assoc()) {
                            $found7 = 1;
                            $name7 = $myrow7['name'];
                            echo "$name7";
                        }

                        if ($proj_relation3 != "" || $proj_relation3 != "-") {
                            $res8query = "SELECT name FROM tblprojrelref WHERE code=\"$proj_relation3\" AND level=3 LIMIT 1";
                            $result8 = $dbh2->query($res8query);
                            if ($result8->num_rows > 0) {
                                while ($myrow8 = $result8->fetch_assoc()) {
                                    $found8 = 1;
                                    $name8 = $myrow8['name'];
                                    echo " - $name8";
                                }
                            }
                        }
                    }
                }
            }
        }

        echo "</td>";
        echo "<td>$proj_class</td>";
     
        echo "</tr></a>";
    }
}

?>
