@extends("layouts.app")
@section("content")
<script>

    document.addEventListener("DOMContentLoaded", ()=>{
        tables.initialize();
    });

    let tables = {
        headers : {!! $headers !!},
        items : {!! $items !!},
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
        initialize:function() {
            this.set();
            this.onDraw();
        },
        onIndexOf:function(key){
            if (this.tab1.indexOf(key) >= 0) {
                return "table_tab table_tab1";
            }

            if (this.tab2.indexOf(key) >= 0) {
                return "table_tab table_tab2";
            }

            if (this.tab3.indexOf(key) >= 0) {
                return "table_tab table_tab3";
            }

            return "";
        },
        set:function() {
            this.headers.forEach((item, idx)=> {
                this.dataset[item] = [];
            });

            this.items.forEach((item, idx)=>{
                this.headers.forEach((header, header_idx)=>{
                    if (this.dataset[header][item[header]] === undefined) {
                        this.dataset[header][item[header]] = [];
                    }
                    this.dataset[header][item[header]].push(item['f_billid']);
                })
            });
        },
        onSelect:function(obj) {
            $(".table_tr").hide();
            (this.dataset[$(obj).data("field")][obj.value]).forEach((billid, idx)=> {
                $(`.tr_${billid}`).show();
            });
        },
        onSelectTd:function(obj) {
            if (obj.classList.contains('selected')) {
                obj.classList.remove("selected");
            } else {
                obj.classList.add("selected");
            }
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
             * 일괄 업데이트 창
             */
            let html = "<tr>";
            this.headers.forEach((item, idx)=> {
                if (item === "f_bizname") {
                    html += `<td colspan="2"><button type="button" class="btn btn-primary" onclick="tables.onUpdate()">컬럼 일괄 업데이트</button></td>`;
                } else if (item === "f_shopname") {
                    return;
                } else {
                    let headers = this.dataset[item];
                    let cls = this.onIndexOf(item);

                    html += `<td class="${cls}">
                            <select class="form-select form-select-sm update_column" id="update_${item}" data-field="${item}">
                                <option value="${item === item ? "" : item}">${item}</option>`;

                    Object.entries(headers).forEach(entry => {
                        const [key, value] = entry;
                        html += `<option value="${key}">${key}</option>`;
                    });
                }

                html += `</select></td>`;
            });

            html += "</tr>";

            /**
             * Thead
             * @type {string}
             */
            html += "<tr>";
            this.headers.forEach((item, idx)=> {
                let headers = this.dataset[item];
                let cls = this.onIndexOf(item);

                html += `<td class="${cls}">
                            <select class="form-select form-select-sm" id="field_${item}" onChange="tables.onSelect(this)" data-field="${item}">
                                <option value="${item === item ? "" : item}">${item}</option>`;

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
                    let cls = this.onIndexOf(header);
                    html += `<td class="${header} ${cls}">${item[header] === null ? "" : item[header]}</td>`;
                });
                html += `</tr>`;
            });

            document.querySelector("#tbody").innerHTML = html;
        },
        onTabChange:function(obj){
            $(".table_tab").hide();
            $("." + $(obj).data("tab")).show();
        },
        onUpdate:function() {
            /**
             * 화면 내용을 바로 전환해주는 스크립트
             * @type {NodeListOf<Element>}
             */
            let update_column = document.querySelectorAll(".update_column");
            let update_arr = [];
            update_column.forEach((item, idx)=>{
                if (item.value !== "") {
                    update_arr[item.getAttribute("data-field")] = item.value;
                }
            });

            let table_tr = document.querySelectorAll(".table_tr");
            table_tr.forEach((item, idx)=>{
                if (item.classList.contains("selected")) {
                    Object.entries(update_arr).forEach((update)=>{
                        console.log(item.querySelector("."+update[0]));
                        item.querySelector("."+update[0]).innerText = update[1];
                    });
                }
            })
        }
    }
</script>
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Tables /</span> Basic Tables</h4>
    <!-- Basic Bootstrap Table -->
    <div class="row">
        <!-- Vertical Scrollbar -->
        <div class="col-12">
            <div class="card overflow-hidden" style="height: 730px">
{{--                <h5 class="card-header">Vertical & Horizontal Scrollbars</h5>--}}
                <div class="card-body" id="both-scrollbars-example">
                    <ul class="nav nav-pills mb-3" role="tablist">
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
                    </ul>
                    <table class="table table-bordered table-hover">
                        <thead id="thead">
                        {{--                        <tr>--}}
                        {{--                            @foreach ($headers as $header)--}}
                        {{--                                <td>{{$header}}</td>--}}
                        {{--                            @endforeach--}}
                        {{--                        </tr>--}}
                        </thead>
                        <tbody class="table-border-bottom-0" id="tbody">
                        {{--                            @foreach ($items as $key=>$item)--}}
                        {{--                                <tr>--}}
                        {{--                                    @php--}}
                        {{--                                    $item = (array) $item;--}}
                        {{--                                    @endphp--}}
                        {{--                                    @foreach ($headers as $header)--}}
                        {{--                                        <td>{{$item[$header]}}</td>--}}
                        {{--                                    @endforeach--}}
                        {{--                                </tr>--}}
                        {{--                            @endforeach--}}
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection
