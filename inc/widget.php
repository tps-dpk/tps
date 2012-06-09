	<script src="js/jquery-1.6.1.min.js" type="text/javascript"></script>
    <script src="js/jquery.dataTables.min.js" type="text/javascript"></script>
    <script src="js/jquery.dataTables.columnFilter.js" type="text/javascript"></script>
    <script src="js/jquery.dataTables.pagination.js" type="text/javascript"></script>
    <link href="css/demo_table_jui.css" rel="stylesheet" type="text/css">

<style type="text/css">
/* BeginOAWidget_Instance_2586523: #dataTable */

    @import url("css/custom/overcast/jquery.ui.all.css");
    #dataTable {padding: 0;margin:0;width:100%;}
    #dataTable_wrapper{width:100%;}
    #dataTable_wrapper th {cursor:pointer} 
    #dataTable_wrapper tr.odd {color:#000; background-color:#ffff00}
    #dataTable_wrapper tr.odd:hover {color:#ffffff; background-color:#ff9900}
    #dataTable_wrapper tr.odd td.sorting_1 {color:#000000; background-color:#ffcc00}
    #dataTable_wrapper tr.odd:hover td.sorting_1 {color:#ffffff; background-color:#ff6600}
    #dataTable_wrapper tr.even {color:#000000; background-color:#ffffff}
    #dataTable_wrapper tr.even:hover, tr.even td.highlighted{color:#EEE; background-color:#cc6600}
    #dataTable_wrapper tr.even td.sorting_1 {color:#000000; background-color:#cccc00}
    #dataTable_wrapper tr.even:hover td.sorting_1 {color:#FFF; background-color:#cc3300}
        
/* EndOAWidget_Instance_2586523 */
</style>
<script type="text/xml">
<!--
<oa:widgets>
  <oa:widget wid="2586523" binding="#dataTable" />
</oa:widgets>
-->
</script> 

<script type="text/javascript">
// BeginOAWidget_Instance_2586523: #dataTable

$(document).ready(function() {
	oTable = $('#dataTable').dataTable({
		"bJQueryUI": true,
		"bScrollCollapse": true,
		"sScrollY": "400px",
		"bAutoWidth": true,
		"bPaginate": true,
		"sPaginationType": "two_button", //full_numbers,two_button
		"bStateSave": true,
		"bInfo": true,
		"bFilter": true,
		"iDisplayLength": 10,
		"bLengthChange": true,
		"aLengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, "All"]]
	});
} );
		
// EndOAWidget_Instance_2586523
</script>
