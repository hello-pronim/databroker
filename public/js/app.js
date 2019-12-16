$(document).ready(function(){    

    $(".dropdown-menu").each(function(){ $(this).css({right: -($(this).width()/2+20)+"px"}); console.log($(this).width()) });
});

