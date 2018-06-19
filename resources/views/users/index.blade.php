@extends('master')


@section('content')
    <script src={{asset('js/jquery.dataTables.min.js')}}></script>
    <link rel="stylesheet" href="{{asset('css/datatables.min.css')}}">
    <div class="container">
        <a class="btn btn-success" href="{{url('users/create')}}">New User</a>
        <table class="table table-bordered" id="users-table">
            <thead>
            <tr>
                <th>Id</th>
                <th>Username</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Email</th>
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
                ajax: '{!! url('users/data') !!}',
                columns: [
                    {data: 'id', name: 'id'},
                    {data: 'username', name: 'username'},
                    {data: 'first_name', name: 'first_name'},
                    {data: 'last_name', name: 'last_name'},
                    {data: 'email', name: 'email'},
                    {
                        data: 'id',
                        name: 'actions',
                        "render": function (data, type, row, meta) {
                            if (data !== '') {
                                return '<a class="btn btn-warning" href="{{url('/users/')}}/' + data + '/edit"><i class="fa fa-save"></i> Edit</a> ' +
                                    '<a class="btn btn-danger sha-delete" rev=' + data + ' url="{{url('/users/')}}/' + data + '" href="#"><i class="fa fa-trash"></i></a>';

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
