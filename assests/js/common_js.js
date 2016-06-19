/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$(document).ready(function () {
    $("#login_button").click(function () {
            $("#login_form").validate({
                ignore: "",
                rules: {
                    'username': {
                        required: true,
                    },
                    'password': {
                        required: true,
                    }
                },
                errorPlacement: function (error, element) {

                }

            });
        });
 });