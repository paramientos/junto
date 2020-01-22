<div class="row m-3">
    <div class="cell-md-4 text-center text-left-md">
        <h3 class="dashboard-section-title">InfoBox
            <small>information</small>
        </h3>
    </div>

    <div class="cell-md-8 d-flex flex-justify-center flex-justify-end-md">
        <ul class="breadcrumbs bg-transparent">
            <li class="page-item"><a href="#" class="page-link"><span class="mif-meter"></span></a></li>
            <li class="page-item"><a href="#" class="page-link">Information</a></li>
            <li class="page-item"><a href="#" class="page-link">InfoBox</a></li>
        </ul>
    </div>
</div>

<div class="row m-3">

        <table id="dg" title="Servers" class="easyui-datagrid" style="width:85%;height:250px"
               toolbar="#toolbar" pagination="true"
               rownumbers="true" fitColumns="true" singleSelect="true">
            <thead>
            <tr>
                <th field="host_name" width="50">Hostname</th>
                <th field="alias_name" width="50">Alias</th>
                <th field="user_name" width="50">Username</th>
            </tr>
            </thead>
        </table>


</div>


<script type="text/javascript">


    window.onload = function () {

        GET('http://localhost:8000/api/servers', {}, function (data) {
            $('#dg').datagrid('loadData', data);
        });


    }

</script>
