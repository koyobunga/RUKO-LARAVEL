@extends('layout.mobile')
@section('page')

<div id="view"></div>


<script>
    $(document).ready(function () {
        getHtml('{{ url('mobile/dashboard') }}')
    });
    

    function getHtml(url){
        function renderPage(){    
            $.ajax({
                type: "get",
                url: url,
                data: "data",
                dataType: "json",
                beforeSend: function(){
                    $('#toast-loading').toast('show');
                },
                complete: function(){
                    $('#toast-loading').toast('hide');
                }, 
                success: function (response) {     
                    $('#toast-loading').toast('hide');
                    $('#view').html(response.html);
                },
                
                
            });
        }


        $('#toast-loading').toast('show');
        var networkDataRecived = false;
        var networkUpdate = fetch(url).then(function(response){
            return response.json();
        }).then(function(data){
            
            networkDataRecived = true;
            $('#toast-loading').toast('hide');
            $('#view').html(data.html);
            // renderPage();
        }).catch(function(){
            $('#toast-loading').toast('hide');
            caches.match(url).then(function(response){
            if(!response) throw Error('No data cache');
            return response.json();
            }).then(function(data){
                if(!networkDataRecived){
                    console.log('data dari cache');
                    $('#view').html(data.html);
                }
            }).catch(function(){
                console.log('update');
                return networkUpdate;
            });
        });
        
       
    }

</script>

@endsection



