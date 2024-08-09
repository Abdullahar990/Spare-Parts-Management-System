<script src="script.js?v=<?= time();?>"></script>
<script src="jquery\jquery-3.7.1.min.js"></script>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">


<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap3-dialog/1.35.4/js/bootstrap-dialog.js" integrity="sha512-AZ+KX5NScHcQKWBfRXlCtb+ckjKYLO1i10faHLPXtGacz34rhXU8KM4t77XXG/Oy9961AeLqB/5o0KTJfy2WiA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
    function script(){

        this.initialize = function(){
            this.RegisterEvents();
        },
        this.RegisterEvents = function(){
            document.addEventListener('click',function(e){
                targetElement=e.target;
                classList=targetElement.classList;
                if (classList.contains('deleteUser')) {
    e.preventDefault();
    let userId = targetElement.dataset.userid;
    let fname = targetElement.dataset.fname;
    let lname = targetElement.dataset.lname;
    let fullName = fname + ' ' + lname;

    BootstrapDialog.confirm({
        title: 'Confirmation',
        message: 'Are you sure to delete ' + fullName + '?',
        type: BootstrapDialog.TYPE_DANGER,
        btnCancelLabel: 'Cancel',
        btnOKLabel: 'Delete',
        btnOKClass: 'btn-danger',
        callback: function (result) {
            if (result) {
                $.ajax({
                    method: 'POST',
                    url: 'delete-user.php',
                    data: {
                        user_id: userId,
                        f_name: fname,
                        l_name: lname
                    },
                    dataType: 'json',
                    success: function (data) {
                        if (data.success) {
                            BootstrapDialog.alert({
                                type: BootstrapDialog.TYPE_SUCCESS,
                                message: data.message,
                                callback: function () {
                                    location.reload();
                                }
                            });
                        } else {
                            BootstrapDialog.alert({
                                type: BootstrapDialog.TYPE_DANGER,
                                message: data.message
                            });
                        }
                    },
                    error: function () {
                        BootstrapDialog.alert({
                            type: BootstrapDialog.TYPE_DANGER,
                            message: 'An error occurred while processing your request.'
                        });
                    }
                });
            }
        }
    });
}

                if(classList.contains('updateUser'))
                {
                    e.preventDefault();
                    firstName=targetElement.closest('tr').querySelector('td.firstName').innerHTML;
                    lastName=targetElement.closest('tr').querySelector('td.lastName').innerHTML;
                    email=targetElement.closest('tr').querySelector('td.email').innerHTML;
                    userId=targetElement.dataset.userid;
                    BootstrapDialog.confirm({
                        title: 'Update ' + firstName + ' ' + lastName,
                        message: '<form>\
                            <div class="form-group">\
                                <label for="firstName">First Name</label>\
                                <input type="text" class="form-control" id="firstName" value=" ' + firstName + '" >\
                            </div>\
                            <div class="form-group">\
                                <label for="lastName">Last Name</label>\
                                <input type="text" class="form-control" id="lastName" value=" ' + lastName + '" >\
                            </div>\
                            <div class="form-group">\
                                <label for="email">Email address</label>\
                                <input type="email" class="form-control" id="emailUpdate" value=" ' + email + '" >\
                            </div>\
                            </form>',
                            callback: function(isUpdate)
                            {
                                if(isUpdate)
                                {
                                    $.ajax({
                                        method: 'POST',
                                        data: {
                                            userId: userId,
                                            f_name: document.getElementById('firstName').value,
                                            l_name: document.getElementById('lastName').value,
                                            email:  document.getElementById('emailUpdate').value
                                        },
                                        url: 'update-user.php',
                                        dataType: 'json',
                                        success: function(data){
                                            if(data.success)
                                            {
                                                BootstrapDialog.alert({
                                                    type: BootstrapDialog.TYPE_SUCCESS,
                                                    message: data.message,
                                                    callback: function(){
                                                        location.reload();

                                                    }
                                        
                                                });
                                            }
                                            else{
                                                BootstrapDialog.alert({
                                                    type: BootstrapDialog.TYPE_DANGER,
                                                    message: data.message,
                                                });
                                            }
                                        }
                                });
                                }
                            }
                        
                    });
                }



            });
        }

    }
    var script=new script;
    script.initialize();
