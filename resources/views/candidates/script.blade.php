
<script>
    $(function() {

        $("form#candidate-search").find('input[type="text"]').on('keyup', function() {
            var formdata = $("form#candidate-search").serialize();
            var url = "{{route($entity['url'].'.search')}}";
            loadcandidates(url, formdata, $("#sort_by").val());
        });

        $("form#candidate-search").find('select,input[type="checkbox"],input[type="radio"]').on('change', function() {

            var formdata = $("form#candidate-search").serialize();
            var url = "{{route($prefix.$entity['url'].'.search')}}";
            loadcandidates(url, formdata);
        });

        $('body').on('click', '.pagination a', function (e) {
            e.preventDefault();

            var url = $(this).attr('href');
            // window.history.pushState("", "", url);
            formdata = $("form#candidate-search").serialize();
            loadcandidates(url,formdata);
        });

        $("form#candidate-search").submit(function(event) {
            event.preventDefault();
            return false;
        })

        function loadcandidates(url,formdata) {
            $.ajax({
                type: "POST",
                url: url,
                data: formdata,
                success:function(response){

                    $('.candidate_list').html('');
                    $('.candidate_list').html(response.data);
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
