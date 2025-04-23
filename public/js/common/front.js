$(document).ready(function () {
  $('.slider').slick({
    dots: true,
    arrows:false,
    speed: 300,
    slidesToShow: 2,
    centerMode: true,
    centerPadding: '40px',
    responsive: [
      {
        breakpoint: 1400,
        settings: {
          slidesToShow: 2,
          dots: true
        }
      },
      {
        breakpoint: 992,
        settings: {
          slidesToShow: 2
        }
      },
      {
        breakpoint: 600,
        settings: {
          slidesToShow: 1
        }
      }
      // You can unslick at a given breakpoint now by adding:
      // settings: "unslick"
      // instead of a settings object
    ]
  });
  $('.slider2').slick({
    dots: true,
    arrows:false,
    infinite: false,
    speed: 300,
    slidesToShow: 4,
    slidesToScroll: 1,
    responsive: [
      {
        breakpoint: 1400,
        settings: {
          slidesToShow: 4,
          slidesToScroll: 4,
          infinite: true,
          dots: true
        }
      },
      {
        breakpoint: 1200,
        settings: {
          slidesToShow: 3,
          slidesToScroll: 3
        }
      },
      {
        breakpoint: 900,
        settings: {
          slidesToShow: 2,
          slidesToScroll: 2
        }
      },
      {
        breakpoint: 600,
        settings: {
          slidesToShow: 1,
          slidesToScroll: 1
        }
      }
      // You can unslick at a given breakpoint now by adding:
      // settings: "unslick"
      // instead of a settings object
    ]
  });

function TableDataTitle() {
    $("table.dataTable").each(function (index, tableID) {
        $(tableID).find("thead tr th").each(function (index) {
            index += 1;
            $(tableID).find("tbody tr td:nth-child(" + index + ")").attr("data-title", $(this).text());
        });
    });
}
$("table.dataTable").each(function (index, tableID) {
  $(tableID).find("thead tr th").each(function (index) {
      index += 1;
      var txt = $(this).text();
      $(this).html('<span>'+txt+'</span>');
  });
});

$(window).bind("load", function () {

  setTimeout(TableDataTitle, 18000)
});
});
