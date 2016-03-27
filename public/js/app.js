$(document).ready(function ()
{
   $("#form_submit").click(function()
   {
       $("#target_form").submit();
   });
    $(".delete_group").click(function(event)
    {
        /* permet d'avoir l'id du bon groupe à supprimer */
        $("#btn_delete_group").prop('href', 'forum/group/' + event.target.id + '/delete');
    });
});