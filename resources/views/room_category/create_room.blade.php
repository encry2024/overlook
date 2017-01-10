@extends('layouts.app')

@section('content')
    @if(Session::has('message'))
        <div class="alert alert-success alert-dismissible" role="alert" style="margin-top: -2.3rem;">
            <div class="container"><i class="fa fa-check"></i>&nbsp;&nbsp;{{ Session::get('message') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>
        </div>
    @endif
    <div class="col-lg-12">
        <div class="row">
            <div class="col-lg-3">
                <div class="list-group">
                    <a href="#" class="list-group-item list-group-item-success" onclick='document.getElementById("createRoomForm").submit();'><i class="fa fa-check"></i>&nbsp;&nbsp;Create Room</a>
                    <a href="#" class="list-group-item list-group-item-primary add_field_button" id="btnAdd"><i class="fa fa-plus"></i>&nbsp;&nbsp;Add Room</a>
                    <a href="{{ route('show_room', $category->id) }}" class="list-group-item"><i class="fa fa-arrow-left"></i>&nbsp;&nbsp;Back</a>
                </div>
            </div>

            <div class="col-lg-9">
                <div class="row">
                    <div class="panel panel-default">
                        <div class="panel-heading" style="font-size: 20px;"><i class="fa fa-plus"></i>&nbsp;&nbsp;Add a Room</div>
                        <div class="panel-body">
                            <form class="form-horizontal" method="POST" id="createRoomForm" action="{{ route('post_room', $category->id) }}">
                                {{ csrf_field() }}

                                <div class="input_fields_wrap">
                                    <div class="form-group">
                                        <label for="inputRoom" class="col-sm-3 control-label">Room Name/No#:</label>
                                        <div class="col-sm-5">
                                            <input name="name[]" class="form-control room_number" id="inputRoom" placeholder="Room #1">
                                        </div>
                                    </div>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            var max_fields      = 10; //maximum input boxes allowed
            var wrapper         = $(".input_fields_wrap"); //Fields wrapper
            var add_button      = $(".add_field_button"); //Add button class
            var room_number     = document.getElementsByClassName('room_number').length;
            var rm_nm           = document.getElementsByClassName('room_number');

            $(add_button).click(function(e) {
                e.preventDefault();

                if (room_number < max_fields) {
                    room_number++;
                    $(wrapper).append('' +
                        '<div class="form-group added_room">' +
                            '<label for="" class="col-sm-3 control-label">Room Name/No#:</label>' +
                            '<div class="col-lg-5 col-sm-3">' +
                                '<input type="text" name="name[]" class="form-control room_number" placeholder="Room #' + room_number + '"/>' +
                            '</div>' +
                            '<a id="Font" class="remove_field" style="color: #d9534f;">' +
                            '   <i class="fa fa-remove fa-2x" style="margin-top: 0.25rem;margin-left: -1rem;"></i>' +
                            '</a>' +
                            '</div>' +
                        '</div> '
                    ); //add input box
                }

                for (var index = 1; index < room_number; index++) {
                    rm_nm[index].setAttribute('placeholder', 'Room #' + (index+1));
                }
            });

            $(wrapper).on("click",".remove_field", function(e) { //user click on remove text
                e.preventDefault();
                $(this).closest('.added_room').remove();
                room_number--;

                for (var index = 1; index < room_number; index++) {
                    rm_nm[index].setAttribute('placeholder', 'Room #' + (index+1));
                }
            });

            // Script for closing message div
            $('.message .close').on('click', function() {
                $(this).closest('.message')
                        .transition('fade');
            });
        });
    </script>
@stop