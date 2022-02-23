function step(id){
    $(".step").addClass("hidden");
    $(".step-" + id).removeClass("hidden")
}
function loadMajor(){
    step(1)
    $.get("/ajax/major", function(data, status){
        $("#major-box select").removeClass("hidden")
        $("#major-box label").removeClass("hidden")
        $("#major-box .spinner-border").addClass("hidden")
        data.forEach(function (item){
            $("#major-box select").append("<option value='" + item.id + "'>" + item.name + "</option>")
        });
        $("#major-box select").on('change', function() {

            loadBranch(this.value);
        });

    });
}
function loadBranch(major_id){

    if (major_id === ""){
        $("#major-box select").addClass("is-invalid");
        $("#branch-box").addClass("hidden")
        step(1)
    }else{
        $("#major-box select").removeClass("is-invalid");
        $("#branch-box").removeClass("hidden")
        $.get("/ajax/branch/" + major_id, function(data, status){
            $("#branch-box select").removeClass("hidden")

            $("#branch-box label").removeClass("hidden")
            $("#branch-box .spinner-border").addClass("hidden")
            $(".branch-value").remove()

            data.forEach(function (item){
                $("#branch-box select").append("<option class='branch-value' value='" + item.id + "'>" + item.name + "</option>")

            });
            step(2)
            $("#branch-box select").on('change', function() {
                $.get("/ajax/course/" + this.value, function(data){
                    course = data;
                    removeAllCourse();
                    loadCourse(0);
                    $("#count-box").removeClass("hidden");
                    step(3)
                });


            });
        });
    }

}
lastTerm = 0;
function removeAllCourse(){
    $("#course-container div").remove();
    lastTerm = 0;
}

function loadCourse(term_id){
    lastTerm++;
    $("#course-container").append("<div class='col-md-6 mt-3' id='course-box-" +  term_id + "'>\n" +
        "    <div class='card'>" +
        "        <div class='card-header'>ترم " +  lastTerm + "</div>" +
        "        <div class='card-body'>" +
        "            <p class='card-text'>خب دقیقا اینجا باید درسای که ترم برداشتی وارد کن وقتی که تموم شد بزن رو بعدی و اگه آخرین ترمه که پاس کردی دکمه پایان رو بزن</p>\n" +
        "            <select class='select2 form-control' id='course-" +  term_id + "' multiple >" +
        "            </select>" +
        "            <ul class='pt-3 pb-3 error-items'>" +
        "               <div class=\"spinner-border text-primary hidden\" style='margin: 0 auto;display: grid;'>\n" +
        "               <span class=\"visually-hidden\">Loading...</span>\n" +
        "               </div>" +
        "            </ul>"+
        "           <div style='width: 100%;display: grid;'>" +
        "               <div style='margin: 25px auto;display: inline-block;'>" +
        "                   <button type='button' class='btn btn-secondary' onclick='pervCourse()'><img src='icon/arrow-right.svg' height='15px'> ترم قبل </button>\n" +
        "                   <button type='button' class='btn btn-primary' onclick='endCourse()'>پایان <img src='icon/flag-checkered.svg'  height='30px'> </button>\n" +
        "                   <button type='button' class='btn btn-primary' onclick='nextCourse()'>ترم بعد <img src='icon/arrow-left.svg' height='15px'></button>\n" +
        "               </div>\n" +
        "           </div>\n" +
        "        </div>\n" +
        "    </div>\n" +
        "</div>");
    course.forEach(function (item){
        $("#course-" + term_id).append("<option value='" + item.id + "'>" + item.name + "</option>")
    });
    $("#course-" + term_id).select2({
        dir: "rtl"
    });

    $("#course-" + term_id ).on('select2:select', function (e) {


        $("#course-box-" + term_id + " .spinner-border").removeClass("hidden");

        last = [];

        curent = [];
        for (i =0; i < (lastTerm-1);i++){
            $('#course-' + i ).val().forEach(function (item){
                last.push(item)
            });
        }
        $('#course-' + term_id ).val().forEach(function (item){
            curent.push(item)
        });


        $.ajax({
            type: "POST",
            data: {"curent":JSON.stringify(curent),"last":JSON.stringify(last)},
            url: "/ajax/course/validation",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(msg){
                $("#course-box-" + term_id + " .spinner-border").addClass("hidden");
                $("#course-box-" + term_id + " .error-items li").remove();
                if (!$.trim(msg)){
                    $("#course-box-" + term_id + " .error-items").append("<li class='text-success' ><img src='icon/check-double.svg' height='20px'> خب تا اینجا کار که درسای این ترمت اوکی بود  </li>");
                }
                msg.forEach(function (item){
                    if (item.error === 1){
                        $("#course-box-" + term_id + " .error-items").append("<li class='text-warning' ><img src='icon/exclamation.svg' height='20px'> <strong>"+item.name+"</strong> نیاز به خوندن <strong>" + item.pish + "</strong> داشته</li>");
                    }else if(item.error === 2){
                        $("#course-box-" + term_id + " .error-items").append("<li class='text-warning' ><img src='icon/exclamation.svg' height='20px'> جمع واحد ها نباید بیشتر از <strong>24</strong> واحد باشه </li>");
                    }else if(item.error === 3){
                        $("#course-box-" + term_id + " .error-items").append("<li class='text-warning' ><img src='icon/exclamation.svg' height='20px'> <strong>"+item.name+"</strong> رو باید با <strong>" + item.ham + "</strong> بخونی</li>");
                    }else if(item.error === 4){
                        $("#course-box-" + term_id + " .error-items").append("<li class='text-warning' ><img src='icon/exclamation.svg' height='20px'> فقط میتونی یدونه درس از دسته معارف برداری");
                    }
                })

            }
        });

    });
    $("#course-" + term_id ).on('select2:unselect', function (e) {

        console.log(e.params.data.id)
    });


}
function nextCourse(){

    $("#course-box-" + (parseInt(lastTerm) - 1)).find("select").prop("disabled",true);
    $("#course-box-" + (parseInt(lastTerm) - 1)).find(".btn").addClass("hidden");
    loadCourse(lastTerm)
}
function pervCourse(){
    lastTerm--;
    $("#course-box-" + (parseInt(lastTerm) - 1)).find("select").prop("disabled",false);
    $("#course-box-" + (parseInt(lastTerm)  - 1)).find(".btn").removeClass("hidden");
    $("#course-box-" + (parseInt(lastTerm))).remove();

}
loadMajor();
$(document).ready(function() {


});
