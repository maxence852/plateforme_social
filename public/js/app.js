$(document).ready(function ()
{
   $("#form_submit").click(function()
   {
       $("#target_form").submit();
   });
    $("#category_submit").click(function()
    {
        $("#category_form").submit();
    });
    $(".new_category").click(function()
    {
        var id = event.target.id;
        var pieces = id.split("-");
        $("#category_form").prop('action','forum/category/' + pieces[2] + '/new'); //3ème élément du tableau pour pieces
    });


    $(".delete_group").click(function(event)
    {
        /* permet d'avoir l'id du bon groupe à supprimer */
        $("#btn_delete_group").prop('href', 'forum/group/' + event.target.id + '/delete');
    });
    //Ne fonctionne pas pour supprimer une category donc j'ai directement mis la route ds la balise a ds category.blade.php
   /* $(".delete_category").click(function(event)
    {
        // permet d'avoir l'id de la bonne category à supprimer
        $("#btn_delete_category").prop('href','forum/category/' + event.target.id + '/delete');
    });*/
});