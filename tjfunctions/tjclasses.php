<?php 
class additionalfunctions {

	function setDatatable($cQryObj, $aColumns = array(), $sIndexColumn = "")
    {
        $Sortdir=$_GET['sSortDir_0'];
        $iDisplayStart   = $_GET['iDisplayStart'];
        $iDisplayLength = $_GET['iDisplayLength'];
        $iSortCol   = $_GET['iSortCol_0'];
        $iSortingCols = $_GET['iSortingCols'];
        $sSearch    = $_GET['sSearch'];
        

        $sLimit = "";
        if (isset($iDisplayStart) && $iDisplayLength != '-1') {
            $sLimit = $iDisplayStart.", ".$iDisplayLength;
        }

        $sOrder = "";
        if (isset($iSortCol)) {
            $field=$aColumns[$iSortCol];
        }

        $sWhere = "";
        if ($sSearch != "") {
            for ($i=0; $i < count($aColumns); $i++) {
                $sWhere .= $aColumns[$i]."*".$sSearch."|";
            }
        }

        for ($i=0; $i < count($aColumns); $i++) {
            if ($_GET['bSearchable_'.$i] == "true" && $_GET['sSearch_'.$i] != '') {
                if ($sWhere == "") {
                    $sWhere = "WHERE ";
                } else {
                    $sWhere = "AND ";
                }
                $sWhere .= $aColumns[$i].", ".$_GET['sSearch_'.$i];
            }
        }

        $order_by = explode(",", $sOrder);
        $limits  = explode(",", $sLimit);
        $filter  = explode("|", $sWhere);

        $cQryObjOrig = clone $cQryObj;
        $cQryObjTemp = clone $cQryObj;
        var_dump($cQryObjTemp);
        $cQryObjTemp = $cQryObjTemp->take($limits[1])->skip($limits[0]);

        if ($sWhere != "") {
            $cQryObjTemp->where(function($query) use ($i, $filter, $cQryObjTemp, $cQryObjOrig) {
                for ($i=0; $i < count($filter) -1; $i++) {
                    $xFilter = explode("*", $filter[$i]);
                    if($i == 0) {
                        $cQryObjTemp = $query->where($xFilter[0], 'LIKE', '%'.$xFilter[1].'%');
                        $cQryObjOrig = $query->where($xFilter[0], 'LIKE', '%'.$xFilter[1].'%');
                    } else {
                        $cQryObjTemp = $query->where($xFilter[0], 'LIKE', '%'.$xFilter[1].'%', 'OR');
                        $cQryObjOrig = $query->where($xFilter[0], 'LIKE', '%'.$xFilter[1].'%', 'OR');
                    }
                }
            });
        }

        $cQryObjResult  = $cQryObjTemp->orderby($field,$Sortdir)->get();

        $output = array(
            "sEcho"                 => intval($_GET['sEcho']),
            "iTotalRecords"         => mysqli_num_rows($cQryObjOrig),
            "iTotalDisplayRecords"  => mysqli_num_rows($cQryObjOrig),
            "aaData"                => array(),
            'objResult'             => $cQryObjResult,
        );

        return $output;
    }

}
?>