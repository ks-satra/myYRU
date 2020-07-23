
    <!-- <script data-require="jquery@*" data-semver="2.1.3" src="https://code.jquery.com/jquery-2.1.3.min.js"></script>
    <link data-require="bootstrap@*" data-semver="3.3.1" rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.min.css" />
    <script data-require="bootstrap@*" data-semver="3.3.1" src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.1/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="style.css" />
    <script src="script.js"></script> -->

    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h3 class="modal-title" id="myModalLabel">Warning!</h3>

                </div>
                <div class="modal-body">
                    <h4>Are you sure you want to DELETE?</h4>
                </div>
                <!--/modal-body-collapse -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" id="btnDelteYes" href="#">Yes</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
                </div>
                <!--/modal-footer-collapse -->
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    
    <table id="guests_table" class="table table-bordered"><tbody></tbody></table>
    
    <script>
        var guest = {guest_id: 1, guest_first_name: 'Thomas', guest_last_name: 'Mann', guest_email: 'test@ads.com', registry_id: 123};
        $("#guests_table > tbody:last").append(
            "<tr class='btnDelete' data-id='" + guest.guest_id + "'>"
            + "<td>" + guest.guest_first_name + "</td>"
            + "<td>" + guest.guest_last_name + "</td>"
            + "<td>" + guest.guest_email + "</td>"
            + "<td>" + "<a href='editguest.html?guestId=" + guest.guest_id + "&hostId="  + "&registryId=" + guest.registry_id + " '>"
            + "<td><button class='btn btnDelete' href=''>delete</button></td>"
            + "</tr>");
        
        $('.btn.btnDelete').on('click', function (e) {
            e.preventDefault();
            var id = $(this).closest('tr').data('id');
            $('#myModal').data('id', id).modal('show');
        });
        
        $('#btnDelteYes').click(function () {
            var id = $('#myModal').data('id');
            $('[data-id=' + id + ']').remove();
            $('#myModal').modal('hide');
        });
    </script>
