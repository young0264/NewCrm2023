@extends("layouts.app")
@section("content")
<script>
    document.addEventListener("DOMContentLoaded", ()=>{
        tables.initialize();
    });

    let tables = {
        headers:null,
        items:null,
        dataset:[],
        tab1:["f_pay_type",
            "f_pay_interval",
            "f_history",
            "f_reply",
            "f_statement",
            "f_tax_bill",
            "f_issuedate"],
        tab2:["f_registration_number",
            "f_minor_business",
            "f_cp_name",
            "f_rep_name",
            "f_addr",
            "f_business",
            "f_event",
            "f_public_addr1",
            "f_public_addr2"],
        tab3:["f_name1",
            "f_mobile1",
            "f_email1",
            "f_name2",
            "f_mobile2",
            "f_email2"],
        tab4:["f_day1", "f_product1", "f_standard1", "f_unitprice1", "f_count1", "f_price1", "f_tax1", "f_bigo1",
            "f_day2", "f_product2", "f_standard2", "f_unitprice2", "f_count2", "f_price2", "f_tax2", "f_bigo2",
            "f_day3", "f_product3", "f_standard3", "f_unitprice3", "f_count3", "f_price3", "f_tax3", "f_bigo3",
            "f_day4", "f_product4", "f_standard4", "f_unitprice4", "f_count4", "f_price4", "f_tax4", "f_bigo4", "f_issue_type"],
        initialize:function(){
            this.set();
            this.onDraw();
        },

        set:function(){
            let method = "POST";
            let url = "{{route("billList")}}";
            let datas = {};
            let dataType = "json";
            let ret = js.ajax_call(method, url, datas, dataType, false, "", true);

            this.headers = JSON.parse(ret['header']);
            this.items = JSON.parse(ret['items']);

            // 전체 데이터를 받아서, 각각의 셀렉트 옵션에 데이터처리
            this.setDataset();
        },

        setDataset:function() {
            this.headers.forEach((item, idx)=> {
                this.dataset[item.key] = [];
            });
            this.items.forEach((item, idx)=>{
                this.headers.forEach((header, header_idx)=>{
                    if (this.dataset[header.key][item[header.key]] === undefined)
                        this.dataset[header.key][item[header.key]] = [];

                    if (item[header.key]!==null)
                        this.dataset[header.key][item[header.key]] = "";
                });
            });
        },

        onDraw:function() {
            this.onDrawHeader();
            this.onDrawBody();
        },

        onDrawHeader:function() {
            /**
             * 헤더에 텍스트 입력 처리 진행
             * @type {string}
             */

            /**
             * 일괄 업데이트 부분
             */
            let html = "<tr>";
            this.headers.forEach((item, idx)=> {
                if (item.key === "f_bizname") {
                    html += `<td colspan="2"><button type="button" class="btn btn-primary" onclick="tables.onUpdate()">컬럼 일괄 업데이트</button></td>`;
                } else if (item.key === "f_shopname") {
                    return;
                } else {
                    let headers = this.dataset[item.key];
                    let cls = this.onIndexOf(item.key);
                    html += `<td class="${cls}">
                            <select class="form-select form-select-sm update_column" id="update_${item.key}" data-field="${item.key}">
                                <option value="${item.key === item.key ? "" : item.key}">${item.name}</option>`;

                    Object.entries(headers).forEach(entry => {
                        const [key, value] = entry;
                        html += `<option value="${key}">${key}</option>`;
                    });
                    return;
                }
                html += `</select></td>`;
            });
            html += "</tr>";


            /**
             * Thead
             * @type {string}
             */
            html += "<tr>";

            this.headers.forEach((head, idx)=> {
                let headers = this.dataset[head.key];
                let cls = this.onIndexOf(head.key); //cls = table_tab table_tab2

                html += `<td class="${cls}">
                            <select class="form-select form-select-sm" id="field_${head.key}" onChange="tables.onSelect(this)" data-field="${head.key}">
                                <option value="${head.key === head.key ? "" : head.key}">${head.name}</option>`;

                Object.entries(headers).forEach(entry => {
                    const [key, value] = entry;
                    html += `<option value="${key}">${key}</option>`;
                });
                html += `</select></td>`;
            });
            html += "</tr>";
            document.querySelector("#thead").innerHTML = html;
        },
        onDrawBody:function() {
            /**
             * 바디에 데이터셋 입력 처리
             * @type {string}
             */
            let html = "";
            this.items.forEach((item, idx)=>{
                html += `<tr class="table_tr tr_${item['f_billid']}" onclick="tables.onSelectTd(this)" data-billid="${item['f_billid']}">`;
                this.headers.forEach((header, header_idx)=>{
                    let cls = this.onIndexOf(header.key);
                    html += `<td class="${header.key} ${cls}">${item[header.key] === null ? "" : item[header.key]}</td>`;
                });
                html += `</tr>`;
            });
            document.querySelector("#tbody").innerHTML = html;
        },
        onIndexOf:function(key){
            // alert(this.tab1.indexOf(key));
            if (this.tab1.indexOf(key) > -1)
                return "table_tab table_tab1";

            if (this.tab2.indexOf(key) > -1)
                return "table_tab table_tab2";

            if (this.tab3.indexOf(key) > -1)
                return "table_tab table_tab3";

            if (this.tab4.indexOf(key) > -1)
                return "table_tab table_tab4";
            return "";
        },
        onTabChange:function(obj){
            $(".table_tab").hide();
            $("." + $(obj).data("tab")).show();
        },
    }

</script>
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4">
        <span class="text-muted fw-light">정산 /</span>
        <span class="text-muted fw-light">이용료 청구 /</span>
        청구 대상 조회12</h4>
    <!-- Basic Bootstrap Table -->
    <div class="row">
        <!-- Vertical Scrollbar -->
        <div class="col-12">
            <div class="card overflow-hidden" style="height: 730px">
                <h4 class="card-header">청구 대상 리스트</h4>
                <div class="card-body" id="both-scrollbars-example">
                    <div class="nav-align-top mb-2">
                        <ul class="nav nav-tabs" role="tablist">
                            <li class="nav-item">
                                <button type="button" class="nav-link active" role="tab" data-bs-toggle="tab" aria-selected="true"
                                        onclick="tables.onTabChange(this)"
                                        data-tab="table_tab1">
                                    정산정보
                                </button>
                            </li>
                            <li class="nav-item">
                                <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" aria-selected="false"
                                        onclick="tables.onTabChange(this)"
                                        data-tab="table_tab2">
                                    매장정보
                                </button>
                            </li>
                            <li class="nav-item">
                                <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" aria-selected="false"
                                        onclick="tables.onTabChange(this)"
                                        data-tab="table_tab3">
                                    담당자정보
                                </button>
                            </li>
                            <li class="nav-item">
                                <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" aria-selected="false"
                                        onclick="tables.onTabChange(this)"
                                        data-tab="table_tab4">
                                    품목정보
                                </button>
                            </li>
                        </ul>
                    </div>
                    <table class="table table-bordered table-hover">
                        <thead id="thead">
                        </thead>

                        <tbody class="table-border-bottom-0" id="tbody">
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