</script>
<script>
    function script() {
        var vm = this;

        this.initialize = function() {
            this.RegisterEvents();
        };

        this.RegisterEvents = function() {
            document.addEventListener('click', function(e) {
                var targetElement = e.target;
                var classList = targetElement.classList;

                if (classList.contains('deleteProduct')) {
                    e.preventDefault();
                    var pID = targetElement.dataset.pid;
                    var pName = targetElement.dataset.name;

                    BootstrapDialog.confirm({
                        title: 'Confirmation',
                        message: 'Are you sure to delete <strong>' + pName + '</strong>?',
                        type: BootstrapDialog.TYPE_DANGER,
                        btnCancelLabel: 'Cancel',
                        btnOKLabel: 'Delete',
                        btnOKClass: 'btn-danger',
                        callback: function(result) {
                            if (result) {
                                $.ajax({
                                    method: 'POST',
                                    url: 'delete.php',
                                    data: {
                                        id: pID,
                                        table: 'products'
                                    },
                                    dataType: 'json',
                                    success: function(data) {
                                        if (data.success) {
                                            BootstrapDialog.alert({
                                                type: BootstrapDialog.TYPE_SUCCESS,
                                                message: data.message,
                                                callback: function() {
                                                    location.reload();
                                                }
                                            });
                                        } else {
                                            BootstrapDialog.alert({
                                                type: BootstrapDialog.TYPE_DANGER,
                                                message: data.message
                                            });
                                        }
                                    },
                                    error: function() {
                                        BootstrapDialog.alert({
                                            type: BootstrapDialog.TYPE_DANGER,
                                            message: 'An error occurred while processing your request.'
                                        });
                                    }
                                });
                            }
                        }
                    });
                }

            });

        };
    }

    var script = new script();
    script.initialize();
</script>
<script>
    function script() {
        var vm = this;

        this.initialize = function() {
            this.RegisterEvents();
        };

        this.RegisterEvents = function() {
            document.addEventListener('click', function(e) {
                var targetElement = e.target;
                var classList = targetElement.classList;

                if (classList.contains('deleteSupplier')) {
                    e.preventDefault();
                    var sID = targetElement.dataset.sid;
                    var supplier_name = targetElement.dataset.name;

                    BootstrapDialog.confirm({
                        title: 'Confirmation',
                        message: 'Are you sure to delete <strong>' + supplier_name + '</strong>?',
                        type: BootstrapDialog.TYPE_DANGER,
                        btnCancelLabel: 'Cancel',
                        btnOKLabel: 'Delete',
                        btnOKClass: 'btn-danger',
                        callback: function(result) {
                            if (result) {
                                $.ajax({
                                    method: 'POST',
                                    url: 'delete.php',
                                    data: {
                                        id: sID,
                                        table: 'suppliers'
                                    },
                                    dataType: 'json',
                                    success: function(data) {
                                        if (data.success) {
                                            BootstrapDialog.alert({
                                                type: BootstrapDialog.TYPE_SUCCESS,
                                                message: data.message,
                                                callback: function() {
                                                    location.reload();
                                                }
                                            });
                                        } else {
                                            BootstrapDialog.alert({
                                                type: BootstrapDialog.TYPE_DANGER,
                                                message: data.message
                                            });
                                        }
                                    },
                                    error: function() {
                                        BootstrapDialog.alert({
                                            type: BootstrapDialog.TYPE_DANGER,
                                            message: 'An error occurred while processing your request.'
                                        });
                                    }
                                });
                            }
                        }
                    });
                }

            });

        };
    }

    var script = new script();
    script.initialize();
</script>