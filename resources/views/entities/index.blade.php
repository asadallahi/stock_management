@extends('master')


@section('content')
    <script src={{asset('js/jquery.dataTables.min.js')}}></script>
    <link rel="stylesheet" href="{{asset('css/datatables.min.css')}}">
    <div class="container">
        <a class="btn btn-success" href="{{url('entities/create')}}">New Image</a>
        <table class="table table-bordered" id="users-table">
            <thead>
            <tr>
                <th>Id</th>
                <th>Name</th>
                <th>Preview</th>
                <th>Deep Link</th>
                <th>Created At</th>
                <th>Expire Time</th>
                <th>Actions</th>
            </tr>
            </thead>
        </table>
    </div>
    <script>
        $(function () {
            $('#users-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{!! url('entities/data') !!}',
                columns: [
                    {data: 'id', name: 'id'},
                    {data: 'name', name: 'name'},
                    {
                        data: 'preview',
                        name: 'preview',
                        "render": function (data, type, row, meta) {
                            if (data !== '') {
                                console.log('data', meta);
                                return '<img src="{{url('/')}}/' + data.replace('public', 'storage') + '" height="50"/>';
                            }
                            return '---';
                        }
                    },
                    {
                        data: 'deep_link',
                        name: 'deep_link',
                        "render": function (data, type, row, meta) {
                            if (data !== '') {
                                return '<a href="{{url('/')}}/' + data.replace('public', 'storage') + '">Download</a>';

                            }
                            return '---';
                        }
                    },
                    {data: 'created_at', name: 'created_at'},
                    {data: 'expire_time', name: 'expire_time'},
                    {
                        data: 'id',
                        name: 'actions',
                        "render": function (data, type, row, meta) {
                            if (data !== '') {
                                return '<a class="btn btn-warning" href="{{url('/entities/')}}/' + data + '/edit"><i class="fa fa-save"></i> Edit</a> ' +
                                    '<a class="btn btn-danger sha-delete" rev=' + data + ' url="{{url('/entities/')}}/' + data + '" href="#"><i class="fa fa-trash"></i></a>';

                            }
                            return '---';
                        }
                    },
                ]
            });
            $('body').on('click', '.sha-delete', function (e) {
                if (window.confirm('Are you sure to delete this item?')) {
                    let url = $(this).attr('url');
                    let id = $(this).attr('rev');
                    $.ajax
                    ({
                        type: 'DELETE',
                        url: url,
                        data: 'id=' + id,
                        success: function (msg) {
                            console.log('msg', msg);
                            location.reload()
                        },
                        error: function (xhr, textStatus, errorThrown) {
                            alert('Error Ajax');
                        }
                    });
                    console.log('url', url);
                }
                return false;
            });
        });
    </script>
@endsection
