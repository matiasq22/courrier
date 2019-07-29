<!-- Begin-->
@if($errors->any() || !empty($messages))
    <script>
       toastr.options = {
            "closeButton": true,
            "debug": false,
            "progressBar": true,
            "preventDuplicates": false,
            "positionClass": "toast-top-right",
            "onclick": null,
            "showDuration": "400",
            "hideDuration": "900",
            "timeOut": "7000",
            "extendedTimeOut": "1000",
            "showEasing": "swing",
            "hideEasing": "linear",
            "showMethod": "fadeIn",
            "hideMethod": "fadeOut"
        }
    </script>
@endif

@if( $errors->any())
    <script type="text/javascript">
        $( document ).ready(function(){
            @foreach($errors->all() as $error)
                    @if(!is_null($error) && !empty($error))
                toastr['error']('{{$error}}','Error');
            @endif
            @endforeach
        });
    </script>
@endif
@if(!empty($messages))

    <script type="text/javascript">
        var titles = {
            error : 'Error',
            warning : 'Atencion',
            information : 'Informacion',
            success : 'Exito'
        };

        @foreach($messages as $type => $messageBag)
                @if(!empty($messageBag))
                @foreach($messageBag as $message)

            toastr['{{$type}}']('{{$message}}',titles['{{$type}}']);

        @endforeach
        @endif
        @endforeach
    </script>
@endif

