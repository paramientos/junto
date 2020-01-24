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


<table id="datatable" style="width: 99%"></table>


<div class="dialog" data-role="dialog" id="demoDialog1">
    <div class="dialog-title">Use Windows location service?</div>
    <div class="dialog-content">

        <form>
            <div class="form-group">
                <label>ss</label>
                <select data-role="select">
                    <option value="dedicated_corei3_hp">Core i3 (hp)</option>
                    <option value="dedicated_pentium_hp">Pentium (hp)</option>
                    <option value="dedicated_smart_corei3_hp">Smart Core i3 (hp)</option>
                </select>
            </div>

            <div class="form-group">
                <label>Email address</label>
                <input type="email" placeholder="Enter email" id="txtHostName"/>
                <small class="text-muted">We'll never share your email with anyone else.</small>
            </div>
            <div class="form-group">
                <label>Password</label>
                <input type="text" placeholder="Enter email" id="txtAliasName"/>
            </div>
            <div class="form-group">
                <input type="checkbox" data-role="checkbox" data-caption="Remember me">
            </div>
        </form>

    </div>

    <div class="dialog-actions">
        <button class="button primary js-dialog-close">Save</button>
        <button class="button  js-dialog-close">Close</button>
    </div>
</div>


<script type="text/javascript">


    window.onload = function () {


        let data = [
            {
                alias_name: "Server 1",
                host_name: "server1"
            },
            {
                alias_name: "Server 2",
                host_name: "server2"
            }
        ];

        $("#datatable").greed({
            data: data,
            hover: true,
            editButton: function (row, index) {
                Metro.dialog.open('#demoDialog1');
                $("#txtHostName").val(row.host_name);
                $("#txtAliasName").val(row.alias_name);
            },
            deleteButton: function (row, index) {

            },
            dblClick: function (row, index) {
                console.log(row);
                this.editButton(row, index);
            },
            filter: true,
            cols: [
                {
                    key: "alias_name",
                    title: "Alias Name",
                    sort: true,
                    styler: function (cell) {
                        return "<b>" + cell + "</b>"
                    },
                },
                {
                    key: "host_name",
                    title: "Hostname",
                    sort: true,
                    styler: function (cell) {
                        if (cell === 'server1') {
                            return "<span style='color:red'>" + cell + "</span>";
                        } else {
                            return cell;
                        }
                    }
                }
            ]
        });


    }

</script>
