function toggleModify(id){
    let currentmodify = document.getElementById(`agenda_form_modify${id}`);
    if(currentmodify.style.display=='none'){
        currentmodify.style.display='flex';
        return;
    }
    if(currentmodify.style.display=='flex'){
        currentmodify.style.display='none';
        return;
    }
}
function hideModify(id){
    document.getElementById(`agenda_form_modify${id}`).style.display='none';
}