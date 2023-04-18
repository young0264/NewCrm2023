@extends("layouts.app")
@section("content")
    <!-- Content -->
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Tables /</span> Basic Tables</h4>

    <!-- Basic Bootstrap Table -->
    <div class="card">
        <h5 class="card-header">Table Basic</h5>
        <div class="table-responsive text-nowrap">
            <table class="table">
                <thead>
                <tr>
                    <th>User Sequence</th>
                    <th>로그인아이디</th>
                    <th>유저명</th>
{{--                    <th>Status</th>--}}
{{--                    <th>Actions</th>--}}
                </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                @foreach($items as $key=>$item)
                    <tr>
                        <td><i class="fab fa-angular fa-lg text-danger me-3"></i> <strong>{{$item->id}}</strong></td>
                        <td>{{$item->email}}</td>
                        <td>{{$item->name}}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
<!-- / Content -->
@endsection
