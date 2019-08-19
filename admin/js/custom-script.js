
/*CUSTOM JS TO ADD INTERACTIVITY TO THE SYSTEM*/

/*
let subjectAssign  = document.getElementById("clickToAssignSubject"); // link when clicked displays the form to assign subjects to teachers

let displayAssignClassTrForm  = document.getElementById("clickToMakeClassTr");  // click on this link to display form where you can create class teachers

let displaySubjectForm = document.getElementById("displaySubjectForm"); // div to display form to assign subject to teachers

let classTrForm = document.getElementById("clickToMakeClassTr"); // div to display form to assign classes to teachers


subjectAssign.addEventListener("click", ()=>{
    if(displaySubjectForm.style.display === "none"){
        displaySubjectForm.style.display = "block";
        classTrForm.style.display = "none";
    } else{
        displaySubjectForm.style.display = "block";
        classTrForm.style.display = "none";
    }
});

displayAssignClassTrForm.addEventListener("click", ()=>{
    if(displayAssignClassTrForm.style.display === "none"){
        displayAssignClassTrForm.style.display = "block";
        classTrForm.style.display = "none";
    } else{
        displayAssignClassTrForm.style.display = "block";
        classTrForm.style.display = "none";
    }
})
*/
//console.log("hello");


$(document).ready(function(){

    $('#classTeacher').click(function(){

        $('#displaySubjectForm').hide(200);
        $('#makeClassTeacher').show(800);

        $('#classTeacher').hide();
        $('#subjectTeacher').show(800);

    });

    $('#subjectTeacher').click(function(){

        $('#makeClassTeacher').hide(200);
        $('#displaySubjectForm').show(800);

        $('#subjectTeacher').hide();
        $('#classTeacher').show(800);

    });

}); 

