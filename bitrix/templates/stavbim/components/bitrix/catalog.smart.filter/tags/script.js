
 window.onload = function () {
     $(document).ready(function () {

         $('body').on('click', "._del-filter", function () {
             let _link = $(this).find('._target-filter').data('link');
             var itemId = $(this).find("a").data("itemid");

             // console.log(itemId);

             $("input#"+itemId).trigger("click");

             // $(this).fadeOut('fast', function () {
             //     if (_link != undefined)
             //         $.ajax({
             //             url: _link,
             //             method: 'GET',
             //             success: function (response) {
             //                 let resultElements = $(response).find(".block__sort").get(0);
             //
             //                 let filterCheckbox = $('body').find(".filter_checkbox");
             //                 let _id = filterCheckbox.attr('id');
             //
             //                 $(".block__sort").replaceWith(resultElements);
             //                 history.pushState('', '', _link);
             //
             //             },
             //             error: function (response) {
             //                 console.log("Ошибка при отправке формы");
             //             }
             //         });
             // });

             return false;
         });

     });
 };
