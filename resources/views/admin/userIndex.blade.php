@extends('admin.layouts.app')
@section('content')
    <link href="/plugins/bower_components/sweetalert/sweetalert.css" rel="stylesheet" type="text/css">
    <style>
        .tooltip-inner {
            max-width: 350px;
            /* If max-width does not work, try using width instead */
            width: 350px;
        }
    </style>
    <div id="page-wrapper">
        <div class="container-fluid">
            <div class="row bg-title">
                <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                    <h4 class="page-title">Edit Exam</h4> </div>
                <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">

                    <ol class="breadcrumb">
                        <li><a href="#">Admin</a></li>
                        <li class="active">Exam</li>
                    </ol>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-md-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">Add User</div>
                        <div class="panel-wrapper collapse in">
                            <div class="panel-body">
                                <form action="#" method="post">
                                    @if(isset($exam_add_error))
                                        <div class="row">
                                            <div class="col-lg-12 col-sm-12 col-xs-12 m-b-20">
                                                <!-- Start an Alert -->
                                                <div style="padding: 10px" id="error-message" class="alert-danger"> <i class="fa fa-exclamation"></i> <span class="error-message">{{$exam_add_error}}</span> </div>
                                            </div>
                                        </div>
                                    @endif
                                    <div class="row">
                                        <div class="col-lg-4 col-md-4 m-b-20">
                                            <input type="text" name="username" class="form-control input-lg" placeholder="Username">
                                        </div>
                                        <div class="col-lg-4 col-md-4 m-b-20">
                                            <input type="password" name="password" class="form-control input-lg" placeholder="Password">
                                        </div>

                                        <div class="col-lg-4 col-md-4  m-b-20">
                                            <input type="text" name="email" class="form-control input-lg" placeholder="Email">
                                        </div>
                                        <div class="col-lg-4 col-md-4">
                                            <input type="text" name="name" class="form-control input-lg" placeholder="Name">
                                        </div>

                                        <div class="col-lg-4 col-md-4">
                                            <input type="text" name="surname" class="form-control input-lg" placeholder="Surname">
                                        </div>

                                        <div class="col-lg-4 col-md-4">
                                            <select id='exam_cat_selection' name='sub_cat_id' class='form-control m-b-10' data-style='form-control'>
                                                @foreach($sub_cats as $sub_cat)
                                                    <option value="{{$sub_cat['id']}}">{{$sub_cat['sub_cat_name']}}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="col-lg-12 m-t-20">
                                            <button type="submit" class="btn btn-block btn-success waves-effect waves-light m-r-10 input-lg">Add</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">User Control Area</div>
                        <div class="panel-wrapper collapse in">
                            <div class="panel-body">
                                <table id="questions-table" class="table table-striped">
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Name</th>
                                        <th>Surname</th>
                                        <th>Email</th>
                                        <th>Sub Category</th>
                                        <th>Exam Status</th>
                                        <th>Operations</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @php($count=1)
                                    @foreach($usersL as $us)
                                        <tr>
                                            <td>@if(isset($us) && $us['id']){{$count}}@endif</td>
                                            <td>@if(isset($us) && $us['name']){{$us['name']}}@endif</td>
                                            <td>@if(isset($us) && $us['surname']){{$us['surname']}}@endif</td>
                                            <td>@if(isset($us) && $us['email']){{$us['email']}}@endif</td>
                                            @php($sub = (new \App\Models\ExamSubCategories)->where('id',$us['exam_sub_cat_id'])->first())
                                            <td>{{$sub['sub_cat_name']}}</td>
                                            @php($results = (new \App\Models\Results())->where('user_id',$us['id'])->get())
                                            @php($done_exam = false)
                                            @foreach($results as $result)
                                                @if(isset($result['user_id'])) @php($done_exam = true) @endif
                                            @endforeach
                                            <td>@if($done_exam) Done @else Not Done @endif</td>
                                            <td>
                                                <a href="/admin/exam/report/user/{{$us['id']}}">Report</a> -
                                                <a class="kart-sil-button" data="{{$us['id']}}" style="cursor: pointer">Delete</a>
                                                <input class="question-id" type="hidden" value="{{$us['id']}}" data="{{$us['id']}}">
                                            </td>
                                        </tr>
                                        @php($count++)
                                    @endforeach

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </div>
@endsection
@section('scripts')
    <script src="/plugins/bower_components/sweetalert/sweetalert.min.js"></script>
    <script>
        var token = "{{$token}}";
    </script>
    <script>
        $(document).ready(function() {
            $('#questions-table').DataTable({
                language: {
                    "sDecimal":        ",",
                    "sEmptyTable":     "Tabloda herhangi bir veri mevcut değil",
                    "sInfo":           "_TOTAL_ kayıttan _START_ - _END_ arasındaki kayıtlar gösteriliyor",
                    "sInfoEmpty":      "Kayıt yok",
                    "sInfoFiltered":   "(_MAX_ kayıt içerisinden bulunan)",
                    "sInfoPostFix":    "",
                    "sInfoThousands":  ".",
                    "sLengthMenu":     "Sayfada _MENU_ kayıt göster",
                    "sLoadingRecords": "Yükleniyor...",
                    "sProcessing":     "İşleniyor...",
                    "sSearch":         "Ara:",
                    "sZeroRecords":    "Eşleşen kayıt bulunamadı",
                    "oPaginate": {
                        "sFirst":    "İlk",
                        "sLast":     "Son",
                        "sNext":     "Sonraki",
                        "sPrevious": "Önceki"
                    },
                    "oAria": {
                        "sSortAscending":  ": artan sütun sıralamasını aktifleştir",
                        "sSortDescending": ": azalan sütun sıralamasını aktifleştir"
                    }
                },
                order: [[ 0, "desc" ]]
            });

            var del_btn = $('.kart-sil-button');
            //Open confirm button when click on delete button.
            del_btn.on('click',function (event) {
                console.log("tıklandı");

                //Show confirm button for deleting.
                $(".kart-sil-onayla-button[data=" + $(event.target).attr('data') + "]").show();

                swal({
                    title: "Soru silmeyi onaylıyor musunuz?",
                    text: "Bu aşamadan sonra soru silinecektir.",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#DD6B55",
                    confirmButtonText: "Onayla",
                    cancelButtonText: "İptal",
                    closeOnConfirm: false
                }, function(){
                    var id = $(".question-id[data=" + $(event.target).attr('data') + "]").val();
                    console.log(id);

                    swal.close();
                    $.ajax({
                        "method": "delete",
                        "url": '/admin/exams/users/delete/' + id
                    }).done(function (data) {
                        location.reload();
                    }).fail();
                });
            });
        });
    </script>
@endsection