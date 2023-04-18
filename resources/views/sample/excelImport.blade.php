@extends("layouts.app")
@section("content")
<script>
    const excel = {
        upload:function() {
            const file = document.getElementById("file");
            let form = new FormData();
            form.append("file", file.files[0]);

            $.ajax({
                url : "{{route('excelImportProcess')}}",
                headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                type : "POST",
                processData : false,
                contentType : false,
                data : form,
                dataType : "json",
                success:function(response) {
                    if (response['status'] === "ok") {
                        excel.onDraw(response);
                    }
                },
                error: function (err) {
                    alert(err.responseText);
                }
            });
        },
        onDraw:function(results) {
            console.log(results['headers']);
            console.log(results['results']);

            let thead = "<tr>";
            for (let i=0; i<10; i++) {
                thead += "<td>" + results['headers'][i] + "</td>";
            }

            thead += "</tr>";
            document.querySelector(".table_thead").innerHTML = thead;

            let tbody = "";
            results['results'].forEach((items, idx)=>{

                if (idx > 10)
                    return;

                for (let i=0; i<10; i++) {
                    tbody += "<td>" + items[i] + "</td>";
                }

                tbody += "</tr>";
            });

            document.querySelector(".table_tbody").innerHTML = tbody;
        }
    }

</script>
<!-- Content -->
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <h5 class="card-header">Custom file input</h5>
                <div class="card-body demo-vertical-spacing demo-only-element">
                    <div class="input-group">
                        <input type="file" class="form-control" id="file" name="file" aria-describedby="inputGroupFileAddon04" aria-label="Upload">
                        <button class="btn btn-outline-primary" type="button" id="btn" onclick="excel.upload()">업로드</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Basic Bootstrap Table -->
    <div class="row" style="margin-top:20px;">
        <div class="col-12">
            <div class="card">
                <h5 class="card-header">Table Basic</h5>
                <div class="table-responsive text-nowrap">
                    <table class="table">
                        <thead class="table_thead">

                        </thead>
                        <tbody class="table-border-bottom-0 table_tbody">
{{--                @foreach($items as $key=>$item)--}}
{{--                    <tr>--}}
{{--                        <td><i class="fab fa-angular fa-lg text-danger me-3"></i> <strong>{{$item->id}}</strong></td>--}}
{{--                        <td>{{$item->email}}</td>--}}
{{--                        <td>{{$item->name}}</td>--}}
{{--                    </tr>--}}
{{--                @endforeach--}}
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- / Content -->
@endsection
