
<script>
    $(function() {

        $("form#employer-search").find('input[type="text"]').on('keyup', function() {
            var formdata = $("form#employer-search").serialize();
            var url = "{{route($entity['url'].'.search')}}";
            loademployers(url, formdata, $("#sort_by").val());
        });

        $("form#employer-search").find('select,input[type="checkbox"],input[type="radio"]').on('change', function() {

            var formdata = $("form#employer-search").serialize();
            var url = "{{route($entity['url'].'.search')}}";
            loademployers(url, formdata);
        });

        $('body').on('click', '.pagination a', function (e) {
            e.preventDefault();

            var url = $(this).attr('href');

            // window.history.pushState("", "", url);
            formdata = $("form#employer-search").serialize();
            loademployers(url,formdata);
        });

        $("form#employer-search").submit(function(event) {
            event.preventDefault();
            return false;
        })

        function loademployers(url,formdata) {
            $.ajax({
                type: "POST",
                url: url,
                data: formdata,
                success:function(response){

                    $('.employer_list').html('');
                    $('.employer_list').html(response.data);
                },
                error:function(){
                    console.log("Failed to load data!");
                }
            });
        }

        $("#selectAll").click(function() {

            $(".candidate_list input[type=checkbox]").prop("checked", $(this).prop("checked"));
        });

        $(".candidate_list input[type=checkbox]").click(function() {
            if (!$(this).prop("checked")) {
                $("#selectAll").prop("checked", false);
            }
        });
    });

    </script>
