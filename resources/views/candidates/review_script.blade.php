
<script>
    $(function() {
        $(".inner_tab").on("click", function(event) {
            $(".inner_tab.active").removeClass("active");
            $(this).addClass('active');

            //formdata = $("form#candidate-search").serialize();
            var badge_value = $(this).data("badge-value");
            var candidate_id = $(this).data("candidate-id");

            var url = "{{route('reviews.search')}}";
            var inputData = {
                badge_id: badge_value,
                candidate_id: candidate_id
            };
            console.log(inputData);
            var jsonData = JSON.stringify(inputData);
            loadcandidates(url, jsonData);
        })


        $("form#candidate-search").find('input[type="text"]').on('keyup', function() {
            var formdata = $("form#candidate-search").serialize();

            loadcandidates(url, formdata, $("#sort_by").val());
        });

        $("form#candidate-search").find('select,input[type="checkbox"],input[type="radio"]').on('change', function() {

            var formdata = $("form#candidate-search").serialize();

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
                contentType: "application/json",
                success:function(response){
                    $('.review-list').html('');
                    $('.review-list').html(response.data);
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
