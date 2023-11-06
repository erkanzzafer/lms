<!-- jquery -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.js"></script>

<script src="{{ URL::asset('assets/js/jquery-3.3.1.min.js') }}"></script>
<!-- plugins-jquery -->
<script src="{{ URL::asset('assets/js/plugins-jquery.js') }}"></script>

<!-- plugin_path -->
<script type="text/javascript">
    var plugin_path = "{{ asset('assets/js') }}/";
</script>

<!-- chart -->
<script src="{{ URL::asset('assets/js/chart-init.js') }}"></script>
<!-- calendar -->
<script src="{{ URL::asset('assets/js/calendar.init.js') }}"></script>
<!-- charts sparkline -->
<script src="{{ URL::asset('assets/js/sparkline.init.js') }}"></script>
<!-- charts morris -->
<script src="{{ URL::asset('assets/js/morris.init.js') }}"></script>
<!-- datepicker -->
<script src="{{ URL::asset('assets/js/datepicker.js') }}"></script>
<!-- sweetalert2 -->
<script src="{{ URL::asset('assets/js/sweetalert2.js') }}"></script>
<!-- toastr -->
@yield('js')
<script src="{{ URL::asset('assets/js/toastr.js') }}"></script>
<!-- validation -->
<script src="{{ URL::asset('assets/js/validation.js') }}"></script>
<!-- lobilist -->
<script src="{{ URL::asset('assets/js/lobilist.js') }}"></script>
<!-- custom -->
<script src="{{ URL::asset('assets/js/custom.js') }}"></script>
@livewireScripts

<script>
    function CheckAll(className, elem) {
        var elements = document.getElementsByClassName(className);
        var l = elements.length;
        //kaç tanee box1 sınıfında element varsa sayısını al

        if (elem.checked) {
            for (var i = 0; i < l; i++) {
                //hepsini checkle
                elements[i].checked = true;
            }
        } else {
            for (var i = 0; i < l; i++) {
                //hepsinin checkini kaldır
                elements[i].checked = false;
            }
        }
    }
</script>



<script>
    $(document).ready(function() {
        $('#datatable').DataTable();
    })
    $(document).ready(function() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $("#grade_select").on("change", function() {
            var Grade_id = $("#grade_select").val();
            alert(Grade_id);
            if (Grade_id) {
                $.ajax({
                    method: "POST",
                    url: "{{ route('section.getClass') }}",
                    data: {
                        grade_id: Grade_id
                    },
                    success: function(data) {
                        $('select[name="Class_id"]').empty();
                        $.each(data, function(key, value) {
                            $('select[name="class_id"]').append('<option value="' +
                                key + '">' + value + '</option>');
                        });
                    },
                    error: function(data) {}
                });
            } else {
                console.log('AJAX load did not work');
            }
        });
    })
</script>
